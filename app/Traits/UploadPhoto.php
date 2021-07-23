<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadPhoto
{
    public function uploadPhoto(UploadedFile $photo, $folder)
    {
        return $photo->storePublicly($folder, ['disk' => 'public']);
    }
}
