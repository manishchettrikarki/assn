<?php


namespace Modules\Gallery\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Gallery\Repositories\Contracts\AlbumContract;
use Modules\Gallery\Repositories\Eloquent\AlbumRepository;
use Modules\Gallery\Repositories\Contracts\AlbumImageContract;
use Modules\Gallery\Repositories\Eloquent\AlbumImageRepository;

class GalleryRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AlbumContract::class, AlbumRepository::class);
        $this->app->bind(AlbumImageContract::class,AlbumImageRepository::class);
    }

    public function boot()
    {

    }
}
