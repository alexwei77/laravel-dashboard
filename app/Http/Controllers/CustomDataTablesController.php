<?php
namespace App\Http\Controllers;

use App\Datatable;
use Illuminate\Http\Request;
use Datatables;

class CustomDataTablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $professions=Datatable::pluck('job','id');
        $max_count =Datatable::all()->count();   // We can pass max count for slider
        
        return view('admin.examples.custom_datatables',compact('professions','max_count'));
    }

    public function sliderData(Request $request)
    {
        if ($request->idSlider!=null){
            $tables = Datatable::whereBetween('id',$request->idSlider)->get(['id', 'firstname', 'lastname', 'email','job','age']);
        }else {
            $tables = Datatable::get(['id', 'firstname', 'lastname', 'email', 'job', 'age']);
        }

        return Datatables::of($tables)
            ->make(true);
    }
    public function radioData(Request $request)
    {
        if ($request->ageRadio!=null){
            if($request->ageRadio < 100){
                $tables = Datatable::where('age','<=', $request->ageRadio)->get(['id', 'firstname', 'lastname', 'email','job','age']);
            }
            else {
                $tables = Datatable::where('age','>', 50)->get(['id', 'firstname', 'lastname', 'email','job','age']);
            }

        }else {
            $tables = Datatable::get(['id', 'firstname', 'lastname', 'email', 'job', 'age']);
        }

        return Datatables::of($tables)
            ->make(true);
    }
    public function selectData(Request $request)
    {
        if ($request->professionSelect!=null) {
            $tables = Datatable::where('id',$request->professionSelect);
        }else {
            $tables = Datatable::get(['id', 'firstname', 'lastname', 'email', 'job', 'age']);
        }

        return Datatables::of($tables)
            ->make(true);
    }
    public function buttonData(Request $request)
    {
        if ($request->jobButton!=null) {
            $tables=Datatable::where('gender',$request->jobButton)->get(['id', 'firstname', 'lastname', 'email', 'job', 'age','gender']);
        }else {
            $tables = Datatable::get(['id', 'firstname', 'lastname', 'email', 'job', 'age','gender']);
        }

        return Datatables::of($tables)
            ->make(true);
    }

    public function totalData(Request $request)
    {
        $tables = Datatable::where(function ($query) use ($request) {
            if ($request->has('idSlider2') && $request->idSlider2!=null){
                $query->whereBetween('id',$request->idSlider2);
            }
               if ($request->has('ageRadio2') && $request->ageRadio2 != null) {
                   if($request->ageRadio2 < 100){
                       $query->where('age', '<=', $request->ageRadio2);
                   }
                   else {
                       $query->where('age', '>', 50);
                   }
                    $query->where('age', '<=', $request->ageRadio2);
                }
                if ($request->has('professionSelect2') && $request->professionSelect2 != null) {
                    $query->where('id', $request->professionSelect2);
                }
                if ($request->has('jobButton2') && $request->jobButton2 != null) {
                    $query->where('gender', $request->jobButton2);
                }
            })->get(['id', 'firstname', 'lastname', 'email','job','age','gender']);

        return Datatables::of($tables)
            ->make(true);
    }
}
