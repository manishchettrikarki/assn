<?php


namespace Modules\User\Repositories\Contracts;


interface UserContract
{
    public function withTrashed();
    public function restore($id);
    public function search($search);
    public function getUsersEmail();
    public function getVerifiedUsersEmail();
}
