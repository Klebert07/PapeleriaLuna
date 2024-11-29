<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuración existente para ResetPassword
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        // Ejecutar migraciones en producción si es necesario
        if (App::environment('production')) {
            try {
                Artisan::call('migrate', ['--force' => true]);
                // Opcional: seeders en producción
                // Artisan::call('db:seed', ['--force' => true]);
            } catch (\Exception $e) {
                // Manejar cualquier error de migración
                \Log::error('Migration error: ' . $e->getMessage());
            }
        }
    }
}