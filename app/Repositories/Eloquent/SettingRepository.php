<?php


namespace App\Repositories\Eloquent;


use App\Models\Setting;
use App\Repositories\Contracts\SettingContract;

class SettingRepository extends BaseRepository implements SettingContract
{
    public function model(){
        return Setting::class;
    }
}
