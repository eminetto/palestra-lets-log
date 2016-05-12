<?php

include __DIR__.'/vendor/autoload.php';

// log channel
$log = new Monolog\Logger('SimpleDemoLetsLog');

//handler
$log->pushHandler(new Monolog\Handler\StreamHandler('/tmp/monolog.log', Monolog\Logger::WARNING));
$browserConsoleHandler = new Monolog\Handler\BrowserConsoleHandler();
$browserConsoleHandler->setFormatter(new Monolog\Formatter\JsonFormatter());
$log->pushHandler($browserConsoleHandler);

//processor
$log->pushProcessor(new Monolog\Processor\IntrospectionProcessor());
$log->pushProcessor(new Monolog\Processor\MemoryUsageProcessor());
$log->pushProcessor(new Monolog\Processor\ProcessIdProcessor());
$log->pushProcessor(new Monolog\Processor\WebProcessor());

// add records to the log
$log->warning('Aviso');
$log->error('Erro');

echo "Hello, Monolog!";
