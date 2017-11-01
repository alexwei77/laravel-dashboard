<?php

namespace App\Repositories;
use App\User;
use App\Models\Dashboard;
use Carbon\Carbon;

class DashboardRepository extends AbsRepository
{
    //check if row is there for this month 
    public function checkThisYearRow($employer_id)
    {
        $checkRow = Dashboard::whereYear('created_at',date('Y'))->where('user_id', $employer_id)->count();
        return $checkRow;
    }

    public function incrementSuccessfulCandidates($employer_id, $quantity)
    {
        $update_quatity = Dashboard::where('user_id',$employer_id)->increment('successful_applicants', $quantity);
        return $update_quatity;
    }

    public function incrementUnsuccessfulCandidates($employer_id, $quantity)
    {
        $update_quatity = Dashboard::where('user_id',$employer_id)->increment('unsuccessful_applicants', $quantity);
        return $update_quatity;
    }

    //insert new row 
     public function insertDashboardDataRow($employer_id, $candidate_searhes, $employees_joined, $employees_left, $successful_applicants, $unsuccessful_applicants)
    {
        $Dashboard = new Dashboard;
        $Dashboard->user_id = $employer_id;
        $Dashboard->candidate_searches = $candidate_searhes;
        $Dashboard->employees_joined = $employees_joined;
        $Dashboard->employees_left = $employees_left;
        $Dashboard->successful_applicants = $successful_applicants;
        $Dashboard->unsuccessful_applicants = $unsuccessful_applicants;
        $Dashboard->created_at = Carbon::now();
        $insert = $ActiveEmployeesCount->save();
        return $insert ;
    }

}
