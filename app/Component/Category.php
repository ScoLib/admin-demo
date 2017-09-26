<?php

namespace App\Component;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use Sco\Admin\Component\Component;

class Category extends Component
{
    protected $permissionObserver = \App\Observers\CategoryObserver::class;

    protected $title = '分类';

    public function callView()
    {
        $view = AdminView::table();
        //$view->with('roles');

        $view->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80)->isSortable(),
            AdminColumn::link('name', 'Name')->setWidth(120),
            AdminColumn::text('slug', 'Slug')->setWidth(120),
            AdminColumn::datetime('created_at', 'Created At'),
        ]);

        return $view;
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit()
    {
        return AdminForm::form()->setElements([
            AdminElement::text('name', 'Name')->required(),
            AdminElement::text('slug', 'Slug')->required(),
            AdminElement::select('pid', '父类', \App\Category::class)
                ->setOptionsLabelAttribute('name'),
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