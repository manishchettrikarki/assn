<?php


namespace Modules\CMS\Repositories\Eloquent;


use App\Repositories\Eloquent\BaseRepository;
use Modules\CMS\Models\Page;
use Modules\CMS\Repositories\Contracts\PageContract;

class PageRepository extends BaseRepository implements PageContract
{
    public function model(){
        return Page::class;
    }
}
