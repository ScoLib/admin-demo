<?php


namespace App\Components;

use Sco\Admin\Component\Component;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;
use Sco\Admin\Facades\AdminView;

class Permission extends Component
{
    protected $icon = 'fa-user';

    protected $parentPageId = 'users';

    protected $observer = \App\Observers\PermissionObserver::class;

    protected $title = '权限';

    public function model()
    {
        return \App\Permission::class;
    }

    public function callView()
    {
        $view = AdminView::table();
        //$view->with('roles');

        $view->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80)->sortable(),
            AdminColumn::link('name', 'Name')->setWidth(120),
            AdminColumn::text('display_name', 'Display Name')->setWidth(120),
            AdminColumn::datetime('created_at', 'Created At'),
            //AdminColumn::tags('roles.display_name', 'Roles'),
        ]);

        return $view;
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit($id)
    {
        return AdminForm::form()->setElements([
            AdminElement::text('name', 'Name'),
            AdminElement::text('display_name', 'Display Name'),
            AdminElement::textarea('description', 'Description')->setRows(5),
        ]);
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callCreate()
    {
        return $this->callEdit(null);
    }
}