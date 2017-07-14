<?php


namespace App\Component;

use Sco\Admin\Component\Component;

class Role extends Component
{
    public function boot()
    {
        $this->title = trans('admin.common.dashboard');
        $this->addToNavigation();
    }

    public function callView()
    {
        AdminView::table()->setColumns([
            AdminColumn::text(),
        ]);
    }

    public function callCreate()
    {

    }
}