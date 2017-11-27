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

    public function callView()
    {
        $view = AdminView::tree()->setTitleAttribute('name');
        $view->orderBy('order');

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