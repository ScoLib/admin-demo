<?php

namespace App\Components\Observers;

use Sco\Admin\Contracts\ComponentInterface;

class CategoryObserver
{
    public function display(ComponentInterface $component)
    {
        return true;
    }

    public function create(ComponentInterface $component)
    {
        return true;
    }

    public function edit(ComponentInterface $component)
    {
        return true;
    }

    public function delete(ComponentInterface $component)
    {
        return true;
    }

    public function destroy(ComponentInterface $component)
    {
        return true;
    }

    public function restore(ComponentInterface $component)
    {
        return true;
    }
}
