<?php declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NewRelicServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->isEnabled()) {
            return;
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->isEnabled()) {
            return;
        }

        $app_name
            = env('NEWRELIC_APP_NAME')
            ?? config('app.name')
            ?? 'Unknown Laravel/Lumen App';

        $this->setAppName($app_name);
    }

    protected function isEnabled()
    {
        return extension_loaded('newrelic');
    }

    protected function setAppName(string $name)
    {
        \newrelic_set_appname($name);
    }
}
