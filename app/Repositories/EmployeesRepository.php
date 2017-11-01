<?php

namespace App\Repositories;

use App\Models\EmployeesWatch;
use Cartalyst\Sentinel\Users\UserInterface;
use App\Models\EmployeesModel;

class EmployeesRepository extends AbsRepository
{
   /**
     * @param $employeeid
     * @return counter
     */
    public function getByEmail($employeeid)
    {
        return $this->getModel()
            ->where('email', $email)
            ->where('status', 'Active')
            ->first();
    }

    public function deleteEmployee($employeeid)
    {
       $delete_status = EmployeesWatch::where('employeeid', $employeeid)->delete();
       //$delete_employee = EmployeesModel::where('idnumber', $employeeid)->delete();
       return ($delete_status);
    }

    public function countWatchingCompanies($employeeid){
        $count_watching_companies_count = EmployeesWatch::where('employeeid', $employeeid)->count();
        return $count_watching_companies_count;
    }
}
