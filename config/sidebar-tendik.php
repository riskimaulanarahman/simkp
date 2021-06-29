<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'menu' => 
    [ //start
        
        [
            'icon' => 'fa fa-folder-open',
            'title' => 'Master KP ',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/tendik/tendik-request',
                    'title' => 'My Request'
                ],[
                    'url' => '/tendik/tendik-datamhs',
                    'title' => 'Data Mahasiswa'
                ]
            ]
        ]

	//end
    ]
];
