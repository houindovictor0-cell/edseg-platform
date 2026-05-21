<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name'           => ['required', 'string', 'max:255'],
        'prenom'         => ['required', 'string', 'max:100'],
        'nom'            => ['required', 'string', 'max:100'],
        'email'          => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password'       => ['required', 'confirmed', Rules\Password::defaults()],
        'role_souhaite'  => ['required', 'in:doctorant,enseignant'],
    ]);

    $user = User::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'password'    => Hash::make($request->password),
        'is_approved' => false, // en attente de validation
    ]);

    // Stocker le rôle souhaité pour que l'admin puisse l'attribuer
    $user->update(['role_souhaite' => $request->role_souhaite]);

    // Ne pas connecter automatiquement — compte non validé
    return redirect()->route('login')
        ->with('status', 'Votre demande de compte a été soumise. Un administrateur examinera votre dossier et vous serez notifié par email dès que votre accès sera activé.');
}
}

