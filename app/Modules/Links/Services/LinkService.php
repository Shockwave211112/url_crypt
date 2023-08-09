<?php

namespace App\Modules\Links\Services;

use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Traits\CrudTrait;
use App\Modules\Links\Jobs\LinkHit;
use App\Modules\Links\Models\Link;

class LinkService
{
    use CrudTrait;

    /**
     * @param Link $model
     */
    public function __construct(Link $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($model);
    }

    /**
     * @param string $referral
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws DataBaseException
     */
    public function referral(string $referral)
    {
        $link = Link::where('referral', $referral)->first();

        if (!isset($link)) {
            throw new DataBaseException('Link not found.', 404);
        }

        dispatch(new LinkHit($link));

        return redirect($link->origin);
    }
}
