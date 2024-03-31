<?php

namespace App\Http\Resources;

use App\Helpers\viewHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        $timezone = $this->timezone ?: DEFAULT_TIMEZONE;

        return [
            'id' => $this->id,
            'unique_id' => $this->unique_id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile ?: '',
            'avatar' => $this->avatar,
            'about' => $this->about ?: '',
            'email_status' => $this->email_status,
            'tfa_status' => $this->tfa_status,
            'tfa_verified' => $this->tfa_verified,
            'status' => $this->status,
            'email_verified_at' => $this->email_verified_at ? (new viewHelper)->convert_timezone($this->email_verified_at, $timezone) : '',
            'last_password_reset_at' => $this->last_password_reset_at ? (new viewHelper)->convert_timezone($this->last_password_reset_at, $timezone) : '',
            'timezoene' => $this->timezone ?: DEFAULT_TIMEZONE,
            'created_at' => (new viewHelper)->convert_timezone($this->created_at, $timezone),
            'updated_at' => (new viewHelper)->convert_timezone($this->updated_at, $timezone)
        ];
    }
}
