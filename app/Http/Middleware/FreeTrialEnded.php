<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use App\Repositories\AdminRepository;

class FreeTrialEnded
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Sentinel::getUser();
        if (!$user->onGenericTrial()) {
            //check if user is supporting admin 
            $adminMethod = new AdminRepository();
            $adminUser = $adminMethod->getByUser($user);
          
            $user1 = isset($adminUser) ? Sentinel::findUserById($adminUser->userid) : Sentinel::findUserById($user->id);
            if(count($user1->subscriptions)==0){
              return redirect('trial-expired');
            }
        }

        return $next($request);
    }
}
