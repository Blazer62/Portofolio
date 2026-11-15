<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\ServiceProvider;

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
        $this->fixWindowsServeCommand();
    }

    /**
     * Perbaikan untuk `php artisan serve` di Windows.
     *
     * Sejak Laravel 13, `artisan serve` menjalankan PHP server sebagai proses anak
     * dan hanya meneruskan variabel environment yang namanya ada di
     * ServeCommand::$passthroughVariables. Laravel menulisnya sebagai "SYSTEMROOT",
     * sementara Windows memberi nama variabel tersebut "SystemRoot".
     *
     * Pencocokannya memakai in_array() yang case-sensitive, sehingga SystemRoot
     * dianggap bukan variabel yang boleh diteruskan lalu dihapus dari proses anak.
     * Tanpa SystemRoot, Winsock tidak bisa membuat socket dan server gagal start:
     *
     *   Failed to listen on 127.0.0.1:8000 (reason: ?)
     */
    protected function fixWindowsServeCommand(): void
    {
        if (PHP_OS_FAMILY !== 'Windows') {
            return;
        }

        foreach (array_keys($_ENV) as $key) {
            if (strcasecmp((string) $key, 'SYSTEMROOT') === 0
                && ! in_array($key, ServeCommand::$passthroughVariables, true)) {
                ServeCommand::$passthroughVariables[] = $key;
            }
        }

        // Jangan teruskan APP_ENV ke proses anak.
        //
        // Proses induk sudah memuat .env sehingga $_ENV berisi APP_ENV=local.
        // Nilai itu ikut diteruskan, lalu Laravel di dalam proses anak mengira
        // harus memakai file ".env.local" (yang dibuat otomatis oleh `vercel link`
        // dan hanya berisi VERCEL_OIDC_TOKEN, tanpa APP_KEY). Akibatnya muncul:
        //
        //   Illuminate\Encryption\MissingAppKeyException: No application encryption key has been specified.
        //
        // Dengan APP_ENV tidak diteruskan, proses anak membaca ".env" seperti biasa.
        ServeCommand::$passthroughVariables = array_values(array_filter(
            ServeCommand::$passthroughVariables,
            static fn (string $variable): bool => $variable !== 'APP_ENV'
        ));
    }
}
