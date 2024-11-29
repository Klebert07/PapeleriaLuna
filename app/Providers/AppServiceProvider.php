<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
            
            try {
                $connection = DB::connection()->getPdo();
                $connection->setAttribute(PDO::ATTR_TIMEOUT, 10);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Exception $e) {
                Log::error('Database connection error: ' . $e->getMessage());
            }
        }
    }
}