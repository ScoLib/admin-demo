<?php

namespace App\Components\Observers;

use Auth;
use Sco\Admin\Contracts\ComponentInterface;

class RoleObserver
{
    public function view(ComponentInterface $component)
    {
        return Auth::user()->can('view_role');
    }

    public function create(ComponentInterface $component)
    {
        return Auth::user()->can('create_role');
    }

    public function edit(ComponentInterface $component)
    {
        return Auth::user()->can('edit_role');
    }

    public function delete(ComponentInterface $component)
    {
        return Auth::user()->can('delete_role');
    }

    public function destroy(ComponentInterface $component)
    {
        return Auth::user()->can('destroy_role');
    }

    public function restore(ComponentInterface $component)
    {
        return Auth::user()->can('restore_role');
    }
}