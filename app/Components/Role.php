<?php


namespace App\Components;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use Sco\Admin\Component\Component;

class Role extends Component
{
    protected $icon = 'fa-user-plus';

    protected $parentPageId = 'users';

    protected $observer = \App\Observers\RoleObserver::class;

    protected $title = '角色';

    public function model()
    {
        return \App\Role::class;
    }

    public function callView()
    {
        $view = AdminView::table()->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('display_name', 'Display Name')->setWidth(120),
            AdminColumn::datetime('created_at', 'Created At'),
        ])->disablePagination();
        return $view;
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit()
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
    public function callCreate()
    {
        return $this->callEdit();
    }
}