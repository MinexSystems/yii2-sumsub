<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 07.08.18 - 17:45
 */

namespace Minexsystems\SumSub\Models;


/**
 * Class ApplicantInfoModel
 * @package Minexsystems\SumSub\Models
 */
class ApplicantInfoModel extends BaseModel
{
    
    /**
     * @var string|null
     */
    public $firstName;
    
    /**
     * @var string|null
     */
    public $middleName;
    
    /**
     * @var string|null
     */
    public $lastName;
    
    /**
     * @var string|null
     */
    public $placeOfBirth;
    
    /**
     * @var string|null
     */
    public $dob;
    
    /**
     * @var string|null
     */
    public $country;
    
    /**
     * @var ApplicantDocModel[]
     */
    public $idDocs = [];
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'firstNamString' => [['firstName'], 'string'],
            'middleName' => [['middleName'], 'string'],
            'lastNameString' => [['lastName'], 'string'],
            'placeOfBirthString' => [['placeOfBirth'], 'string'],
            'dobString'      => [['dob'], 'string'],
            'countryString'  => [['country'], 'string'],
            'idDocsIsArray'   => [['idDocs'], 'checkIsArray'],
            
            'idDocsNestedValidator' => [['idDocs'], 'nestedModelValidator', 'params' => ['model' => ApplicantDocModel::class, 'isArray' => true]],
        ];
    }
    
    /**
     * @param $attribute
     * @param $params
     */
    public function checkIsArray($attribute, $params): void
    {
        if (empty($this->$attribute)) {
            $this->addError($attribute, "config cannot be empty");
        } elseif (!is_array($this->$attribute)) {
            $this->addError($attribute, "config must be array.");
        }
    }
    
}