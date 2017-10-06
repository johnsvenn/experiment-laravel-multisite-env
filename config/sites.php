<?php

/**
 * Config option relating to multi sites
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Theme Key
    |--------------------------------------------------------------------------
    |
    | This is a unique string for your theme. This allows you reference your
    | current theme throughout the appliaction and can be used as the directory
    | name when allowing custom theme view paths for overloading views
    |
    */

    'key' => env('SITE_KEY', ''),
    
    
    /*
     |--------------------------------------------------------------------------
     | Sites
     |--------------------------------------------------------------------------
     |
     | Array that maps sites (domains) to specific config files
     |
     */
    
    'sites' => [
        
        't1.example.com' => '.env.t1',
        't2.example.com' => '.env.t2',
        't3.example.com' => '.env.t3'
        
    ]

];




