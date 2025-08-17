<?php

namespace App\Traits;

use App\Models\User;
use App\Notifications\FCMNotification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

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

    public function notification_center($title, $body)
    {
        $user = User::all();
        Notification::send($user, new FCMNotification($title,$body));
    }
}
