<?php
return array(
    
    'service_manager' => array(
        'factories' => array(
            'AcAssets\Options\AssetsOptions' => 'AcAssets\Options\Factory\AssetsOptionsFactory',
            'AcAssets\Service\AssetsService' => 'AcAssets\Service\Factory\AssetsServiceFactory',
        )
    )
    
);
