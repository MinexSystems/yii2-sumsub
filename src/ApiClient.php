<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 07.08.18 - 17:38
 */


namespace Minexsystems\SumSub;


use App\Helpers\Arr;
use Minexsystems\SumSub\Models\ApplicantModel;
use Minexsystems\SumSub\Models\ApplicantRequiredIdDocsModel;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\Json;
use yii\httpclient\Client as HttpClient;

class ApiClient extends BaseObject
{
    /**
     * @var string
     */
    public $apiUrl;
    
    public $apiKey;
    
    public $apiSecretKey;
    
    public $telegramBotId = null;
    /**
     * @var bool|string
     */
    public $debugProxy = null;
    
    public $telegramScope = [];
    
    public $telegramText = '';
    
    /**
     * @var string|HttpClient
     */
    public $curl = HttpClient::class;
    
    /**
     * @param mixed|string $env
     * @param string $configFile
     * @return self
     * @throws InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public static function instance($env = \YII_ENV, $configFile = '@config/api/sumSub.php')
    {
        
        if (!\Yii::$container->has(self::class)) {
            if(\is_array($env)) {
                \Yii::$container->setSingleton(self::class, $env);
            } elseif(\is_string($env)) {
                $config = require \Yii::getAlias($configFile);
                $config = Arr::getValue($config, $env, $config['default']);
                \Yii::$container->setSingleton(self::class, $config);
                
            } else {
                throw new InvalidConfigException('Configuration type not acceptable, Array or env name only');
            }
            
        }
        return \Yii::$container->get(self::class);
        
    }
    
    
    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (\is_null($this->apiKey)) {
            throw new InvalidConfigException('Api Key is not set');
        }
        if (\is_null($this->apiUrl)) {
            throw new InvalidConfigException('Api Url is not set');
        }
        if (\is_null($this->apiSecretKey)) {
            throw new InvalidConfigException('Api Secret Key is not set');
        }
        parent::init();
        $this->curl = Instance::ensure($this->curl, HttpClient::class);
    }
    
    
    /**
     * @param string $method
     * @param string $url
     * @param array $data
     * @return mixed|\yii\httpclient\Request
     * @throws InvalidConfigException
     */
    private function sendRequest(string $method, string $url, array $data = [])
    {
        
        $query = $this->curl
            ->createRequest()
            ->addOptions(['timeout' => 2])
            ->setUrl($this->apiUrl . $url)
            ->setData($data);
        if(\is_string($this->debugProxy))
        {
            $query->setOptions([
                'proxy' => $this->debugProxy, // use a Proxy
                'timeout' => 5, // set timeout to 5 seconds for the case server is not responding
            ]);
        }
        switch ($method) {
            case 'PATCH':
            case 'POST':
                $query->setFormat(HttpClient::FORMAT_JSON);
            case 'GET':
                $query->setMethod($method);
                break;
            default:
                throw new InvalidConfigException('Method '.$method.' is not allowed.');
        }
        $result = $query->send();
        if($result->getIsOk()) {
            return $result->getData();
        } else {
            \Yii::error('Can not get response from the server:'. $result->toString(), __FUNCTION__);
            return false;
        }
    }
    
    /**
     * @param string $applicantId
     * @return ApplicantModel|null
     * @throws InvalidConfigException
     */
    public function getApplicantInfo(string $applicantId): ?ApplicantModel
    {
        $result = $this->sendRequest('GET','/resources/applicants/'.$applicantId, ['key' => $this->apiKey]);
        
        if($result === false) {
            return null;
        }
        if(Arr::getValue($result, 'list.totalItems', 0) === 0) {
            return null;
        }
        $model = new ApplicantModel();
        $model->load(Arr::getValue($result, 'list.items.0', []), '');
        if(!$model->validate()) {
            \Yii::error('Can not validate response from server:'. Json::encode($model->getErrors()), __CLASS__);
            return null;
        }
        return $model;
    }
    
    public function updateApplicantInfo(string $applicantId, ApplicantRequiredIdDocsModel $applicantRequiredIdDocsModel) {
        $content = $applicantRequiredIdDocsModel->toArray();
        $this->sendRequest('PATCH', '/resources/applicants?key=' . $this->apiKey, [
            'id'             => $applicantId,
            'requiredIdDocs' => $content
        ]);
    }
    
    /**
     * @param int $userId
     * @param int $ttlInSecs
     * @return null|string
     * @throws InvalidConfigException
     */
    public function getAccessToken(int $userId, int $ttlInSecs = 600): ?string {
        $result = $this->sendRequest('POST', '/resources/accessTokens?'.\http_build_query([
            'key' => $this->apiKey,
            'ttlInSecs' => $ttlInSecs,
            'userId' => $userId,
        ]) );
        if($result === false) {
            return null;
        }
        return Arr::getValue($result, 'token', null);
    }
    
    public function getTelegramConfig(): array
    {
        return [
            'botId'   => $this->telegramBotId,
            'scope'   => $this->telegramScope,
            'text'    => $this->telegramText,
        ];
    }
}