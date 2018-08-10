<?php
/**
 * @author Andru Cherny <acherny@minexsystems.com>
 * @date: 07.08.18 - 18:43
 */

return [
    'default' => 'production',
    
    'development' => [
        'apiUrl'       => 'https://test-api.sumsub.com',
        'apiKey'       => '----api-key----',
        'apiSecretKey' => '---Secret Key---',
        'debugProxy'   => '192.168.0.17:8888',
        
        'telegramBotId'   => 669660896,
        'telegramScope'   => ['id_document', 'id_selfie', 'utility_bill', 'phone_number', 'email'],
        'telegramText'   => 'KYC Check via Telegram Passport'
    ],
    'testing'     => [
        'apiUrl'       => 'https://test-api.sumsub.com',
        'apiKey'       => '----api-key----',
        'apiSecretKey' => '---Secret Key---',
        'debugProxy'   => '192.168.0.17:8888',
        
        'telegramBotId'   => 669660896,
        'telegramScope'   => ['id_document', 'id_selfie', 'utility_bill', 'phone_number', 'email'],
        'telegramText'   => 'KYC Check via Telegram Passport'
    ],
    'stating' => [
        'apiUrl'       => 'https://test-api.sumsub.com',
        'apiKey'       => '----api-key----',
        'apiSecretKey' => 'fcc2806487bdb7cb54167e25ad2d0ccd8ae86d4f',
        'debugProxy'   => false, //'192.168.0.17:8888',
        
        'telegramBotId'   => 669660896,
        'telegramScope'   => ['id_document', 'id_selfie', 'utility_bill', 'phone_number', 'email'],
        'telegramText'    => 'KYC Check via Telegram Passport'

    ],
    'production'  => [
        'apiUrl'          => 'https://api.sumsub.com',
        'apiKey'          => '----api-key----',
        'apiSecretKey'    => '---Secret Key---',
        'debugProxy'   => false, //'192.168.0.17:8888',
        
        'telegramBotId'   => 691314081,
        'telegramScope'   => ['id_document', 'id_selfie', 'utility_bill', 'phone_number', 'email'],
        'telegramText'   => 'KYC Check via Telegram Passport'

    ],
];