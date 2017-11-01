<?php

namespace App\Repositories;
use App\User;
use App\Models\ActiveEmployeesCount;
use Carbon\Carbon;

class EmployeesCountRepository extends AbsRepository
{
    public function insertEmployeeCount($employer_id, $quantity)
    {
        $ActiveEmployeesCount = new ActiveEmployeesCount;
        $ActiveEmployeesCount->userid = $employer_id;
        $ActiveEmployeesCount->employees_quantity = $quantity;
        $ActiveEmployeesCount->date = Carbon::parse(Carbon::now())->format('Y-m-d');
        $ActiveEmployeesCount->created_at = Carbon::now();
        $insert = $ActiveEmployeesCount->save();
        return $insert ;
    }

    public function updateEmployeeCount($employer_id, $quantity)
    {
        $update_quatity = ActiveEmployeesCount::where('userid',$employer_id)->increment('employees_quantity', $quantity);//DB::table('company_verify')->where('companyid',$userID)->first();
        return $update_quatity ;
    }

    //check if row is there for this month 
    public function checkThisMonthRow($employer_id)
    {
        $checkRow = ActiveEmployeesCount::whereMonth('created_at',date('m'))->where('userid', $employer_id)->count();//DB::table('company_verify')->where('companyid',$userID)->first();
        return $checkRow ;
    }
}
