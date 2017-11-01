<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Redirect;
use Vsmoraes\Pdf\Pdf;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContractRequested;
use App;
use Chat;

class HelpCenter extends Controller
{
    public function history(){
          return view('inbox');
    }

    public function compose(){
        return view('compose');
    }

    public function view_message(){
        return view('view_message');
    }

    public function sendMessage(){
        $user = Sentinel::getUser();
        $conversation = Chat::createConversation([$user->id, 2]); //takes an array of user ids
        Chat::send(1, $_REQUEST['message'], 2);

        return Redirect::back()->with('success', 'Message sent');
    }
}
