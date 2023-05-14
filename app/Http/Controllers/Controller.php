<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Btx\QueryFilter\Traits\QueryFilter;
use App\Traits\{
    StaticResponseTrait,
    PaginationTrait
};
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, QueryFilter, StaticResponseTrait, PaginationTrait;

    public function __construct(Request $request)
    {
        if(!isset($request['_page'])) $request['_page'] = 1;
        if(!isset($request['_limit'])) $request['_limit'] = 10;
    }
}
