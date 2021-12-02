<?php


namespace Modules\Newsletter\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsletterPermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
           'view subscribers','delete subscribers','create email templates','update email templates',
            'delete email templates','send newsletter'
        ];

        foreach ($permissions as $permission){
            DB::table('permissions')->insert(['name'=>$permission]);
        }
    }
}
