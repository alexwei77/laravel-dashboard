<?php

namespace App\Repositories;

use App\Models\PaySubscription;
use Cartalyst\Sentinel\Users\UserInterface;

class PaySubscriptionRepository extends AbsRepository
{
    protected $target = PaySubscription::class;

    public function getByUserId($user_id)
    {
        return $this->getModel()
            ->where('userid', $user_id)
            ->first();
    }

    public function getByUser(UserInterface $user)
    {
        return $this->getByUserId($user->id);
    }
}
