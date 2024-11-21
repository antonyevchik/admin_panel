<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadAvatarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_avatar_upload_successfully()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->postJson(route('admins.uploadAvatar'), [
            'avatar' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'message' => 'Avatar uploaded successfully!',
        ]);

        Storage::disk('public')->assertExists($response->json('filename'));
    }

    public function test_avatar_upload_fails_without_file()
    {
        $response = $this->postJson(route('admins.uploadAvatar'));

        $response->assertStatus(422);
    }

    public function test_avatar_upload_fails_with_invalid_file()
    {
        $file = UploadedFile::fake()->create('not_an_image.txt', 100);

        $response = $this->postJson(route('admins.uploadAvatar'), [
            'avatar' => $file,
        ]);

        $response->assertStatus(422);
    }
}
