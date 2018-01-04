<?php

namespace App\Components\Observers;

use Auth;
use Sco\Admin\Contracts\ComponentInterface;

class UserObserver
{
    public function display(ComponentInterface $component)
    {
        return Auth::user()->can('view_user');
    }

    public function create(ComponentInterface $component)
    {
        return Auth::user()->can('create_user');
    }

    public function edit(ComponentInterface $component)
    {
        return Auth::user()->can('edit_user');
    }

    public function delete(ComponentInterface $component)
    {
        return Auth::user()->can('delete_user');
    }

    public function destroy(ComponentInterface $component)
    {
        return Auth::user()->can('destroy_user');
    }

    public function restore(ComponentInterface $component)
    {
        return Auth::user()->can('restore_user');
    }
}
