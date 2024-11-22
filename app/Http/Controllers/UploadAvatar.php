<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadAvatar extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UploadAvatarRequest $request)
    {
        if ($request->hasFile('avatar')) {
            try {
                $file     = $request->file('avatar');
                $filename = time() . '_' . $file->getClientOriginalName();
                Storage::disk('public')->put($filename, $file->getContent());

                return response()->json([
                    'status'   => 'success',
                    'message'  => 'Avatar uploaded successfully!',
                    'filename' => $filename,
                    'path'     => Storage::url($filename),
                ]);
            } catch (\Exception $e) {
                report($e);
            }
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Failed to upload avatar.',
        ], 400);
    }
}
