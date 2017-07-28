<?php


namespace App\Component;

use AdminColumn;
use AdminView;
use Sco\Admin\Component\Component;
use Sco\Admin\Component\Concerns\HasNavigation;
use Sco\Admin\Contracts\WithNavigation;

class Role extends Component implements WithNavigation
{
    use HasNavigation;

    protected $permissionObserver = \App\Observers\RoleObserver::class;

    protected $title = '角色';

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
            ->setIcon('fa fa-user-plus');
    }

    public function callView()
    {
        $view = AdminView::table()->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('display_name', 'Display Name')->setWidth(120),
            AdminColumn::datetime('created_at', 'Created At'),
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