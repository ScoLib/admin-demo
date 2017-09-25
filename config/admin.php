<?php

return [
    /**
     * Sco Admin Title
     */
    'title' => 'Sco Admin',

    'url_prefix' => 'admin',

    'datetime_format' => 'Y-m-d H:i:s',

    'upload' => [
        'disk'       => 'public',
        'extensions' => [
            'file'  => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml',
            'image' => 'jpg,jpeg,png,gif',
        ],
        'directory'  => 'admin/uploads',
    ],

    'components' => [
        \App\User::class       => \App\Component\User::class,
        \App\Role::class       => \App\Component\Role::class,
        \App\Permission::class => \App\Component\Permission::class,
        \App\Category::class   => \App\Component\Category::class,
        \App\Post::class       => \App\Component\Post::class,
    ],
    'navigation' => [
        [
            'title'    => '系统管理',
            'icon'     => 'fa-edit',
            'priority' => 500,
            'id'       => 'system',
            'pages'    => [
                [
                    'title' => '操作日志',
                    'url'   => '/admin/logs',
                ],
            ],
        ],
        [
            'title'    => '用户管理',
            'icon'     => 'fa-users',
            'priority' => 600,
            'badge'    => 'New',
            'id'       => 'users',
        ],
    ],
];
