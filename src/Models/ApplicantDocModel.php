<?php

namespace Minexsystems\SumSub\Models;

use Minexsystems\SumSub\Interfaces\DocumentTypes;

/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 07.08.18 - 17:45
 */
class ApplicantDocModel extends BaseModel implements DocumentTypes
{
    
    /**
     * @var string
     */
    public $idDocType;
    
    /**
     * @var string
     */
    public $country;
    
    /**
     * @var string
     */
    public $firstName;
    
    /**
     * @var string
     */
    public $middleName;
    
    /**
     * @var string
     */
    public $lastName;
    
    /**
     * @var string
     */
    public $issuedDate;
    
    /**
     * @var string
     */
    public $number;
    
    /**
     * @var string
     */
    public $dob;
    
    /**
     * @var 
     */
    public $placeOfBirth;
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'idDocTypeString'    => [['idDocType'], 'string'],
            'idDocTypeIn' => [
                ['idDocType'],
                'in',
                'range' => [
                    self::ID_DOC_ID_CARD,
                    self::ID_DOC_PASSPORT,
                    self::ID_DOC_DRIVERS,
                    self::ID_DOC_BANK_CARD,
                    self::ID_DOC_UTILITY_BILL,
                    self::ID_DOC_SNILS,
                    self::ID_DOC_SELFIE,
                    self::ID_DOC_PROFILE_IMAGE,
                    self::ID_DOC_PHOTO,
                    self::ID_DOC_AGREEMENT,
                    self::ID_DOC_CONTRACT,
                    self::ID_DOC_RESIDENCE_PERMIT,
                    self::ID_DOC_EMPLOYMENT_CERTIFICATE,
                    self::ID_DOC_DRIVERS_TRANSLATION,
                    self::ID_DOC_OTHER,
                ]
            ],
            'countryString'      => [['country'], 'string'],
            'firstNameString'    => [['firstName'], 'string'],
            'middleNameString'   => [['middleName'], 'string'],
            'lastNameString'     => [['lastName'], 'string'],
            'issuedDateString'   => [['issuedDate'], 'string'],
            'numberString'       => [['number'], 'string'],
            'dobString'          => [['dob'], 'string'],
            'placeOfBirthString' => [['placeOfBirth'], 'string'],
        
        ];
    }
    

}