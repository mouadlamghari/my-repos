<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $endDateTime = \Carbon\Carbon::parse($this->Date_consultation)->addMinutes(30);

        return [
            'title'=>$this->Objet,
            'start'=>$this->Date_consultation,
            'end'=>$endDateTime,
        ];
    }
}
