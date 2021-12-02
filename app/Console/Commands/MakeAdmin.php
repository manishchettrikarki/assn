<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\User\Models\Permission;
use Modules\User\Models\Role;
use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\PermissionContract;
use Modules\User\Repositories\Contracts\RoleContract;
use Modules\User\Repositories\Contracts\UserContract;

class MakeAdmin extends Command
{

    protected $permissionContract,$roleContract,$userContract;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create application admin with all permissions';

    /**
     * Create a new command instance.
     *
     */


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mainBar = $this->output->createProgressBar(5);

        $name = $this->getUserName();
        $mainBar->advance(1);

        $email = $this->getEmail();
        $mainBar->advance(1);

        $password = $this->getPassword();
        $mainBar->advance(1);

       $role = Role::where('name','Super Admin')->first();
       if(!$role){
           $bar = $this->output->createProgressBar(2);

           $this->info('Super Admin role not found.Creating with all available permissions...');
           $bar->start();

           $role = Role::create([
               'name'=>'Super Admin'
           ]);
           $bar->advance(1);

           $bar->finish();
       }
        $mainBar->advance(1);

       $user = new User();
       $user->name = $name;
       $user->email = $email;
       $user->password = Hash::make($password);
       $user->save();

       $mainBar->advance(1);
       $user->assignRole('Super Admin');
       $mainBar->finish();
       $this->info('Super Admin created successfully.');
       return;
    }

    public function getEmail(){
        $email = $this->ask('What is your admin email?');
        $validator = Validator::make([
            'email'=>$email
        ],[
            'email'=>'required|email|unique:users,email'
        ]

        );
        if($validator->fails()){
            foreach ($validator->errors()->all() as $error){
                $this->error($error);
            }
            return $this->getEmail();
        }

        return $email;
    }

    public function getPassword(){
        $password = $this->secret('What is your admin password?');
        if(strlen($password) < 6 ){
            $this->error('Password must be at least 6 characters long.');
            return $this->getPassword();
        }
        return $password;
    }

    public function getUserName(){
        $name = $this->ask('What is your admin name?');
        if(strlen($name) < 5){
            $this->error('Name too short,min:5');
            return $this->getUserName();
        }
        return $name;
    }
}
