<?php
namespace App\Traits;

use App\Libraries\ApiResponse;

/**
 * Description of StaticResponseTrait
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 * @since 
 */
trait PaginationTrait {
    public function pagination($total){
        $request = request();
        $pages = [];
        for ($i= (int)$request['_page'] -3; $i <= (int)$request['_page'] + 3 ; $i++) { 
            if($i >= 1 && $i <= $total/$request['_limit']) array_push($pages,$i);
        }

        $pagination = [
            'total' => $total,
            'pages' => $pages,
            'prev' => (int) $request['_page'] - 1 <= 1 ? 1 : $request['_page'] - 1,
            'next' => (int) $request['_page'] + 1 > $total/$request['_limit'] ? $total/$request['_limit'] : $request['_page'] + 1,
            '_limit' => (int) $request['_limit'],
            '_page' => (int) $request['_page'],
            'last' => $total/(int) $request['_limit']
        ];

        return $pagination;
    }
}