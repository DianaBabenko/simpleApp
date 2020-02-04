<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws UploadFailedException
     * @throws UploadMissingFileException
     */
    public function upload(Request $request): JsonResponse
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        /** @var FileReceiver $receiver */
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        $save = $receiver->receive();

        if ($save->isFinished() === true) {
            return $this->saveFile($save->getFile());
        }

        $handler = $save->handler();

        return response()->json([
            'done' => $handler->getPercentageDone(),
        ]);
    }

    /**
     * @param UploadedFile $file
     * @return JsonResponse
     */
    private function saveFile(UploadedFile $file): JsonResponse
    {
        $fileName = time() . '.' . $file->extension();

        $mime = str_replace('/', '-', $file->getMimeType());

        $dateFolder = date('Y-m-W');

        $filePath = "upload/{$mime}/{$dateFolder}/";
        $finalPath = storage_path('app/' . $filePath);

        $file->move($finalPath, $fileName);

        return response()->json([
            'path' => $filePath,
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }
}
