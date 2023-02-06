<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Notifications\VerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        Notification::fake();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'phone' => '09305721646',
        ]);

        $user = User::where('phone', '09305721646')->first();
        
        Notification::assertSentTo($user, VerificationNotification::class);

        $response->assertRedirect(route('verify'));
    }
}