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
        $view = AdminView::tree();
        $view->orderBy('id', 'desc');

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