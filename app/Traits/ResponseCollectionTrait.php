<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait ResponseCollectionTrait
{


    protected function formatCollection($data): array
    {
        $response = [
            'items' => $data->collection,
        ];

        if ($data->resource instanceof LengthAwarePaginator) {
            $response['pagination'] = [
                'total'        => $data->total(),
                'count'        => $data->count(),
                'per_page'     => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages'  => $data->lastPage(),
            ];
        }

        return $response;

    }//end formatCollection()


}
