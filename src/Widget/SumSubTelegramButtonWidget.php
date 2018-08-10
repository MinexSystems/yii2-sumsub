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
use yii\helpers\Json;

/**
 * Class SumSubTelegramButtonWidget
 * @package Minexsystems\SumSub\Widget
 */
class SumSubTelegramButtonWidget extends Widget
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
        $telegramConfig = ApiClient::instance()->getTelegramConfig();
        $telegramConfig['accessToken'] = $accessToken;
        $telegramConfig['scope'] = Json::encode($telegramConfig['scope']);
        return $this->render('telegram_button', $telegramConfig);
    }
}