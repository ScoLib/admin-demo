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
        $display = AdminDisplay::table();
        $display->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::link('name', 'Name')->setWidth(120),
            AdminColumn::text('slug', 'Slug')->setWidth(120),
            AdminColumn::text('order', 'Order')->setWidth(120),
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
            AdminElement::text('slug', 'Slug')->required(),
            AdminElement::number('order', 'Order')->setMax(200)->setStep(2),
            AdminElement::datetime('created_at', 'Created At'),
            //AdminElement::datetimerange(['dated', 'end_dated'], '日期'),
            //AdminElement::time('timed', '时间'),
            //AdminElement::timestamp('timestamp', '时间戳'),
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
