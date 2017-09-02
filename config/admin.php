<?php

return [
    /**
     * Sco Admin Title
     */
    'title' => 'Sco Admin',

    'url_prefix' => 'admin',

    'datetime_format' => 'Y-m-d H:i:s',

    'upload' => [
        'disk' => 'public',
        'extensions' => [
            'file' => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml',
            'image' => 'jpg,jpeg,png,gif',
        ],
        'directory' => 'admin/uploads',
    ],

    'components' => [
        \Sco\Admin\Models\User::class       => \App\Component\User::class,
        \Sco\Admin\Models\Role::class       => \App\Component\Role::class,
        \Sco\Admin\Models\Permission::class => \App\Component\Permission::class,
        \App\Post::class                    => \App\Component\Post::class,
    ],
    'navigation' => [
        [
            'title'    => '系统管理',
            'icon'     => 'fa fa-edit',
            'priority' => 500,
            'id'       => 'system',
            'pages'    => [
                [
                    'title' => '操作日志',
                    'url'   => '/admin/logs',
                ]
            ],
        ],
        [
            'title'    => '用户管理',
            'icon'     => 'fa fa-users',
            'priority' => 600,
            'badge'    => 'New',
            'id'       => 'users',
        ],
        [
            'title'    => 'test',
            'icon'     => 'fa fa-edit',
            'priority' => 500,
            'badge'    => 'New',
        ],
    ]
];
