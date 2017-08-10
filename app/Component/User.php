<?php


namespace App\Component;

use AdminColumn;
use AdminView;
use Sco\Admin\Component\Component;

class User extends Component
{
    protected $permissionObserver = \App\Observers\UserObserver::class;

    protected $title = '用户';

    public function boot()
    {
        //$this->title = trans('admin::admin.common.dashboard');
    }

    public function addToNavigation($priority = 100, $badge = null)
    {
        $page = $this->makePage($priority, $badge);
        $this->getNavigation()
            ->getPages()
            ->findById('users')
            ->addPage($page)
            ->setIcon('fa fa-user');
    }

    public function callView()
    {
        $view = AdminView::table();
        $view->with(['roles']);
        $view->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('email', 'Email')->setWidth(120),
            AdminColumn::lists('roles.display_name', 'Display Name')->setWidth(200),
            AdminColumn::datetime('created_at', 'Created At')->setFormat('humans'),
        ]);

        return $view;
    }

    public function callEdit()
    {

    }

    public function callCreate()
    {

    }
}