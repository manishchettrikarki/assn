<?php


namespace Modules\User\Repositories\Eloquent;


use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\UserContract;

class UserRepository extends BaseRepository implements UserContract
{
    public function model(){
        return User::class;
    }

    public function withTrashed()
    {
        return $this->model->withTrashed();
    }

    public function restore($id){
        $user = $this->model->withTrashed()->find($id)->restore();
        return $user;
    }

    public function search($search)
    {
        return $this->model
            ->where('name','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%')
            ->get();
    }


    public function getVerifiedUsersEmail()
    {
       return  DB::table($this->getTable())->select(['name','email'])
            ->where('email_verified_at','!=',null)
            ->get();
    }

    public function getUsersEmail()
    {
        return  DB::table($this->getTable())->select(['name','email'])
            ->get();
    }
}
