<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeesWatch extends Model
{
    use SoftDeletes;
    protected $table = 'dmmx_employees_watch';
}
