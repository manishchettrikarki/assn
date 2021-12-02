<?php


  namespace Modules\Event\Providers;


  use Illuminate\Support\ServiceProvider;
  use Modules\Event\Repositories\Contracts\EventContract;
  use Modules\Event\Repositories\Eloquent\EventRepository;

  class EventRepositoryServiceProvider extends ServiceProvider
  {
    public function register()
    {
      $this->app->bind(EventContract::class, EventRepository::class);
    }

    public function boot()
    {

    }
  }
