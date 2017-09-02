<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);

        $permissionModelName = config('entrust.permission');
        $logs                = new $permissionModelName();

        $logs->display_name = '日志';
        $logs->name         = 'admin.logs';
        $logs->description  = '';
        $logs->save();

        $list               = new $permissionModelName();
        $list->display_name = '日志列表';
        $list->name         = 'admin.logs.list';
        $list->description  = '';
        $list->save();
    }
}
