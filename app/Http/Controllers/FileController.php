<?php

namespace App\Http\Controllers;


use Spatie\Image\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use ZanySoft\Zip\Facades\Zip;
use Spatie\Image\Manipulations;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    const UNZIP_DIRECTORY = 'unzip/';
    public function uploadImage(Request $request)
    {

        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $file = $request->file('image');

        $fileName = $file->hashName();

        $path = Storage::url($file->storeAs('', $fileName, 'public'));

        return new JsonResponse(
            $path,
            200,
            [
                'Vary' => 'Accept',
                'X-Inertia' => 'true',
            ]
        );
    }

    public function uploadVideo(Request $request)
    {

        $request->validate([
            'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
        ]);

        $file = $request->file('video');

        $fileName = $file->hashName();

        $path = Storage::url($file->storeAs('', $fileName, 'public'));

        return new JsonResponse(
            $path,
            200,
            [
                'Vary' => 'Accept',
                'X-Inertia' => 'true',
            ]

        );
    }
    public function uploadZip(Request $request)
    {
        $file = $request->file('archive');

        $fileName = $file->hashName();

        $path = Storage::url($file->storeAs('', $fileName, 'public'));

        return new JsonResponse(
            $path,
            200,
            [
                'Vary' => 'Accept',
                'X-Inertia' => 'true',
            ]

        );
    }

    public function unZip(Request $request)
    {
        $zipFile = public_path($request->zipFilename);
        $zip = Zip::open($zipFile);

        $zipFiles = $zip->listFiles();
        $zip->setMask(0777);

        if ($zip->extract(public_path('storage/') . self::UNZIP_DIRECTORY)) {
            $zip->close();
            return response()->json([
                'success' => true,
                'zipFiles' => $zipFiles,
                'countFiles' => count($zipFiles),
            ], 200);
        }
    }
    public function test()
    {

        $file = 'logo-ag-terminal-black_6.png';
        if (Storage::disk('public')->exists(self::UNZIP_DIRECTORY. $file)) {



            return response()->json([
                'success' => true,

            ], 200);
        }
        return response()->json([
            'success' => false,
            'path'=> public_path('storage/') . self::UNZIP_DIRECTORY . $file,
        ], 200);

    }
    public function optimizationFile($uploadedFile, $directory)
    {

        $filename = $uploadedFile->getClientOriginalName();

        return Image::load($uploadedFile)
            ->fit(Manipulations::FIT_FILL, 900, 675)
            ->optimize()
            ->save('images/' . $directory . $filename);
    }

    public function optimizationFiles(Request $request)
    {
        $listFiles = Str::of($request->listFiles)->explode(',');

        $total = count($listFiles);
        $processed = 0;
        $files = [];

        foreach ($listFiles as $file) {
            if (Storage::disk('public')->exists(self::UNZIP_DIRECTORY . $file)) {

                Image::load(public_path('storage/') . self::UNZIP_DIRECTORY . $file)
                    ->fit(Manipulations::FIT_FILL, 900, 675)
                    ->optimize()
                    ->save('storage/' . $file);

                array_push($files, '/storage/' . $file);
                $processed++;
            }
        }

        return response()->json([
            'success' => true,
            'files' => $files,
            'total' => $total,
            'processed' => $processed,
        ], 200);
    }

    public function deleteZip(Request $request)
    {
        if (Storage::disk('public')->delete('zips/' . $request->filename)) {
            return response()->json(['success' => true,], 200);
        }
    }
}
