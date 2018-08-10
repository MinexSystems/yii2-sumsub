<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 09.08.18 - 15:30
 */


namespace Minexsystems\SumSub\Models;


use yii\base\Model;
use yii\helpers\Json;

class BaseModel extends Model
{
    /**
     * @param $attribute
     * @param $params
     */
    public function nestedModelValidator($attribute, $params)
    {
        if(!isset($params['errorMessage'])){
            $params['errorMessage'] = 'Model validation error';
        }
        
        if(!isset($params['model'])){
            $this->addError($attribute, 'parameter `model` is not set');
        }
        if(!isset($params['isArray'])){
            $params['isArray'] = false;
        }
        
        $model = $params['model'];
        if (!empty($this->$attribute)) {
            if($params['isArray']) {
                $eachData = $this->$attribute;
                $this->$attribute = [];
                foreach ($eachData as $item) {
                    /** @var BaseModel $modelObject */
                    $modelObject = new $model();
                    if ($modelObject->load($item, '') && $modelObject->validate()) {
                        $this->$attribute[] = $modelObject;
                    } else {
                        $this->addError($attribute, $params['errorMessage'].':'.Json::encode($modelObject->getErrors()));
                    }
                }
            } else {
                /** @var BaseModel $modelObject */
                $modelObject = new $model();
                if ($modelObject->load($this->$attribute, '') && $modelObject->validate()) {
                    $this->$attribute = $modelObject;
                } else {
                    $this->addError($attribute, $params['errorMessage'].':'.Json::encode($modelObject->getErrors()));
                }
            }
            
        }
    }
}