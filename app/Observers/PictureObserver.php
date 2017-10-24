<?php

namespace App\Observers;

use Auth;
use Sco\Admin\Contracts\ComponentInterface;

class PictureObserver
{
    public function view(ComponentInterface $component)
    {
        return Auth::user()->can('view_picture');
    }

    public function create(ComponentInterface $component)
    {
        return Auth::user()->can('create_picture');
    }

    public function edit(ComponentInterface $component)
    {
        return Auth::user()->can('edit_picture');
    }

    public function delete(ComponentInterface $component)
    {
        return Auth::user()->can('delete_picture');
    }

    public function destroy(ComponentInterface $component)
    {
        return Auth::user()->can('destroy_picture');
    }

    public function restore(ComponentInterface $component)
    {
        return Auth::user()->can('restore_picture');
    }
}