<?php


namespace App\Components;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use Sco\Admin\Component\Component;

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
            AdminColumn::text('id', 'ID')->setWidth(80)->isSortable(),
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
    public function callEdit()
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
        return $this->callEdit();
    }
}