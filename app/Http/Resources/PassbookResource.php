<?php

namespace App\Http\Resources;

use App\Helpers\viewHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PassbookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        $timezone = $request->user()->timezone ?: DEFAULT_TIMEZONE;

        return[
            'folder' => $this->folder,
            'total' => $this->total,
            'remaining' => $this->remaining,
            'used' => $this->used,
            'note' => __('messages.user.profile.storage_note', [
                'total' =>  (new viewHelper)->formatted_storage_size($this->total),
                'remaining' => (new viewHelper)->formatted_storage_size($this->remaining),
            ]),
            'created_at' => (new viewHelper)->convert_timezone($this->created_at, $timezone),
            'updated_at' => (new viewHelper)->convert_timezone($this->updated_at, $timezone)
        ];
    }
}
