<?php

namespace Modules\Executive\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ExecutiveDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(ExecutivePermissionSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
