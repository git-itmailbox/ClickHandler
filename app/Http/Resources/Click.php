<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Click extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'user_agent'    => $this->user_agent,
            'ip'            => $this->ip,
            'ref'           => $this->ref,
            'param1'        => $this->param1,
            'param2'        => $this->param2,
            'error'         => $this->error,
            'bad_domain'    => $this->bad_domain,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
