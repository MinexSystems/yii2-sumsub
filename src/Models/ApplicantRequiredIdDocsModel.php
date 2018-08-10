<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 08.08.18 - 16:07
 */


namespace Minexsystems\SumSub\Models;

/**
 * Class ApplicantRequiredIdDocsModel
 * @package Minexsystems\SumSub\Models
 */
class ApplicantRequiredIdDocsModel extends BaseModel
{
    
    /**
     * @var
     */
    public $country = null;
    
    /**
     * @var null
     */
    public $includedCountries = null;
    
    /**
     * @var null
     */
    public $excludedCountries = null;
    
    /**
     * @var ApplicantDocSetModel[]
     */
    public $docSets = [];
    
    public function rules()
    {
        return [
            'countryString'           => [['country'], 'string'],
            'includedCountriesString' => [['includedCountries'], 'string'],
            'excludedCountriesString' => [['excludedCountries'], 'string'],
            
            'docSetsNestedValidator' => [['docSets'], 'nestedModelValidator', 'params' => ['model' => ApplicantDocSetModel::class, 'isArray' => true]],
        ];
    }
}