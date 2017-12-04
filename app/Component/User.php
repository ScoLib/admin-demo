<?php


namespace App\Component;

use AdminColumn;
use AdminElement;
use AdminForm;
use AdminView;
use Illuminate\Http\UploadedFile;
use Sco\Admin\Component\Component;

class User extends Component
{
    protected $icon = 'fa-user';

    protected $parentPageId = 'users';

    protected $observer = \App\Observers\UserObserver::class;

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

        $view->setApply(function ($query) {
            dump('sss');
        });

        $view->setApplies([
            function ($query) {
                dump('sss');
            },
            function ($query) {
                dump('sss');
            }
        ]);


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
            AdminElement::multiselect('roles', 'Roles', \App\Role::class)->setOptionsLabelAttribute('name'),
        ]);
    }

    public function callCreate()
    {
        return $this->callEdit();
    }
}