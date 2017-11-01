<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Validator;

class EmployerController extends Controller
{
    public function verifyCompany()
    {
        //get the user 
        $user = Sentinel::getUser();
        $verificationRow = DB::table('company_verify')->where('companyid', $user->id)->first();
        //check company verification status
        return view('verifycompany', compact('verificationRow', 'user'));

    }

    public function submitCompanyDocs(Request $request)
    {
        //get the user 
        $user = Sentinel::getUser();

        if ($request->file('companyregistration') == null && $request->file('companydirector') == null && $request->file('companybill') == null) {
            return redirect()->back()->with('error', 'At least one document needs to be uploaded');
        }

        $this->validate($request, [
            'companyregistration' => 'max:8192',
            'companydirector' => 'max:8192',
            'companybill' => 'max:8192',
        ]);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        //check if any documents have been submitted already
        $verificationRow = DB::table('company_verify')->where('companyid', $user->id)->first();
        if ($verificationRow) {
            //save copy to history 
            $saveCopyHistory = DB::table('company_verify_history')->insert(
                ['companyid' => $verificationRow->companyid, 'path_registration' => $verificationRow->path_registration, 'path_directorid' => $verificationRow->path_directorid, 'path_utilitybill' => $verificationRow->path_utilitybill, 'verification_status' => $verificationRow->verification_status, 'created_at' => date('Y-m-d H:i:s')]
            );

            //get an increment to mark the new file name
            //count the number of records in the history table
            $countHistoryRecords = DB::table('company_verify_history')->where('companyid', $user->id)->count();

        }

        $disk = Storage::disk('gcs');

        $folderName = null;

        //save the files
        if ($request->file('companyregistration')) {
            $folderName = '/company_registration/';
            $mtype_company_reg = finfo_file($finfo, $request->file('companyregistration'));
            // die(var_dump($mtype_company_reg));
            if ($mtype_company_reg != 'application/pdf') {
                return redirect()->back()->with('error', 'Please upload a PDF version of the company registration documents');
            }
            $uniqueFileNameReg = $verificationRow ? md5($user->id . $countHistoryRecords) . "." . $request->file('companyregistration')->getClientOriginalExtension() : md5($user->id) . "." . $request->file('companyregistration')->getClientOriginalExtension();
            // $request->file('companyregistration')->move(base_path() . '/public/uploads/companydocs/companyregistration', $uniqueFileNameReg);
            $disk->put($folderName . $uniqueFileNameReg, file_get_contents($request->file('companyregistration')->path()));

            $disk->setVisibility($folderName . $uniqueFileNameReg, 'public');

            $company_reg_url = $disk->url($folderName . $uniqueFileNameReg);
        } else {
            $company_reg_url = '';
        }
        if ($request->file('companydirector')) {
            $folderName = '/director_identification/';
            $mtype_company_dir = finfo_file($finfo, $request->file('companydirector'));
            if ($mtype_company_dir != 'application/pdf') {
                return redirect()->back()->with('error', 'Please upload a PDF version of the company director documents');
            }
            $uniqueFileNameDirId = $verificationRow ? md5($user->id . $countHistoryRecords) . "." . $request->file('companydirector')->getClientOriginalExtension() : md5($user->id) . "." . $request->file('companydirector')->getClientOriginalExtension();
            // $request->file('companydirector')->move(base_path() . '/public/uploads/companydocs/directorid', $uniqueFileNameDirId);
            $disk->put($folderName . $uniqueFileNameDirId, file_get_contents($request->file('companydirector')->path()));

            $disk->setVisibility($folderName . $uniqueFileNameDirId, 'public');

            $director_id_url = $disk->url($folderName . $uniqueFileNameDirId);
        } else {
            $director_id_url = '';
        }
        if ($request->file('companybill')) {
            $folderName = '/utility_bill/';
            $mtype_company_bill = finfo_file($finfo, $request->file('companybill'));
            if ($mtype_company_bill != 'application/pdf') {
                return redirect()->back()->with('error', 'Please upload a PDF version of the company utility bill');
            }
            $uniqueFileNameBill = $verificationRow ? md5($user->id . $countHistoryRecords) . "." . $request->file('companybill')->getClientOriginalExtension() : md5($user->id) . "." . $request->file('companybill')->getClientOriginalExtension();
            // $request->file('companybill')->move(base_path() . '/public/uploads/companydocs/utilitybill', $uniqueFileNameBill);
            $disk->put($folderName . $uniqueFileNameBill, file_get_contents($request->file('companybill')->path()));

            $disk->setVisibility($folderName . $uniqueFileNameBill, 'public');

            $utility_bill_url = $disk->url($folderName . $uniqueFileNameBill);
        } else {
            $utility_bill_url = '';
            $uniqueFileNameBill = '';
        }

        if($verificationRow) {
            //update the old database record
            $insertDates = DB::table('company_verify')->where('companyid', $user->id)->update(['companyid' => $user->id, 'path_registration' => $company_reg_url, 'path_directorid' => $director_id_url, 'path_utilitybill' => $utility_bill_url, 'verification_status' => $verificationRow->verification_status, 'updated_at' => date('Y-m-d H:i:s')]);
            //update the company name:
            $updateCompanyName = DB::table('users')->where('id', $user->id)->update(['companyname' => $request->companyname, 'updated_at' => date('Y-m-d H:i:s')]);
        } else {
            //save the documents paths to the database
            $saveCopyHistory = DB::table('company_verify')->insert(
                ['companyid' => $user->id, 'path_registration' => $company_reg_url, 'path_directorid' => $director_id_url, 'path_utilitybill' => $utility_bill_url, 'verification_status' => 'pending', 'created_at' => date('Y-m-d H:i:s')]
            );
        }
        return redirect()->back()->with('success', 'Documents uploaded successfully.');
    }

    public function viewRegistration()
    {
        //get the user 
        $user = Sentinel::getUser();

        //get the verification row
        $verificationRow = DB::table('company_verify')->where('companyid', $user->id)->first();

        //Download the document
        return response()->download(base_path() . $verificationRow->path_registration);
    }

    public function viewDirectorId()
    {
        //get the user 
        $user = Sentinel::getUser();

        //get the verification row
        $verificationRow = DB::table('company_verify')->where('companyid', $user->id)->first();

        //Download the document
        return response()->download(base_path() . $verificationRow->path_directorid);
    }

    public function viewUtility()
    {
        //get the user 
        $user = Sentinel::getUser();

        //get the verification row
        $verificationRow = DB::table('company_verify')->where('companyid', $user->id)->first();

        //Download the document
        return response()->download(base_path() . $verificationRow->path_utilitybill);
    }

}
