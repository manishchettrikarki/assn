<?php


namespace App\Repositories\Eloquent;


use App\Models\SocialLink;
use App\Repositories\Contracts\SocialLinkContract;

class SocialLinkRepository extends BaseRepository implements SocialLinkContract
{
    public function model()
    {
        return SocialLink::class;
    }

}
