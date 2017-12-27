<?php


namespace App\Components;

use App\Components\Observers\PictureObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;
use Sco\Admin\Facades\AdminView;

class Picture extends Component
{
    protected $icon = 'fa-picture-o';

    protected $observer = PictureObserver::class;

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