<?php

namespace App\Http\Resources;

use App\Http\Resources\EmailResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        try{
            return [
                'emails' => $this->collection,
                'links' => [
                    'self' => 'emails',
                ],
            ];
        }
        catch(\Exception $e){
            // TODO: Log Error
            // TODO: Generate more proper response
            response()->json( [ 'result' => 'error' ], 500 );
        }
    }
}
