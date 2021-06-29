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
        
        // [
        //     'icon' => 'fa fa-th-large',
        //     'title' => 'Dashboard',
        //     'url' => '/'
        // ],
        [
            'icon' => 'fa fa-folder-open',
            'title' => 'Data KP',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/koor/koor-datamhs',
                    'title' => 'Data Mahasiswa'
                ],
                // [
                //     'url' => '/koor/koor-request',
                //     'title' => 'My Request'
                // ],
                [
                    'url' => '/koor/bimbingan-mahasiswa',
                    'title' => 'Bimbingan Mahasiswa'
                ],
            ]
        ],
        [
            'icon' => 'fa fa-folder-open',
            'title' => 'Data Nilai Seminar',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/koor/nilai-seminar-koor',
                    'title' => 'My Request'
                ]
            ]
        ],
	//end
    ]
];
