<?php


namespace Modules\Gallery\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryPermissionSeeder extends Seeder
{
    public function run(){
        $permissions = [
            'view gallery albums','create gallery albums','update gallery albums','delete gallery albums',

        ];

        foreach ($permissions as $permission){
            DB::table('permissions')->insert(['name'=>$permission]);
        }
    }
}
