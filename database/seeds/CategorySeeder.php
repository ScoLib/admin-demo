<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $def = new \App\Category();
        $def->name = '默认';
        $def->slug = 'default';
        $def->save();
    }
}
