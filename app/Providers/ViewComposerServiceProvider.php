<?php


namespace App\Providers;


use App\Models\ActivityLog;
use Illuminate\Support\ServiceProvider;
use Modules\CMS\Models\Page;
use Modules\Payment\Models\Fonepay\Fonepay;
use Modules\Payment\Models\Hbl\Hbl;
use Modules\Payment\Models\IPS\IPS;
use Modules\Payment\Models\Khalti\Khalti;
use Modules\Payment\Models\Transaction;
use Nwidart\Modules\Facades\Module;

class ViewComposerServiceProvider extends ServiceProvider
{

    public function register(){

    }

    public function boot(){
        view()->composer(['back.*','user::back.*','user::user.*'],function($view){
            $modulesName = [];
            foreach (Module::getByStatus(1) as $module) {
                array_push($modulesName,$module->getLowerName());
            }
            $view->with(['modulesName'=>$modulesName]);
        });

        view()->composer('partials.nav', function($view){
            $pages = Page::where('publish',true)->where('nav',true)->get();
            $view->with(compact('pages'));
        });

      view()->composer('partials.footer', function($view){
        $pages = Page::where('publish',true)->get();
        $view->with(compact('pages'));
      });

        view()->composer('back.partials.right-sidebar', function($view){
            $activities = cache()->remember('latest-activities', 60*5,function(){
                 return  ActivityLog::latest()->limit(5)->get();
            });

            $view->with(compact('activities'));
        });
    }

}
