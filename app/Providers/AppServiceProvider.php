<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\InfoEcole;
use App\Models\ChiffreCle;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                $infosEcole   = InfoEcole::all()->keyBy('cle');
                $chiffresEcole = ChiffreCle::orderBy('ordre')->get()->keyBy('cle');
            } catch (\Exception $e) {
                $infosEcole   = collect();
                $chiffresEcole = collect();
            }
            $view->with(compact('infosEcole', 'chiffresEcole'));
        });
    }
}
