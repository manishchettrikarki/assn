<?php


  namespace Modules\Executive\Providers;


  use Illuminate\Support\ServiceProvider;
  use Modules\Executive\Repositories\Contracts\ExecutiveMemberContract;
  use Modules\Executive\Repositories\Contracts\MemberContract;
  use Modules\Executive\Repositories\Contracts\ExecutiveMessageContract;
  use Modules\Executive\Repositories\Eloquent\ExecutiveMessageRepository;
  use Modules\Executive\Repositories\Contracts\RegionalCoordinatorContract;
  use Modules\Executive\Repositories\Eloquent\ExecutiveMemberRepository;
  use Modules\Executive\Repositories\Eloquent\MemberRepository;
  use Modules\Executive\Repositories\Eloquent\RegionalCoordinatorRepository;

  class ExecutiveRepositoryServiceProvider extends ServiceProvider
  {
    public function boot()
    {

   }

    public function register()
    {
      $this->app->bind(ExecutiveMemberContract::class,ExecutiveMemberRepository::class);
      $this->app->bind(MemberContract::class, MemberRepository::class);
      $this->app->bind(RegionalCoordinatorContract::class, RegionalCoordinatorRepository::class);
      $this->app->bind(ExecutiveMessageContract::class, ExecutiveMessageRepository::class);
   }
  }
