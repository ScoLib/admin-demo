<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $dispatchesEvents = [
        'created'   => \Sco\ActionLog\Events\ModelWasCreated::class,
        'deleted'   => \Sco\ActionLog\Events\ModelWasDeleted::class,
        'restored'  => \Sco\ActionLog\Events\ModelWasRestored::class,
        'updated'   => \Sco\ActionLog\Events\ModelWasUpdated::class,
    ];
}
