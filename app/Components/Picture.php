<?php


namespace App\Components;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use Sco\Admin\Component\Component;

class Picture extends Component
{
    protected $icon = 'fa-picture-o';

    protected $observer = \App\Observers\PictureObserver::class;

    protected $title = '图片';

    public function model()
    {
        return \App\Picture::class;
    }

    public function callView()
    {
        $view = AdminView::image()->setImagePathAttribute('path');
        return $view;
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit()
    {
        return AdminForm::form()->setElements([
            AdminElement::text('name', 'Name')->required()->unique(),
            AdminElement::image('path', '图片')->required(),
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