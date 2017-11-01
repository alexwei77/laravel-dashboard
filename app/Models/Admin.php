<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Admin
 * @package App\Models
 * @property int $userid
 */
class Admin extends Model
{
    use SoftDeletes;
    protected $table = 'dmmx_admins_table';
}
