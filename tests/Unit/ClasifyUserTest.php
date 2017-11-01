<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\AdminRepository;
use App\User;
use Illuminate\Support\Facades\Input;;
use App\Repositories\EmployeesRepository;

class ClasifyUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testExample()
    {
        $this->assertTrue(true);
    }*/

    /**
     * @param userid
     * @return userClass
     */

    public function testClassifyUser()
    {
       $input = User::where('id', 196)
                       ->first();
         $super_admin_check = AdminRepository::checkSuperAdmin($input->id);
         $supporting_admin_check = AdminRepository::checkSupportingAdmin($input->email);
         //$stafflife_admin_check = 1;//$input->isAdmin();
         $employee_check = EmployeesRepository::checkIfEmployee($input->email);

         if($super_admin_check){
            $user_class = "Super Admin";
         }elseif($supporting_admin_check){
            $user_class = "Supporting HR";
         }
         elseif($employee_check){
            $user_class = "Employee";
         }
         else{
            $user_class = "StaffLife Admin";
         }
            $classes_array = ["Super Admin", "Supporting HR", "Employee", "StaffLife Admin"];
           $this->assertTrue(in_array($user_class,$classes_array));
           //dd($user_class);
    }
}
