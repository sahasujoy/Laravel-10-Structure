<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class S3ServiceAWS
{
    protected string $bucket = "";
    protected string $path = "";
    private string $s3Url = "https://s3.amazonaws.com/";
    private string $section = "";
    private string $customUrl = "/";
    private string $fileName = "";

    public function __construct()
    {
        $this->bucket = 'olk9notify';
    }


    /**
     * @param $bucket
     * @return $this
     */
    public function setBucket($bucket): static
    {
        $this->bucket = $bucket;
        return $this;
    }

    public function setSection($section): static
    {
        $this->section = $section;
        return $this;
    }

    /**
     * @param $custom
     * @return $this
     */
    public function setCustomUrl($custom): static
    {
        $this->customUrl = $custom;
        $this->setPath();
        return $this;
    }

    public function setPath(): static
    {
        $this->path = $this->section . $this->customUrl;

        return $this;
    }

    public function uploadFileToS3(UploadedFile $file, $fileName): array
    {
        try {

//            dd( Storage::disk('s3')->allFiles());

//            $r = $this->removeFile('https://s3.amazonaws.com/olk9cutout.com/upload/8ZQ7yh16715210061671521006.jpeg');

//            dd(
//                'delete',
//
//                Storage::disk('s3')->delete('upload')
//            );
//            dd(Storage::disk('s3')->exists('upload'));

////            https://s3.amazonaws.com/olk9cutout.com/upload/8ZQ7yh16715210061671521006.jpeg
//            dd(Storage::disk('s3')->allFiles());

            $filePath = $file->path();

            $this->setFileName($fileName);

            $this
                ->makeDir($this->path)
                ->moveFile($filePath, $this->path . "/" . $fileName)
                ->setVisibility($this->path . $this->fileName);
            try {
                File::delete($filePath);
            } catch (Exception $e) {
                return ['success' => false];
            }

            return [
                'success' => true,
                'url' => $this->getUrl(),
                'file_name' => $fileName,
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'File upload error', 'url' => null];
        }
    }

    public function setFileName($fileName): static
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @param $path
     * @param string $status
     * @return void
     */
    private function setVisibility($path, string $status = 'public'): void
    {
        Storage::disk('s3')->setVisibility($path, $status);
    }

    /**
     * @param $from
     * @param $to
     * @return $this
     */
    private function moveFile($from, $to): static
    {
        Storage::disk('s3')->put($to, file_get_contents($from));
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    private function makeDir($path): static
    {
//        if (!Storage::disk('s3')->exists($path)) {
//            Storage::disk('s3')->makeDirectory($path);
//        }
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->s3Url . $this->bucket . '/' . $this->section . $this->customUrl . $this->fileName;
    }

    public function uploadFileToS3_2($filePath, $fileName, $delete = true): array
    {
        try {

            $this->setFileName($fileName);

            $this
                ->makeDir($this->path)
                ->moveFile($filePath, $this->path . "/" . $fileName)
                ->setVisibility($this->path . $this->fileName);
            try {
                if ($delete) {
                    File::delete($filePath);
                }
            } catch (Exception $e) {
                return ['success' => false];
            }

            return [
                'success' => true,
                'url' => $this->getUrl(),
                'file_name' => $fileName,
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'File upload error', 'url' => null];
        }
    }

    /**
     * @param $fullPath
     * @return bool
     */
    public function hasFile($fullPath): bool
    {
        return Storage::disk('s3')->exists(str_replace($this->s3Url . $this->bucket, '', $fullPath));
    }

    /**
     * @param $path
     * @return bool
     */
    public function removeFile($path): bool
    {
        if (Storage::disk('s3')->exists($path)) {
            return Storage::disk('s3')->delete($path);
        }

        return false;
    }

    /**
     * @param $fullPath
     * @return bool
     */
    public function removeFileWithFullUrl($fullPath): bool
    {
        $fullPath = str_replace("https://s3.amazonaws.com/" . env('AWS_BUCKET') . "/", '', $fullPath);

        if (Storage::disk('s3')->exists($fullPath)) {
            return Storage::disk('s3')->delete($fullPath);
        }

        return false;
    }

    /**
     * @param $fileUrl
     * @param int $fileName
     * @param string $type
     * @return bool|int
     */
    public function downloadFileFromUrl($url, $fileName, $type = "png"): bool|int
    {
        header("Cache-Control: public");
        header('Content-Type: application/octet-stream');
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($fileName).'.'.$type);

        return readfile($url);
    }

    /**
     * @param $filePath
     * @param $content
     * @return string
     */
    public function uploadUsingContent($filePath, $content): string
    {
        $path = Storage::disk('s3')->put($filePath, $content);

        return Storage::disk('s3')->url($path);
    }

    public function file_get_contents_curl($userId, $image, $ext = ".jpeg"): string
    {
        if (!file_exists(public_path() . '/upload/' . $userId)) {
            mkdir(public_path() . '/upload/' . $userId, 0777, true);
        }

        $tempFilePath = public_path() . '/upload/' . $userId . '/' . basename(\Illuminate\Support\Str::random(12)) . $ext;

        //$tempFile = fopen($tempFilePath, "w") or die("Error: Unable to open file.");
        file_put_contents($tempFilePath, file_get_contents($image));

        return $tempFilePath;
    }

    private function moveStreamFile($from, $to): static
    {
        $result = Storage::disk('s3')->put($to, $from);
        Log::info("On make dir");
        Log::info($result);
        return $this;
    }

    public function uploadFileForSmallFileToS3($filePath, $fileName): array
    {
        try {

            $this->setFileName($fileName);

            $this
                ->makeDir($this->path)
                ->moveFile($filePath, $this->path . "/" . $fileName)
                ->setVisibility($this->path . $this->fileName);
            try {
                File::delete($filePath);
            } catch (Exception $e) {
                return ['success' => false];
            }

            return [
                'success' => true,
                'url' => $this->getUrl(),
                'file_name' => $fileName,
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'File upload error', 'url' => null];
        }
    }
}
