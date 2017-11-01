<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaySubscription extends Model
{

    protected $table = 'dmmx_paysubscriptions';

    /**
	* To allow soft deletes
	*/
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function package()
    {
        return $this->belongsTo(Package::class, 'packageid');
    }

    /**
     * @todo time zone
     * @return bool
     */
    public function isActual()
    {
        return $this->pay_status
            && strtotime($this->SUBS_START_DATE) < time()
            && strtotime($this->SUBS_END_DATE) > time();
    }

}
