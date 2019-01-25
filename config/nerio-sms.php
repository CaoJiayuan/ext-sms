<?php

return [
    'timeout' => 5.0,
    'log'     => storage_path('logs/nerio-sms.log'),
    'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
];
