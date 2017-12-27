<?php


namespace App\Components;

use App\Components\Observers\UserObserver;
use Illuminate\Http\UploadedFile;
use Sco\Admin\Component\Component;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;
use Sco\Admin\Facades\AdminView;
use Sco\Admin\Facades\AdminViewFilter;

class User extends Component
{
    protected $icon = 'fa-user';

    protected $parentPageId = 'users';

    protected $observer = UserObserver::class;

    protected $title = '用户';

    public function model()
    {
        return \App\User::class;
    }

    public function callView()
    {
        $view = AdminView::table();
        $view->with('roles');

        $view->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::image('avatar', 'Avatar')->setDisk('public'),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('email', 'Email')->setWidth(120),
            AdminColumn::tags('roles.display_name', 'Display Name')->setWidth(200),
            AdminColumn::datetime('created_at', 'Created At')->setFormat('humans'),
        ]);

        $view->setFilters([
            AdminViewFilter::text('id', 'ID'),
            AdminViewFilter::checkbox('role', '用户组', [
                [
                    'value' => 'admin',
                    'label' => '管理员',
                ],
            ]),
            AdminViewFilter::daterange('created_at', '注册起止时间'),
        ]);

        /*$view->setApplies(
            function ($query) {
                dump('sss');
            },
            function ($query) {
                dump('sss');
            },
            function ($query) {
                dump('sss');
            }
            );

        $a = $view->addApply(function ($query, $b) {
            dump('sss');
        });

        dump($view->getApplies());

        $view->setScopes([
            'unpublish', ['last', 3]
        ]);

        // $view->setScopes(
        //     'unpublish', ['last', 3]
        // );

        $a = $view->addScope('publish', 2);

        dd($view->getScopes());*/

        return $view;
    }

    public function callEdit()
    {
        return AdminForm::form()->setElements([
            AdminElement::text('name', 'Name')->required()->unique()->setMaxLength('10'),
            AdminElement::email('email', 'Email')->required()->unique(),
            AdminElement::password('password', 'Password')->required(),
            AdminElement::image('avatar', 'Avatar')
                ->setUploadFileNameRule(function (UploadedFile $file) {
                    return uniqid() . '.' . $file->guessExtension();
                })->setMaxFileSize(2 * 1024),
            AdminElement::checkbox('roles', 'Roles', \App\Role::class)
                ->setOptionsLabelAttribute('display_name'),

            /*AdminElement::multiselect('roles', 'Roles', \App\Role::class)
                ->setOptionsLabelAttribute('display_name'),*/
        ]);
    }

    public function callCreate()
    {
        return $this->callEdit();
    }
}