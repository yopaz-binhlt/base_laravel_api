<?php

namespace App\Services;

use Exception;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{

    private Filesystem $storage;


    public function __construct($diskName=null)
    {
        $diskName = ($diskName ?? config('filesystems.default'));
        $this->storage = Storage::disk($diskName);

    }//end __construct()


    protected function uploadFileInfo(UploadedFile $file): array
    {
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        return [
            'name' => $fileName,
            'ext'  => strtolower($extension),
        ];

    }//end uploadFileInfo()


    /**
     * Get path url
     *
     * @return false|string
     */
    protected function pathUrl($fileName, $namePath): bool|string
    {
        return $namePath.'/'.$fileName;

    }//end pathUrl()


    public function uploadFile($file, $folder): string
    {
        if ($file) {
            $fileName = Str::uuid().$file->getClientOriginalName();
            $path = $folder.'/'.$fileName;
            $this->storage->put($path, File::get($file));

            return $path;
        }

        return '';

    }//end uploadFile()


    public function uploadMultiFile($files, $folder): array
    {
        $arrPath = [];
        if ($files) {
            foreach ($files as $file) {
                if ($file) {
                    $fileName = Str::uuid().$file->getClientOriginalName();
                    $path = $folder.'/'.$fileName;
                    $this->storage->put($path, File::get($file));
                    $arrPath[] = $path;
                }
            }

            return $arrPath;
        }

        return [];

    }//end uploadMultiFile()


    public function delete($oldPath): void
    {
        try {
            if ($this->storage->exists($oldPath)) {
                $this->storage->delete($oldPath);
            }
        } catch (Exception $ex) {
            Log::error('DELETE_FILE_ERROR'.$ex);
        }

    }//end delete()


    public function deleteAll(array $paths): void
    {
        foreach ($paths as $path) {
            if ($this->storage->exists($path)) {
                $this->storage->delete($path);
            }
        }

    }//end deleteAll()


    public function uploadMultiFileAndDisplay($files, $folder): array
    {
        $arrPath = [];
        if ($files) {
            foreach ($files as $file) {
                $fileName = Str::uuid().$file['file']->getClientOriginalName();
                $path = $folder.'/'.$fileName;
                $this->storage->put($path, File::get($file['file']));
                $arrPath[] = [
                    'path'    => $path,
                    'sort_no' => $file['sort_no'],
                ];
            }

            return $arrPath;
        }

        return [];

    }//end uploadMultiFileAndDisplay()


    public function getFullUrlFile(?string $path): string
    {
        if (! $path) {
            return '';
        }

        return $this->storage->url($path);

    }//end getFullUrlFile()


    public function getPathFromUrl(?string $url): string
    {
        if (! $url) {
            return '';
        }

        $arrayUrl = explode('/', $url);
        $path = $arrayUrl[(count($arrayUrl) - 2)].'/'.$arrayUrl[(count($arrayUrl) - 1)];
        //2: folder, 1: file name
        if ($this->storage->exists($path)) {
            return $path;
        }

        return '';

    }//end getPathFromUrl()


}//end class
