<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $dispatchesEvents = [
        'created'   => \Sco\ActionLog\Events\ModelWasCreated::class,
        'deleted'   => \Sco\ActionLog\Events\ModelWasDeleted::class,
        'restored'  => \Sco\ActionLog\Events\ModelWasRestored::class,
        'updated'   => \Sco\ActionLog\Events\ModelWasUpdated::class,
    ];
}
