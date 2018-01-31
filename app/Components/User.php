<?php

namespace App\Components;

use App\Components\Observers\UserObserver;
use Illuminate\Http\UploadedFile;
use Sco\Admin\Component\Component;
use Sco\Admin\Contracts\Form\FormInterface;
use Sco\Admin\Contracts\Display\DisplayInterface;
use Sco\Admin\Facades\AdminColumn;
use Sco\Admin\Facades\AdminDisplay;
use Sco\Admin\Facades\AdminDisplayFilter;
use Sco\Admin\Facades\AdminElement;
use Sco\Admin\Facades\AdminForm;

class User extends Component
{
    protected $icon = 'fa-user';

    protected $parentPageId = 'users';

    /**
     * The component display name
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Access observer class
     *
     * @var string
     */
    protected $observer = UserObserver::class;

    public function model()
    {
        return \App\User::class;
    }

    /**
     * @return \Sco\Admin\Contracts\Display\DisplayInterface
     */
    public function callDisplay(): DisplayInterface
    {
        $display = AdminDisplay::table()->orderBy('id', 'desc');
        $display->with('roles');

        $display->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(80),
            AdminColumn::image('avatar', 'Avatar')->setDisk('public'),
            AdminColumn::text('name', 'Name')->setWidth(120),
            AdminColumn::text('email', 'Email')->setWidth(120),
            AdminColumn::tags('roles.display_name', 'Display Name')->setWidth(200),
            AdminColumn::datetime('created_at', 'Created At')->setFormat('humans'),
        ]);

        $display->setFilters([
            AdminDisplayFilter::text('id', 'ID'),
            AdminDisplayFilter::checkbox('role', '用户组', [
                [
                    'value' => 'admin',
                    'label' => '管理员',
                ],
            ]),
            AdminDisplayFilter::daterange('created_at', '注册起止时间'),
        ]);

        /*$display->setApplies(
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

        $a = $display->addApply(function ($query, $b) {
            dump('sss');
        });

        dump($display->getApplies());

        $display->setScopes([
            'unpublish', ['last', 3]
        ]);

        //$display->setScopes(
        //     'unpublish', ['last', 3]
        // );

        $a = $display->addScope('publish', 2);

        dd($display->getScopes());*/

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
            AdminElement::text('name', 'Name')->required()->unique()->setMaxLength('10'),
            AdminElement::email('email', 'Email')->required()->unique(),

            AdminElement::password('password', 'Password')
                ->required()
                ->notRequiredWithUpdate(),

            AdminElement::image('avatar', 'Avatar')
                ->setUploadFileNameRule(function (UploadedFile $file) {
                    return uniqid() . '.' . $file->guessExtension();
                })->setMaxFileSize(2 * 1024),

            AdminElement::checkbox('roles', 'Roles', \App\Role::class)
                ->setOptionsLabelAttribute('display_name'),

            /*AdminElement::multiselect('roles', 'Roles', \App\Role::class)
                ->setOptionsLabelAttribute('display_name'),*/
            //AdminElement::datetime('created_at', 'CreatedAt')->required(),
            //AdminElement::datetime('updated_at', 'UpdatedAt')->required(),

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
