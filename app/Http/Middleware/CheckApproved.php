<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_approved) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Votre compte est en attente de validation par un administrateur. Vous serez notifié par email dès que votre accès sera activé.');
        }

        return $next($request);
    }
}

