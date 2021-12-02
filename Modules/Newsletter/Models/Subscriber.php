<?php


namespace Modules\Newsletter\Models;


use App\Models\CachableModel;
use Illuminate\Notifications\Notifiable;

class Subscriber extends CachableModel
{
    use Notifiable;
    protected $fillable = [
        'name','email','email_verified','deleted_at'
    ];
}
