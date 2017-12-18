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
        $view = AdminView::table();
        $view->with('category');
        $view->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::text('title', 'Title')->setWidth(120),
            AdminColumn::text('category.name', 'Category')->setWidth(120),
            AdminColumn::text('content', 'Content')->setWidth(120),
            AdminColumn::custom('publish', 'Published', function (\App\Post $post) {
                return $post->published ? 'p' : 'u';
            }),
            AdminColumn::datetime('created_at', 'Created At')->setWidth(135),
        ]);
        $view->setFilters([
            AdminViewFilter::text('title', 'Title')->setOperator('like'),
            AdminViewFilter::select('category.id', '分类', Category::class)->setOptionsLabelAttribute('name')
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
            AdminElement::multiselect('content', 'Content', [
                'admin' => 'admin组',
                'test' => 'test组',
                'dev' => 'dev组',
            ]),
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