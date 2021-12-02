<?php


  namespace Modules\Executive\Repositories\Eloquent;


  use App\Repositories\Eloquent\BaseRepository;
  use Modules\Executive\Models\ExecutiveMember;
  use Modules\Executive\Repositories\Contracts\ExecutiveMemberContract;

  class ExecutiveMemberRepository extends BaseRepository implements ExecutiveMemberContract
  {
    public function model()
    {
      return ExecutiveMember::class;
    }
  }
