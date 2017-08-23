<?php

return [
    /**
     * Sco Admin Title
     */
    'title' => 'Sco Admin',

    'url_prefix' => 'admin',

    'datetimeFormat' => 'Y-m-d H:i:s',

    'defaultFileExts' => ['jpg', 'jpeg', 'png'],

    'components' => [
        \Sco\Admin\Models\User::class       => \App\Component\User::class,
        \Sco\Admin\Models\Role::class       => \App\Component\Role::class,
        \Sco\Admin\Models\Permission::class => \App\Component\Permission::class,
        \App\Post::class                    => \App\Component\Post::class,
    ],
];
