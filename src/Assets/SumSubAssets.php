<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 08.08.18 - 15:27
 */


namespace Minexsystems\SumSub\Assets;

use Minexsystems\SumSub\ApiClient;
use yii\web\AssetBundle;

/**
 * Class SumSubAssets
 * @package Minexsystems\SumSub\Assets
 */
class SumSubAssets extends AssetBundle
{
    public $sourcePath = null;
    
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    
    public $jsInline = [];
    
    public function init()
    {
        
        $this->js[] = ApiClient::instance()->apiUrl.'/idensic/static/idensic.js';
        parent::init();
    }
}