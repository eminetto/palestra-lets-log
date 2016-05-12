<?php

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

$config = [
    'config' => [
        'applicationLog' => [
            'name' => 'LogFrom' . getenv('HOSTNAME'),
            'processor' => [
                'Monolog\Processor\IntrospectionProcessor',
                'Monolog\Processor\MemoryUsageProcessor',
                'Monolog\Processor\ProcessIdProcessor',
                'Monolog\Processor\WebProcessor',
            ],
            'streamHandler' => [
                'stream' => '/tmp/monolog.log',
                'level' => 'DEBUG',
            ],
            'slackHandler' => [
                'token' => 'xoxp-2182778956-2182778958-11013954544-1264445208',
                'channel' => '#exceptions',
                'username' => 'Log', //opcional
                'iconEmoji' => ':sweat:', //opcional
                'level' => 'CRITICAL', //opcional
                'bubble' => true, //opcional
                'useShortAttachment' => false, //opcional
                'includeContextAndExtra' => false //opcional
            ],
        ]
    ]
];
$app->register(new \ApplicationLog\Provider\ApplicationLog(), $config);

$app->get('/', function() use($app) {
    $app['monolog']->critical("Mensagem");

    return 'Hello from ' . getenv('HOSTNAME');
});

$app->run();
