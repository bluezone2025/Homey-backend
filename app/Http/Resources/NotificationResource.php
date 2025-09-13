<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = json_decode($this->data,true);
        //dd($data);
        return [
            'id'=>$this->id,
            'read_at'=>$this->read_at,
            'title_ar'=> @$data['title_ar'],
            'title_en'=> @$data['title_en'],
            'details_ar'=> @$data['details_ar'],
            'details_en'=> @$data['details_en'],
            'image'=> $data['image'],
            'type'  => $data['type'],
            'reference_id'  => $data['reference_id'],
        ];
    }
}
