<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadAvatarRequest;
use Illuminate\Http\Request;

class UploadAvatar extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UploadAvatarRequest $request)
    {
        if ($request->hasFile('avatar')) {
            try {
                $file = $request->file('avatar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/avatars'), $filename);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Avatar uploaded successfully!',
                    'path' => asset('uploads/avatars/' . $filename),
                ]);
            } catch (\Exception $e) {
                report($e);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to upload avatar.',
        ], 400);
    }
}
