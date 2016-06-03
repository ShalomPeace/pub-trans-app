<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $bindings = [
            App\Repositories\Contracts\OperatorRepositoryInterface::class => App\Repositories\OperatorRepository::class,
            App\Repositories\Contracts\ScheduleRepositoryInterface::class => App\Repositories\ScheduleRepository::class,
            App\Repositories\Contracts\StationRepositoryInterface::class  => App\Repositories\StationRepository::class,
            App\Repositories\Contracts\TrainRepositoryInterface::class    => App\Repositories\TrainRepository::class,
        ];

        foreach ($bindings as $contract => $repository) {
            $this->app->bind($contract, $repository);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
