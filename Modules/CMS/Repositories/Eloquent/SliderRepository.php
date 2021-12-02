<?php


namespace Modules\CMS\Repositories\Eloquent;


use App\Repositories\Eloquent\BaseRepository;
use Modules\CMS\Models\Slider;
use Modules\CMS\Repositories\Contracts\SliderContract;

class SliderRepository extends BaseRepository implements SliderContract
{
    public function model(){
        return Slider::class;
    }
}
