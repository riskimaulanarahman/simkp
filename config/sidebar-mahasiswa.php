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
		'title' => 'Kerja Praktik',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [
			[
				'url' => '/pengajuan-kp',
				'title' => 'Pendaftaran Kerja Praktik'
			],
			[
				'url' => '/my-berkas',
				'title' => 'My Berkas'
			],
		]
	],[
		'icon' => 'fa fa-lightbulb',
		'title' => 'Bimbingan',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [
			[
				'url' => '/mahasiswa-bimbingan-dosen',
				'title' => 'Dosen Pembimbing'
			],
		]
	],

    ]
];
