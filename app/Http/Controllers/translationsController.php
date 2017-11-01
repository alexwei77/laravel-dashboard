<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class translationsController extends Controller
{
   public function translations(){
        return view('vendor.translation-manager.index', compact('user'));
   }
   
}
