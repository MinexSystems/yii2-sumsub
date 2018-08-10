<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 07.08.18 - 17:45
 */

namespace Minexsystems\SumSub\Models;


class ApplicantInfoModel extends BaseModel
{
    
    /**
     * @var string
     */
    public $firstName;
    
    public $lastName;
    
    public $dob;
    
    public $country;
    
    /**
     * @var ApplicantDocModel[]
     */
    public $idDocs = [];
    
    public function rules()
    {
        return [
            'firstNamString' => [['firstName'], 'string'],
            'lastNameString' => [['lastName'], 'string'],
            'dobString'      => [['dob'], 'string'],
            'countryString'  => [['country'], 'string'],
            'idDocsIsArray'   => [['idDocs'], 'checkIsArray'],
            
            'idDocsNestedValidator' => [['idDocs'], 'nestedModelValidator', 'params' => ['model' => ApplicantDocModel::class, 'isArray' => true]],
        ];
    }
    public function checkIsArray($attribute, $params): void
    {
        if (empty($this->$attribute)) {
            $this->addError($attribute, "config cannot be empty");
        } elseif (!is_array($this->$attribute)) {
            $this->addError($attribute, "config must be array.");
        }
    }
    
}