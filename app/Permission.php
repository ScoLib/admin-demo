<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;


class Permission extends EntrustPermission
{
    protected $guarded = ['created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'created'   => \Sco\ActionLog\Events\ModelWasCreated::class,
        'deleted'   => \Sco\ActionLog\Events\ModelWasDeleted::class,
        'restored'  => \Sco\ActionLog\Events\ModelWasRestored::class,
        'updated'   => \Sco\ActionLog\Events\ModelWasUpdated::class,
    ];
}
