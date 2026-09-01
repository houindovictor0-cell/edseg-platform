<?php

namespace App\Providers;

use App\Models\ChiffreCle;
use App\Models\InfoEcole;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                $infosEcole = InfoEcole::all()->keyBy('cle');
                $chiffresEcole = ChiffreCle::avecComptagesLive();
            } catch (\Exception $e) {
                $infosEcole = collect();
                $chiffresEcole = collect();
            }
            $view->with(compact('infosEcole', 'chiffresEcole'));
        });
    }
}
