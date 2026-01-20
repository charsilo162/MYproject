<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageGeneration extends Model
{
   protected $fillable = [
       'user_id',
       'generation_prompt',
       'image_path',
       'original_file_name',
       'size',
       'mime_type',
   ];

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
