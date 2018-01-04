<?php

namespace App\Components;

use App\Components\Observers\RoleObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\Form\FormInterface;
use Sco\Admin\Contracts\Display\DisplayInterface;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminDisplay;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;

class Role extends Component
{
    protected $icon = 'fa-user-plus';

    protected $parentPageId = 'users';

    /**
     * The component display name
     *
     * @var string
     */
    protected $title = '角色';

    /**
     * Access observer class
     *
     * @var string
     */
    protected $observer = RoleObserver::class;

    public function model()
    {
        return \App\Role::class;
    }

    /**
     * @return \Sco\Admin\Contracts\Display\DisplayInterface
     */
    public function callDisplay(): DisplayInterface
    {
        $display = AdminDisplay::table();

        $display->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('display_name', 'Display Name')->setWidth(120),
            AdminColumn::text('description', 'Description')->setWidth(120),
            AdminColumn::datetime('created_at', 'Created At'),
        ])->disablePagination();

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
            AdminElement::text('name', 'Name')->required()->unique(),
            AdminElement::text('display_name', 'Display Name')->required(),
            AdminElement::textarea('description', 'Description')->setRows(5),
            /*AdminElement::tree('description', 'Description', [
                [
                    'id' => 1,
                    'label' => '访问后台',
                    'parent_id' => '',
                ],
                [
                    'id' => 2,
                    'label' => '查看用户',
                    'parent_id' => '1',

                ],[
                    'id' => 3,
                    'label' => '创建用户',
                    'parent_id' => '2',

                ],[
                    'id' => 4,
                    'label' => '编辑用户',
                    'parent_id' => '1',

                ],[
                    'id' => 5,
                    'label' => '删除用户',
                    'parent_id' => '4',

                ]]),*/
            AdminElement::tree('perms', 'Perms', \App\Permission::class)
                ->setNodesModelLabelAttribute('display_name')
                ->required(),
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
