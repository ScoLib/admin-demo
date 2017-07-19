<?php


namespace App\Component;

use AdminColumn;
use AdminView;
use Sco\Admin\Component\Component;
use Sco\Admin\Component\Concerns\HasNavigation;
use Sco\Admin\Contracts\WithNavigation;

class Permission extends Component implements WithNavigation
{
    use HasNavigation;

    protected $permissionObserver = \App\Observers\PermissionObserver::class;

    protected $title = '权限';

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

    public function getColumns()
    {
        return [
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('display_name', 'Display Name')->setWidth(120),
            AdminColumn::datetime('created_at', 'Created At'),
        ];
    }

    public function callView()
    {
        $view = AdminView::table()
            ->setColumns($this->getColumns())
            ->disablePagination();

        return $view;
    }

    public function callCreate()
    {

    }
}