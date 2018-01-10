<?php

namespace App\Components;

use App\Components\Observers\PictureObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\Form\FormInterface;
use Sco\Admin\Contracts\Display\DisplayInterface;
use Sco\Admin\Facades\AdminDisplay;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;

class Picture extends Component
{
    protected $icon = 'fa-picture-o';

    /**
     * The component display name
     *
     * @var string
     */
    protected $title = '图片';

    /**
     * Access observer class
     *
     * @var string
     */
    protected $observer = PictureObserver::class;

    public function model()
    {
        return \App\Picture::class;
    }

    /**
     * @return \Sco\Admin\Contracts\Display\DisplayInterface
     */
    public function callDisplay(): DisplayInterface
    {
        $display = AdminDisplay::image()->setImagePathAttribute('path');

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
            AdminElement::images('path', '图片')->required()->setUploadPath(function ($file) {
                return 'admin/pics';
            }),
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
