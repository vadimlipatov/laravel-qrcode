<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
      'item_id' => $this->item_id,
      'name' => $this->name,
      'last_name' => $this->last_name,
      'created_at' => $this->created_at->format('d.m.Y H:i'),
    ];
  }
}
