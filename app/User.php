<?php namespace App;

use App\Models\Admin;
use App\Models\EmployeesModel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;

use Eloquent;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Laravel\Cashier\Billable;

/**
 * Class User
 * @package App
 *
 * @property string $email
 * @property string $companyname
 * @property string $first_name
 * @property string $last_name
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $address
 * @property string $postal
 * @property string $password
 * @property string $pic
 * @property string $contact_number
 * @property string $website
 *
 */
class User extends EloquentUser implements Authenticatable
{

    use AuthenticableTrait;
    use Billable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes to be fillable from the model.
     *
     * A dirty hack to allow fields to be fillable by calling empty fillable array
     *
     * @var array
     */
    protected $fillable = [];
    protected $guarded = ['id'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * To allow soft deletes
     */
    use SoftDeletes;

    protected $dates = ['deleted_at', 'trial_ends_at'];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'userid');
    }

    public function employees()
    {
        return $this->belongsToMany(EmployeesModel::class, 'dmmx_employees_watch', 'companyid', 'employeeid')
            ->withPivot('watchstatus', 'created_at');
    }

}
