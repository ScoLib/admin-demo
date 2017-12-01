<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Sco\Admin\Facades\AdminNavigation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = $this->app['config']->get('app.locale');
        if ($locale == 'zh-CN') {
            $locale = 'zh';
        }

        Carbon::setLocale($locale);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        AdminNavigation::setFromArray([
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
        ]);
    }
}
