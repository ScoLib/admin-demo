<?php

namespace App\Components;

use App\Category;
use App\Components\Observers\PostObserver;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\Form\FormInterface;
use Sco\Admin\Contracts\Display\DisplayInterface;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminDisplay;
use Sco\Admin\Facades\AdminDisplayFilter;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;

class Post extends Component
{
    /**
     * The page icon class name.
     *
     * @var string|null
     */
    protected $icon = 'fa-book';

    /**
     * The component display name
     *
     * @var string
     */
    protected $title = '日志';

    /**
     * Access observer class
     *
     * @var string
     */
    protected $observer = PostObserver::class;

    public function model()
    {
        return \App\Post::class;
    }

    /**
     * @return \Sco\Admin\Contracts\Display\DisplayInterface
     */
    public function callDisplay(): DisplayInterface
    {
        $display = AdminDisplay::table()->orderBy('id', 'desc');

        $display->with('category');
        $display->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::link('title', 'Title')->setWidth(120),
            AdminColumn::text('category.name', 'Category')->setWidth(120),
            AdminColumn::html('content', 'Content')->setWidth(120),
            AdminColumn::mapping('is_excellent', 'IsExcellent'),
            AdminColumn::mapping('published', 'Published'),
            AdminColumn::datetime('created_at', 'Created At')->setWidth(135),
        ]);

        $display->setFilters([
            AdminDisplayFilter::text('title', 'Title')->setOperator('like'),
            AdminDisplayFilter::checkbox('category.id', '分类', Category::class)
                ->setOptionsLabelAttribute('name'),
            AdminDisplayFilter::daterange('created_at', '创建时间'),
            AdminDisplayFilter::radio('published', '发布', [
                // '' => '全部',
                0 => '未发布',
                1 => '已发布'
            ])
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
        return $this->callEdit(null);
    }
}
