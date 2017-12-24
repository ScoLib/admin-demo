<?php


namespace App\Components;

use App\Category;
use App\Observers\PostObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\Form\FormInterface;
use Sco\Admin\Contracts\View\ViewInterface;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;
use Sco\Admin\Facades\AdminView;
use Sco\Admin\Facades\AdminViewFilter;

class Post extends Component
{
    /**
     * Permission observer class
     *
     * @var string
     */
    protected $observer = PostObserver::class;

    /**
     * Navigator title
     *
     * @var string
     */
    protected $title = '日志';

    /**
     * Navigator icon
     *
     * @var string
     */
    protected $icon = 'fa-book';

    public function model()
    {
        return \App\Post::class;
    }

    /**
     * @return \Sco\Admin\Contracts\View\ViewInterface
     */
    public function callView(): ViewInterface
    {
        $view = AdminView::table()->orderBy('id', 'desc');
        $view->with('category');
        $view->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::link('title', 'Title')->setWidth(120),
            AdminColumn::text('category.name', 'Category')->setWidth(120),
            AdminColumn::html('content', 'Content')->setWidth(120),
            AdminColumn::mapping('published', 'Published'),
            AdminColumn::datetime('created_at', 'Created At')->setWidth(135),
        ]);
        $view->setFilters([
            AdminViewFilter::text('title', 'Title')->setOperator('like'),
            AdminViewFilter::checkbox('category.id', '分类', Category::class)->setOptionsLabelAttribute('name'),
            AdminViewFilter::daterange('created_at', '创建时间'),
            AdminViewFilter::radio('published', '发布', [
                // '' => '全部',
                0 => '未发布',
                1 => '已发布'
            ])
        ]);
        return $view;
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callEdit(): FormInterface
    {
        return AdminForm::form()->setElements([
            AdminElement::text('title', 'Title')->required('必填')->unique('唯一'),
            AdminElement::select('category_id', '分类', Category::class)
                ->setOptionsLabelAttribute('name')
                ->required(),
            /*AdminElement::textarea('content', 'Content')
                ->setRows(5)
                ->required('Content必填'),*/
            /*AdminElement::checkbox('content', 'Content', [
                'admin' => 'admin组',
                'test' => 'test组',
                'dev' => 'dev组',
            ]),*/
            /*AdminElement::multiselect('content', 'Content', [
                'admin' => 'admin组',
                'test' => 'test组',
                'dev' => 'dev组',
            ]),*/
            //AdminElement::tinymce('content', 'Content'),
            AdminElement::markdown('content', 'Content'),
            AdminElement::elswitch('is_excellent', '推荐')->setTexts('是', '否'),
            AdminElement::elswitch('published', '发布'),
            AdminElement::datetimerange('created_at', 'updated_at', '起止时间')->required(),
        ]);
    }

    /**
     * @return \Sco\Admin\Contracts\Form\FormInterface
     */
    public function callCreate(): FormInterface
    {
        return $this->callEdit();
    }
}