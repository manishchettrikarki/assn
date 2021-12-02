<?php


namespace Modules\CMS\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsPermissionSeeder extends Seeder
{
    public function run(){
        $permissions = [
            'view pages','create pages','update pages','delete pages',
            'view sliders','create sliders','update sliders','delete sliders',
            'view library'
        ];

        foreach ($permissions as $permission){
            DB::table('permissions')->insert(['name'=>$permission]);
        }
    }
}
