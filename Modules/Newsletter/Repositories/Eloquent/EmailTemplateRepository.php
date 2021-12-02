<?php


namespace Modules\Newsletter\Repositories\Eloquent;


use App\Repositories\Eloquent\BaseRepository;
use Modules\Newsletter\Models\EmailTemplate;
use Modules\Newsletter\Repositories\Contract\EmailTemplateContract;

class EmailTemplateRepository extends BaseRepository implements EmailTemplateContract
{
    public function model()
    {
        return EmailTemplate::class;
    }
}
