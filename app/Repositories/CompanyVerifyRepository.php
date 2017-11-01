<?php

namespace App\Repositories;
use App\User;
use App\Models\CompanyVerify;
use Carbon\Carbon;

class CompanyVerifyRepository extends AbsRepository
{

    public static function companyVerified($userID, $checkVerificationStatus = false)
    {
        if($checkVerificationStatus === false) {
            $company_verify = CompanyVerify::where('companyid', $userID)->count();
            return $company_verify;
        } else {
            $company_verify = CompanyVerify::where('companyid', $userID)->first();
            if(isset($company_verify)) {
                $verification_status = $company_verify->verification_status == 'verified' ? 1 : 0;
            } else {
                $verification_status = 0;
            }
            return $verification_status;
        }
    }
}
