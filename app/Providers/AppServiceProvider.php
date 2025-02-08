<?php

namespace App\Providers;

use App\Models\tanzaniaAndWorldEvents\tanzaniaAndWorldEvents;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\tourPackageType\tourPackageType;
use App\Models\TourTypes\tourTypes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Laravel\Horizon\Horizon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        //ServerProvider::class => DigitalOceanServerProvider::class,
    ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        //DowntimeNotifier::class => PingdomDowntimeNotifier::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        /*
         * Application locale defaults for various components
         *
         * These will be overridden by LocaleMiddleware if the session local is set
         */

        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^([a-zA-Z \']*)$/', $value);
        });

        /*
         * setLocale for php. Enables ->formatLocalized() with localized values for dates
         */
        setlocale(LC_TIME, config('app.locale_php'));

        /*
         * setLocale to use Carbon source locales. Enables diffForHumans() localized
         */
        Carbon::setLocale(config('app.locale'));
        /**
         * Usage :
         * @env('local') @elseenv('testing') @else @endenv
         */
        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });
        Horizon::auth(function ($request) {
            // Always show admin if local development
            if (env('APP_ENV') == 'local') {
                return true;
            }
        });

        View::composer('includes/components/footer', function ($view) {
            $events = tanzaniaAndWorldEvents::where('status', 1)
                ->orderBy('id', 'DESC')
                ->get();

            $tourPackageTypes = tourPackageType::where('status', 1)
                ->orderBy('id', 'DESC')
                ->get();
            $touristicAttractions=touristicAttractions::query()
                ->where('status','=',1)
                ->orderBy('id','desc')
                ->take(3)
                ->get();
            $tourTypes=tourTypes::query()->where('status','=',1)->orderBy('id','DESC')->get();


            $view->with([
                'tourTypes' => $tourTypes,
                'events' => $events,
                'touristicAttractions' => $touristicAttractions,
                'tourPackageTypes' => $tourPackageTypes,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
//            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
//            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
            $this->app->register(\Orangehill\Iseed\IseedServiceProvider::class);
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
        //
    }
}
