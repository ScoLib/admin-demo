<?php

namespace App\Component;

use AdminElement;
use AdminForm;
use AdminView;
use Sco\Admin\Component\Component;

class Category extends Component
{
    protected $observer = \App\Observers\CategoryObserver::class;

    protected $title = '分类';

    public function model()
    {
        return \App\Category::class;
    }

    public function callView()
    {
        $view = AdminView::tree()->setTitleAttribute('name');
        $view->orderBy('order');

        return $view;
    }

    /**
     * @param mixed $id
     *
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit($id)
    {
        return AdminForm::form()->setElements([
            AdminElement::text('name', 'Name')->required(),
            AdminElement::text('slug', 'Slug')->required(),
            AdminElement::number('order', 'Order')->setMax(200)->setStep(2),
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