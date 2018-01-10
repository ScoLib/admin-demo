<?php

namespace App\Components;

use App\Components\Observers\CategoryObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\Form\FormInterface;
use Sco\Admin\Contracts\Display\DisplayInterface;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminDisplay;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;

class Category extends Component
{
    /**
     * The page icon class name.
     *
     * @var string|null
     */
    protected $icon;

    /**
     * The component display name
     *
     * @var string
     */
    protected $title = '分类';

    /**
     * Access observer class
     *
     * @var string
     */
    protected $observer = CategoryObserver::class;

    public function model()
    {
        return \App\Category::class;
    }

    /**
     * @return \Sco\Admin\Contracts\Display\DisplayInterface
     */
    public function callDisplay(): DisplayInterface
    {
        $display = AdminDisplay::tree()->setTitleAttribute('name');
        $display->orderBy('order');

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
            AdminElement::text('slug', 'Slug')->required(),
            AdminElement::number('order', 'Order')->setMax(200)->setStep(2),
            AdminElement::time('created_at', 'Created At'),
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
