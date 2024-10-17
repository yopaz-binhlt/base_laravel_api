<?php

namespace App\Http\Resources\User;

use App\Traits\ResponseCollectionTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    use ResponseCollectionTrait;


    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->formatCollection($this);

    }//end toArray()


}//end class
