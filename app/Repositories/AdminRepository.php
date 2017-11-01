<?php

namespace App\Repositories;

use App\Models\Admin;
use Cartalyst\Sentinel\Users\UserInterface;

class AdminRepository extends AbsRepository
{
    protected $target = Admin::class;


    /**
     * @param $email
     * @return null|Admin
     */
    public function getByEmail($email)
    {
        return $this->getModel()
            ->where('email', $email)
            ->where('status', 'Active')
            ->first();
    }

    public function getByUser(UserInterface $user)
    {
        return $this->getByEmail($user->email);
    }
}
