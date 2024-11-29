<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use PDO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Forzar HTTPS en producción
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
            
            // Configuración de timeouts para base de datos
            try {
                DB::connection()->getPdo()->setAttribute(PDO::ATTR_TIMEOUT, 10);
            } catch (\Exception $e) {
                // Log any connection issues
                \Log::error('Database connection timeout configuration failed: ' . $e->getMessage());
            }
        }
    }
}