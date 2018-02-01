<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $userModelName = config('auth.providers.users.model');
        $user = new $userModelName();
        $roleModelName = config('entrust.role');

        if ($user->count() == 0) {

            $role = (new $roleModelName())->where('name', 'admin')->firstOrFail();
            $user->name = 'admin';
            $user->email = 'admin@admin.com';
            $user->password = bcrypt('123456');
            $user->save();
            $user->attachRole($role);
        }

        $test = (new $roleModelName())->where('name', 'test')->firstOrFail();
        factory(\App\User::class, 30)->create()->each(function ($u) use ($test) {
            $u->attachRole($test);
        });
    }
}
