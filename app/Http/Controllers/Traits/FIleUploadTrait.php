<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    /**
     * Upload a file and return the stored file path.
     *
     * @param Request $request
     * @param string $fieldName
     * @param string $storagePath
     * @return string|null
     */

    public function uploadFile(Request $request, $fileName, $storagePath = 'public/uploads')
    {
        if ($request->hasFile($fileName) && $request->file($fileName)->isValid()) {
            // file name with extension
            $fileNameWithExt = $request->file($fileName)->getClientOriginalName();

            // Get Filename
            $getFileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extention = $request->file($fileName)->getClientOriginalExtension();

            // Filename To store
            $fileNameToStore = $getFileName . '_' . time() . '.' . $extention;

            // Upload Image
            $request->file($fileName)->storeAs($storagePath, $fileNameToStore);

            return $fileNameToStore;
        }
        $fileNameToStore = "noimage.png";
        return $fileNameToStore;
    }

    /**
     * Remove file and return the stored file path.
     *
     * @param Request $request
     * @param string $fieldName
     * @param string $storagePath
     * @return string|null
     */

    public function delete_file($path, $file)
    {
        if ($file == 'noimage.png') {
            Storage::delete($path . $file);
            return true;
        }

        return false;
    }
}
