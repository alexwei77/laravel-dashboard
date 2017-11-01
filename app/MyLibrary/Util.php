<?php
namespace App\MyLibrary;

class Util {
    public function moddedRedirect ($custom_route) {
        $gclid_str = '';
        if(isset($_REQUEST['gclid'])) {
            $gclid_str = '?gclid=' . $_REQUEST['gclid'];
        }
        return redirect($custom_route.$gclid_str);
    }
}