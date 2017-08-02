<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyCXPpgIgbsveiKF7M1xcAfcmwIIkqNTDE0',// ใส่ API ตรงนี้ครับ
                        'language' => 'th',
                        'version' => '3.1.18'
                    ]
                ]
            ]
        ], 
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

                'authManager' => [
                    'class' => 'yii\rbac\DbManager',
                ],
        
        'formatter' => [
            'dateFormat' => 'd-M-Y',
            'datetimeFormat' => 'd-M-Y H:i:s',
            'timeFormat' => 'H:i:s',
            'locale' => 'th-TH@calendar=buddhist', // your language locale
            'defaultTimeZone' => 'Asia/Bangkok',
            'timeZone' => 'Asia/Bangkok',
            'calendar' => IntlDateFormatter::TRADITIONAL ,
        ] ,
    ],
    
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
];
