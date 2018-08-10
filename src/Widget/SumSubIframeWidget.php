<?php
declare(strict_types=1);
/**
 * Created by miroslav.
 * Date: 01.08.18
 * Time: 15:39
 */

namespace Minexsystems\SumSub\Widget;


use Minexsystems\SumSub\ApiClient;
use yii\base\Exception;
use yii\base\Widget;

/**
 * Class KycWidget
 * @package Minexsystems\Widget\Kyc
 */
class SumSubIframeWidget extends Widget
{
    /** @var int */
    public $userId;
    

    /**
     * @throws Exception
     */
    public function init()
    {
        parent::init();
        
        if ($this->userId == null) {
            throw new Exception('Cant find user id');
        }
    }
    
    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function run()
    {
        
        $accessToken = ApiClient::instance()->getAccessToken($this->userId);
        return $this->render('iframe', [
            'accessToken' => $accessToken
        ]);
    }
}