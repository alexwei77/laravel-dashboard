<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scores extends Model
{
    use SoftDeletes;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scores';
}
