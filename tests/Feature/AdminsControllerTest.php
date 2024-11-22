<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_admins_table_is_displayed()
    {
        User::factory()->create(['email' => 'admin1@example.com', 'name' => 'Admin One', 'status' => 1]);
        User::factory()->create(['email' => 'admin2@example.com', 'name' => 'Admin Two', 'status' => 0]);

        $response = $this->get(route('admins.index'));

        $response->assertStatus(200);
        $response->assertSee('Admin One');
        $response->assertSee('admin1@example.com');
    }

    public function test_admin_can_be_created()
    {
        $data = [
            'name'     => 'John Doe',
            'email'    => 'john.doe@example.com',
            'password' => 'password123',
            'status'   => 'offline',
            'avatar'   => '4fIN2WWSaL.png'
        ];

        $response = $this->post(route('admins.store'), $data);

        $response->assertRedirect(route('admins.index'));
        $this->assertDatabaseHas('users', [
            'name'   => 'John Doe',
            'email'  => 'john.doe@example.com',
            'status' => 'offline',
            'avatar' => '4fIN2WWSaL.png'
        ]);
    }

    public function test_user_can_view_admin_details()
    {
        $admin = User::factory()->create();

        $response = $this->get(route('admins.show', $admin->id));
        $response->assertStatus(200);
        $response->assertViewIs('admins.show');
        $response->assertViewHas('admin', $admin);
    }

    public function test_admin_creation_requires_valid_data()
    {
        $response = $this->post(route('admins.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'status']);
    }

    public function test_create_admin_form_is_displayed()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admins.create'));

        $response->assertStatus(200);
        $response->assertSee('name');
        $response->assertSee('email');
        $response->assertSee('password');
        $response->assertSee('status');
        $response->assertSee('avatar');
        $response->assertSee('submit');
    }

    public function test_edit_admin_form_is_displayed()
    {
        $admin = User::factory()->create();

        $response = $this->get(route('admins.edit', $admin->id));

        $response->assertStatus(200)
            ->assertViewIs('admins.edit')
            ->assertViewHas('admin', $admin);
    }

    public function test_user_can_update_admin()
    {
        $admin = User::factory()->create();

        $updateData = [
            'name'     => 'Updated Admin',
            'email'    => 'updatedadmin@example.com',
            'password' => 'newpassword',
            'status'   => 'online',
        ];

        $response = $this->put(route('admins.update', $admin->id), $updateData);

        $response->assertRedirect(route('admins.index'));

        $response->assertSessionHas('success', 'Admin updated successfully.');

        $this->assertDatabaseHas('users', [
            'id'    => $admin->id,
            'name'  => $updateData['name'],
            'email' => $updateData['email'],
        ]);

        $this->assertNotEquals($updateData['password'], $admin->fresh()->password);
        $this->assertTrue(Hash::check($updateData['password'], $admin->fresh()->password));
    }

    public function test_authorized_user_can_delete_admin()
    {
        $admin = User::factory()->create();

        $this->delete(route('admins.destroy', $admin->id));

        $this->assertDatabaseMissing('users', ['id' => $admin->id]);

    }
}
