<?php


namespace App\Component;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use Sco\Admin\Component\Component;

class Picture extends Component
{
    protected $icon = 'fa-picture-o';

    protected $permissionObserver = \App\Observers\PictureObserver::class;

    protected $title = '图片';

    public function boot()
    {
        //$this->title = trans('admin::admin.common.dashboard');
    }

    public function callView()
    {
        $view = AdminView::table()->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::image('path', '图片')->setWidth(120),
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