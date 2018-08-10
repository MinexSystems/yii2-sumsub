<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 08.08.18 - 16:07
 */


namespace Minexsystems\SumSub\Models;

use Minexsystems\SumSub\Interfaces\DocumentTypes;

/**
 * Class ApplicantRequiredIdDocsModel
 * @package Minexsystems\SumSub\Models
 */
class ApplicantDocSetModel extends BaseModel implements DocumentTypes
{
    
    /**
     * @var
     */
    public $idDocSetType = null;
    
    /**
     * @var null
     */
    public $types = [];
    
    /**
     * @var null
     */
    public $subTypes = [];
    
    /**
     * @var array
     */
    public $fields = null;
    
    /**
     * @var null
     */
    public $imageIds = null;
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'idDocSetTypeString' => [['idDocSetType'], 'string'],
            'typesSafe'          => [['types'], 'safe'],
            'subTypesSafe'       => [['subTypes'], 'safe'],
            'fieldsSafe'         => [['fields'], 'safe'],
            'imageIdsSafe'       => [['imageIds'], 'safe'],
        
        ];
    }
    
    /**
     * @param string $type
     */
    public function addType(string $type) {
        foreach ($this->types as $k => $item)
        {
            if($item == $type) {
                return;
            }
        }
        $this->types[] = $type;
    }
    
    /**
     * @param string $type
     */
    public function removeType(string $type) {
        foreach ($this->types as $k => $item)
        {
            if($item == $type) {
                unset($this->types[$k]);
            }
        }
    }
    
    /**
     * @param string $type
     * @return bool
     */
    public function typeNotExist(string $type): bool {
        foreach ($this->types as $item)
        {
            if($item === $type) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * @param string $type
     * @return bool
     */
    public function typeExist(string $type) {
        foreach ($this->types as $k => $item)
        {
            if($item == $type) {
                return true;
            }
        }
        return false;
    }
}