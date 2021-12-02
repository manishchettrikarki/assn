<?php


namespace Modules\Executive\Repositories\Eloquent;


use App\Repositories\Eloquent\BaseRepository;
use Modules\Executive\Models\Member;
use Modules\Executive\Repositories\Contracts\MemberContract;

class MemberRepository extends BaseRepository implements MemberContract
{
    public function model()
    {
        return Member::class;
    }
}
