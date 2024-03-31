<?php

namespace App\Http\Resources;

use App\Helpers\viewHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'file_type' => $this->file_type,
            'size' => (float)$this->size,
            'url' => $this->url,
            'created_at' => (new viewHelper)->convert_timezone($this->created_at, $timezone),
            'updated_at' => (new viewHelper)->convert_timezone($this->updated_at, $timezone)
        ];
    }
}
