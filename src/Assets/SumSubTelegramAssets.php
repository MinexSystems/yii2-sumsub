<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 08.08.18 - 15:27
 */


namespace Minexsystems\SumSub\Assets;

use yii\web\AssetBundle;

/**
 * Class SumSubAssets
 * @package Minexsystems\SumSub\Assets
 */
class SumSubTelegramAssets extends AssetBundle
{
    //public $sourcePath = \APP_ROOT.'/yii2-sumsub/src/web';
    public $sourcePath = '@vendor/minexsystems/yii2-sumsub/src/web';
    
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    
    public $jsInline = [];
    
    public function init()
    {
        $this->js = [
            'js/telegram-passport.js',
        ];
        parent::init();
    }
}