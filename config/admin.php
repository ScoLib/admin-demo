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
        'extensions' => ['jpg', 'jpeg', 'png'],
        'directory' => 'admin/uploads',
    ],

    'components' => [
        \Sco\Admin\Models\User::class       => \App\Component\User::class,
        \Sco\Admin\Models\Role::class       => \App\Component\Role::class,
        \Sco\Admin\Models\Permission::class => \App\Component\Permission::class,
        \App\Post::class                    => \App\Component\Post::class,
    ],
];
