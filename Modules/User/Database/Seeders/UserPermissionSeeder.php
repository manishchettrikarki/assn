<?php


namespace Modules\User\Database\Seeders;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        $permissions = [
            'view dashboard','view roles','add roles','update roles','delete roles',
            'assign user roles','revoke user roles','view access control','view users','update users',
            'view user details','delete users','suspend users','unsuspend users','restore users','view suspended users',
            'view deleted users','view activity log','update site settings','receive contact mail','view social links',
            'update social links','delete social links'
        ];
        foreach($permissions as $permission){
            DB::table('permissions')->insert([
                'name'=>$permission
            ]);
        }

        // $this->call("OthersTableSeeder");
    }
}
