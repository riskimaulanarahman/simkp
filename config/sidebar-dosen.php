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

    'menu' => [
        [
            'icon' => 'fa fa-folder-open',
            'title' => 'Data KP ',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/data-mahasiswa',
                    'title' => 'Data Mahasiswa'
                ],[
                    'url' => '/dosen-request',
                    'title' => 'My Request'
                ],
            ]
        ]
        ,[
            'icon' => 'fa fa-folder-open',
            'title' => 'Data Nilai Seminar',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/nilai-seminar',
                    'title' => 'My Request'
                ]
            ]
        ],
    ] //end
];
