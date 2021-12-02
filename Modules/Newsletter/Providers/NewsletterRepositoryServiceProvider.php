<?php


namespace Modules\Newsletter\Providers;



use Illuminate\Support\ServiceProvider;
use Modules\Newsletter\Repositories\Contract\EmailTemplateContract;
use Modules\Newsletter\Repositories\Contract\SubscriberContract;
use Modules\Newsletter\Repositories\Eloquent\EmailTemplateRepository;
use Modules\Newsletter\Repositories\Eloquent\SubscriberRepository;

class NewsletterRepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(SubscriberContract::class,SubscriberRepository::class);
        $this->app->bind(EmailTemplateContract::class,EmailTemplateRepository::class);
    }
}
