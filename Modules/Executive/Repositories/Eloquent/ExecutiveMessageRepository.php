<?php


  namespace Modules\Executive\Repositories\Eloquent;


  use App\Repositories\Eloquent\BaseRepository;
  use Modules\Executive\Models\ExecutiveMessage;
  use Modules\Executive\Repositories\Contracts\ExecutiveMessageContract;

  class ExecutiveMessageRepository extends BaseRepository implements ExecutiveMessageContract
  {
    public function model(){
      return ExecutiveMessage::class;
    }
  }
