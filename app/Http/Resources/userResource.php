<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
 /**
 * @mixin User
 */ 
class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'userName' => $this->userName,
            'phone' => $this->phone,
            'email' => $this->email,
            'userType' => [
                'id' => $this->user_type_id,
                'name' =>$this->userType?->name
            ],
            'image' => $this->image ? asset($this->image) : null,
            'access_token' =>   $this->access_token,
        ];
    }
}
