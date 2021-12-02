<?php


  namespace Modules\Executive\Database\Seeders;


  use Illuminate\Database\Seeder;
  use Illuminate\Support\Facades\DB;

  class ExecutivePermissionSeeder extends Seeder
  {
    public function run(){
      $permissions = [
        'view executive members','add executive members','update executive members','delete executive members',
        'view members','add members','update members','delete members',
        'view regional coordinators','add regional coordinators','update regional coordinators','delete regional coordinators',
      ];

      foreach ($permissions as $permission){
        DB::table('permissions')->insert(['name'=>$permission]);
      }
    }
  }
