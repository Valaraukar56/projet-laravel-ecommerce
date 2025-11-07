<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Permission\Models\Role;

class UserNegativeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_fails_to_create_user_without_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        User::create([
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
    }

    #[Test]
    public function it_fails_to_create_user_without_email()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        User::create([
            'name' => 'John Doe',
            'password' => 'password123',
        ]);
    }

    #[Test]
    public function it_fails_to_create_user_without_password()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        User::create([
            'name' => 'John Doe',
            'email' => 'test@example.com',
        ]);
    }

    #[Test]
    public function it_fails_with_duplicate_email()
    {
        User::factory()->create(['email' => 'duplicate@example.com']);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create(['email' => 'duplicate@example.com']);
    }

    #[Test]
    public function it_fails_to_assign_non_existent_role()
    {
        $user = User::factory()->create();

        $this->expectException(\Spatie\Permission\Exceptions\RoleDoesNotExist::class);

        $user->assignRole('non_existent_role');
    }

    #[Test]
    public function it_cannot_remove_role_that_user_does_not_have()
    {
        $user = User::factory()->create();
        Role::create(['name' => 'admin']);

        // Ne devrait pas lever d'exception mais ne rien faire
        $user->removeRole('admin');

        $this->assertFalse($user->hasRole('admin'));
    }

    #[Test]
    public function it_fails_to_update_with_existing_email()
    {
        User::factory()->create(['email' => 'existing@example.com']);
        $user = User::factory()->create(['email' => 'user@example.com']);

        $this->expectException(\Illuminate\Database\QueryException::class);

        $user->update(['email' => 'existing@example.com']);
    }

    #[Test]
    public function it_cannot_access_deleted_user()
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $user->delete();

        $this->assertNull(User::find($userId));
    }

    #[Test]
    public function it_fails_with_invalid_email_format_at_database_level()
    {
        // Ce test dépend de votre validation au niveau application
        // Laravel ne valide pas le format email au niveau model par défaut
        
        $user = User::factory()->create(['email' => 'invalid-email']);
        
        // Le modèle acceptera n'importe quelle chaîne sans validation
        $this->assertDatabaseHas('users', ['email' => 'invalid-email']);
    }

    #[Test]
    public function it_returns_false_when_checking_non_existent_role()
    {
        $user = User::factory()->create();

        $this->assertFalse($user->hasRole('non_existent_role'));
    }
}