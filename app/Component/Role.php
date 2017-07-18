<?php


namespace App\Component;

use AdminColumn;
use AdminView;
use Sco\Admin\Component\Component;

class Role extends Component
{
    public function boot()
    {
        $this->title = trans('admin::admin.common.dashboard');
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