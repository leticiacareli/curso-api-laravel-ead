<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'course_name'   => $this->name,
            'description'   => $this->description,
            'modules'       => ModuleResource::collection($this->whenLoaded('modules')),
            'image'         => $this->image ? Storage::url($this->image) : '',
        ];
    }
}
