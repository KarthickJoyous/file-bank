<?php

namespace App\Http\Resources;

use App\Helpers\viewHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
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
            'description' => $this->description ?: '',
            'sub_folders_count' => $this->sub_folders_count ?: 0,
            'sub_folders' => FolderResource::collection($this->whenLoaded('subFolders')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'created_at' => (new viewHelper)->convert_timezone($this->created_at, $timezone),
            'updated_at' => (new viewHelper)->convert_timezone($this->updated_at, $timezone)
        ];
    }
}
