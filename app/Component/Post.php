<?php


namespace App\Component;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use App\Category;
use App\Observers\PostObserver;
use Sco\Admin\Component\Component;

class Post extends Component
{
    protected $permissionObserver = PostObserver::class;

    protected $title = '日志';

    public function callView()
    {
        $view = AdminView::table();
        $view->with('category');
        $view->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('category.name', 'Category')->setWidth(120),
            AdminColumn::text('content', 'Content')->setWidth(120),
            AdminColumn::datetime('created_at', 'Created At')->setWidth(135),
        ]);
        return $view;
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit()
    {
        return AdminForm::form()->setElements([
            AdminElement::text('name', 'Name')->required('必填')->unique('唯一'),
            AdminElement::select('category_id', '分类', Category::class)
                ->setOptionsLabelAttribute('name')
                ->required(),
            AdminElement::textarea('content', 'Content')->setRows(5)->required('Content必填'),
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