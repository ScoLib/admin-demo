<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Picture
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picture whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picture wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Picture whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Picture extends Model
{
    //
}
