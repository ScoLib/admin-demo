<?php

namespace App\Components;

use App\Components\Observers\PermissionObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\Form\FormInterface;
use Sco\Admin\Contracts\Display\DisplayInterface;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminDisplay;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;

class Permission extends Component
{
    /**
     * The page icon class name.
     *
     * @var string|null
     */
    protected $icon = 'fa-user';

    protected $parentPageId = 'users';

    /**
     * The component display name
     *
     * @var string
     */
    protected $title = '权限';

    /**
     * Access observer class
     *
     * @var string
     */
    protected $observer = PermissionObserver::class;

    public function model()
    {
        return \App\Permission::class;
    }

    /**
     * @return \Sco\Admin\Contracts\Display\DisplayInterface
     */
    public function callDisplay(): DisplayInterface
    {
        $display = AdminDisplay::table();
        //$display->with('roles');

        $display->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80)->enableSortable(),
            AdminColumn::link('name', 'Name')->setWidth(120),
            AdminColumn::text('display_name', 'Display Name')->setWidth(120),
            AdminColumn::text('description', 'Description'),
            AdminColumn::datetime('created_at', 'Created At'),
            //AdminColumn::tags('roles.display_name', 'Roles'),
        ]);

        return $display;
    }

    /**
     * @param mixed $id
     *
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit($id): FormInterface
    {
        return AdminForm::form()->setElements([
            AdminElement::text('name', 'Name')->required(),
            AdminElement::text('display_name', 'Display Name')->required(),
            AdminElement::textarea('description', 'Description')->setRows(5),
        ]);
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callCreate(): FormInterface
    {
        return $this->callEdit(null);
    }
}
