<?php


namespace App\Component;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use App\Observers\PostObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\WithNavigation;

class Post extends Component implements WithNavigation
{
    protected $permissionObserver = PostObserver::class;

    protected $title = '日志';

    public function callView()
    {
        $view = AdminView::table()->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('content', 'Content')->setWidth(120),
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
            AdminElement::text('name', 'Name'),
            AdminElement::textarea('content', 'Content')->setRows(5),
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