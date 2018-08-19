<?php

return [
    // enable or disable log notifier.
    'enabled' => env('ENABLE_LOG_NOTIFY', true),

    // set what levels of logs should be captured. It can be one or more of:
    // "debug", "info", "notice", "warning", "error", "critical",
    // "alert", "emergency", "processed". To capture all events just use "all"
    'levels' => [
        'all',
    ],

    // socket url to connect to.
    'socket_url' => 'ws://localhost:8080'
];
