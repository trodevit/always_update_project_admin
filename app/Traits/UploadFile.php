<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait UploadFile{
    public function uploadFile(UploadedFile $file, string $folder, ?string $oldFilePath = null):string
    {
        if ($oldFilePath && File::exists(public_path($oldFilePath))) {
            File::delete(public_path($oldFilePath));
        }

        $fullFolderPath = public_path($folder);
        if (!File::exists($fullFolderPath)) {
            File::makeDirectory($fullFolderPath, 0755, true);
        }

        $fileName = time(). '_' . $file->getClientOriginalExtension();
        $file->move($fullFolderPath, $fileName);

        return $folder . $fileName;
    }
}
