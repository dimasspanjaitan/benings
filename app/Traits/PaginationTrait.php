<?php
namespace App\Traits;

use App\Libraries\ApiResponse;

/**
 * Pagination Builder
 * @author dimasspanjaitan <dimasspanjaitan123@gmail.com>
 * @since 
 */
trait PaginationTrait {
    public function pagination($total){
        $request = request();
        $pages = [];
        $page = (int) $request['_page'];
        $limit = (int) $request['_limit'];
        $max = (int) ceil($total/$limit);       // ceil -> untuk pembulatan decimal ke atas

        for ($i= $page -3; $i <= $page + 3 ; $i++) { 
            if($i >= 1 && $i <= $max) array_push($pages,$i);
        }        
        $next = $page + 1 > $max ? $page : $page + 1;

        $pagination = [
            'total' => $total,
            'pages' => $pages,
            'prev' =>  $page - 1 <= 1 ? 1 : $page - 1,
            'next' => $next,
            '_limit' => $limit,
            '_page' => $page,
            'last' => $max
        ];

        return $pagination;
    }
}