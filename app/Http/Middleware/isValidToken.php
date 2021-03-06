<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class isValidToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * Only for GET requests. Otherwise, this middleware will block our registration.
         */
        if ($request->isMethod('get')) {

            /**
             * No token = Goodbye.
             */
            if (!$request->has('invitation_token')) {
                return redirect(route('home'));
            }else{
                $invitation_token = $request->get('invitation_token');
                $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
                if($invitation->user_registered_at != null){
                    return redirect(route('register'))->with('error', 'The invitation link has already been used.');
                }
            }



          

            // /**
            //  * Lets try to find invitation by its token.
            //  * If failed -> return to request page with error.
            //  */
            // try {
            //     $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
            // } catch (ModelNotFoundException $e) {
            //     return redirect(route('register'))
            //         ->with('error', 'Wrong invitation token! Please check your URL.');
            // }

            // /**
            //  * Let's check if users already registered.
            //  * If yes -> redirect to login with error.
            //  */
            // if (!is_null($invitation->registered_at)) {
            //     return redirect(route('login'))->with('error', 'The invitation link has already been used.');
            // }
        }

        return $next($request);
    }
}
