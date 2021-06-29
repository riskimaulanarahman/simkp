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
                'icon' => 'fa fa-th-large',
                'title' => 'Dashboard',
                'url' => '/dashboard-admin',
            
            ],
            [
                'icon' => 'fa fa-folder-open',
                'title' => 'Data Users',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/master-user',
                        'title' => 'Users'
                    ],[
                        'url' => '/master-dosen',
                        'title' => 'Dosen'
                        
                    ],[
                        'url' => '/master-mahasiswa',
                        'title' => 'Mahasiswa'
                    ],[
                        'url' => '/master-koordinator',
                        'title' => 'Koordinator'
                    ],[
                        'url' => '/master-tendik',
                        'title' => 'Tendik'
                    ],

                ]
            ],
            [
                'icon' => 'fa fa-folder-open',
                'title' => 'Data Master',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/master-jurusan',
                        'title' => 'Jurusan'
                    ],
                    [
                        'url' => '/master-prodi',
                        'title' => 'Prodi'
                    ],
                ]
            ],

    ]
];