<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Temporary File Path
    |--------------------------------------------------------------------------
    |
    | The temporary file path where html and pdf files are stored.
    |
    */

    'temporary_file_path' => storage_path() . '/pdf',

    /*
    |--------------------------------------------------------------------------
    | Phantom Process Timeout (Seconds)
    |--------------------------------------------------------------------------
    |
    | PhantomJS is being executed in a separate process, here we can specify
    | how long to wait for the process to finish before aborting.
    |
    */

    'timeout' => 10,

    /*
    |--------------------------------------------------------------------------
    | PhantomJS Command Line Options
    |--------------------------------------------------------------------------
    |
    | Add list of wanted command line options for PhantomJS
    | List of available options can be found here:
    | http://phantomjs.org/api/command-line.html
    |
    */

    'command_line_options' => [
        '--ignore-ssl-errors=true',
        '--ssl-protocol=tlsv1',
        // '--debug=true',
        '--local-to-remote-url-access=true',
    ]
];