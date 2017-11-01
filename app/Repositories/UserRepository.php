<?php

namespace App\Repositories;

use App\User;
use Cartalyst\Sentinel\Users\UserInterface;
use Sentinel;
use Carbon\Carbon;

class UserRepository extends AbsRepository
{
    protected $target = User::class;

    /**
     * @param $user_id
     * @return null|User|UserInterface
     */
    public function getById($user_id)
    {
        return $this->getModel()
            ->where('id', $user_id)
            ->first();
    }

    public function getByEmail($email)
    {
        return $this->getModel()
            ->where('email', $email)
            ->first();
    }

     /**
     * Check how many days to expiry
     *
     * @return bool
     */
    public static function reachedCritical()
    {
        $user = Sentinel::getUser();

        //do the check for supporting admin (think not needed)
        //check if trial has entered the alert period (three days to expiry and beyond)
        $trial_ends_at = $user->trial_ends_at;
        $expiry_less_3days = $trial_ends_at->subDays(3);
        $expiry_passed_check = Carbon::now()->gt(($expiry_less_3days));
        return $expiry_passed_check;
    }
}
