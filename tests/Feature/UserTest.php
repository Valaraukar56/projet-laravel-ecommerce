<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Permission\Models\Role;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_it_can_create_a_user()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    #[Test]
    public function test_it_hashes_password_on_creation()
    {
        $user = User::factory()->create([
            'password' => 'secret123',
        ]);

        $this->assertTrue(Hash::check('secret123', $user->password));
        $this->assertNotEquals('secret123', $user->password);
    }

    #[Test]
    public function test_it_hides_sensitive_attributes()
    {
        $user = User::factory()->create();

        $userArray = $user->toArray();

        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('remember_token', $userArray);
    }

    #[Test]
    public function test_it_casts_email_verified_at_to_datetime()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
    }

    #[Test]
    public function test_it_can_assign_roles()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);

        $user->assignRole('admin');

        $this->assertTrue($user->hasRole('admin'));
    }

    #[Test]
    public function test_it_can_have_multiple_roles()
    {
        $user = User::factory()->create();
        
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);

        $user->assignRole(['admin', 'editor']);

        $this->assertTrue($user->hasRole('admin'));
        $this->assertTrue($user->hasRole('editor'));
        $this->assertCount(2, $user->roles);
    }

    #[Test]
    public function test_it_can_remove_roles()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);

        $user->assignRole('admin');
        $this->assertTrue($user->hasRole('admin'));

        $user->removeRole('admin');
        $this->assertFalse($user->hasRole('admin'));
    }

    #[Test]
    public function test_it_requires_unique_email()
    {
        User::factory()->create(['email' => 'test@example.com']);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create(['email' => 'test@example.com']);
    }

    #[Test]
    public function test_it_can_update_user_information()
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
        ]);

        $user->update([
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);

        $this->assertEquals('New Name', $user->fresh()->name);
        $this->assertEquals('new@example.com', $user->fresh()->email);
    }

    #[Test]
    public function test_it_can_delete_a_user()
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $userId,
        ]);
    }
    public function test_login_page_loads()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Connexion');
    }
    public function test_accueil()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Connexion');
    }
}
