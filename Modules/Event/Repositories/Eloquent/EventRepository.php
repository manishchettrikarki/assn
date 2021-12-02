<?php


  namespace Modules\Event\Repositories\Eloquent;


  use Modules\Event\Models\Event;
  use App\Repositories\Eloquent\BaseRepository;
  use Modules\Event\Repositories\Contracts\EventContract;

  class EventRepository extends BaseRepository implements EventContract
  {
    public function model()
    {
      return Event::class;
    }
  }
