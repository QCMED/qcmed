<?php

// tests/Feature/SecurityPanelTest.php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_panel_forbidden_for_student()
    {
        $student = User::factory()->create(['role' => User::ROLE_STUDENT]);
        $this->actingAs($student);

        $response = $this->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_panel_access_for_admin()
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->actingAs($admin);

        $response = $this->get('/admin');
        $response->assertStatus(200);
    }

    public function test_student_panel_forbidden_for_admin()
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->actingAs($admin);

        $response = $this->get('/student');
        $response->assertStatus(403);
    }

    public function test_student_panel_access_for_student()
    {
        $student = User::factory()->create(['role' => User::ROLE_STUDENT]);
        $this->actingAs($student);

        // Filament panels redirect to their default page (dashboard)
        $response = $this->get('/student');
        $response->assertRedirect();

        // Follow the redirect to verify access is granted
        $response = $this->followingRedirects()->get('/student');
        $response->assertSuccessful();
    }
}
