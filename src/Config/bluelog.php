<?php

return [

    // Setup default log Channel
    'default_log_channel' => 'Default',

    // Setup default log Level
    // info, debug, error, warning
    'default_log_level' => 'debug',

    // False if authenticated user information should not be stored
    'store_logged_by' => true,

    // add fields want to store for login user as created_by
    'logged_by_fields' => [
        'id',
        'email',
    ],
];
