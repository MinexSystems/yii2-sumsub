<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 07.08.18 - 17:45
 */

namespace Minexsystems\SumSub\Models;


class ApplicantModel extends BaseModel
{
    
    /**
     * @var
     */
    public $id;
    /**
     * @var string
     */
    public $inspectionId;
    /**
     * @var
     */
    public $externalUserId;
    /**
     * @var ApplicantInfoModel
     */
    public $info;
    /**
     * @var \Datetime|null
     */
    public $createdAt;
    /**
     * @var string
     */
    public $sourceKey;
    
    /**
     * @var
     */
    public $env;
    
    /**
     * @var ApplicantRequiredIdDocsModel
     */
    public $requiredIdDocs;
    
    public function rules()
    {
        return [
            'idRequired'                    => [['id'], 'required'],
            'inspectionIdRequired'          => [['inspectionId'], 'required'],
            'externalUserIdRequired'        => [['externalUserId'], 'required'],
            'info'                          => [['info'], 'required'],
            'createdAtRequired'             => [['createdAt'], 'required'],
            'sourceKeyString'               => [['sourceKey'], 'string'],
            'envString'                     => [['env'], 'string'],
            'infoNestedValidator'           => [['info'], 'nestedModelValidator', 'params' => ['model' => ApplicantInfoModel::class]],
            'requiredIdDocsNestedValidator' => [
                ['requiredIdDocs'],
                'nestedModelValidator',
                'params' => [
                    'model' => ApplicantRequiredIdDocsModel::class
                ]
            ],
        ];
    }

}