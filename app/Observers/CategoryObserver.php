<?php

namespace App\Observers;

use Auth;
use Sco\Admin\Contracts\ComponentInterface;

class CategoryObserver
{
    public function view(ComponentInterface $component)
    {
        return Auth::user()->can('view_category');
    }

    public function create(ComponentInterface $component)
    {
        return Auth::user()->can('create_category');
    }

    public function edit(ComponentInterface $component)
    {
        return Auth::user()->can('edit_category');
    }

    public function delete(ComponentInterface $component)
    {
        return Auth::user()->can('delete_category');
    }

    public function destroy(ComponentInterface $component)
    {
        return Auth::user()->can('destroy_category');
    }

    public function restore(ComponentInterface $component)
    {
        return Auth::user()->can('restore_category');
    }
}