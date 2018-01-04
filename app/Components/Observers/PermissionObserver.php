<?php

namespace App\Components\Observers;

use Auth;
use Sco\Admin\Contracts\ComponentInterface;

class PermissionObserver
{
    public function display(ComponentInterface $component)
    {
        return Auth::user()->can('view_permission');
    }

    public function create(ComponentInterface $component)
    {
        return Auth::user()->can('create_permission');
    }

    public function edit(ComponentInterface $component)
    {
        return Auth::user()->can('edit_permission');
    }

    public function delete(ComponentInterface $component)
    {
        return Auth::user()->can('delete_permission');
    }

    public function destroy(ComponentInterface $component)
    {
        return Auth::user()->can('destroy_permission');
    }

    public function restore(ComponentInterface $component)
    {
        return Auth::user()->can('restore_permission');
    }
}
