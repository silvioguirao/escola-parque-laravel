<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_is_admin_returns_true_for_admin_role(): void
    {
        $user = new User(['role' => 'admin']);
        
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isParent());
        $this->assertFalse($user->isUser());
    }

    public function test_user_is_parent_returns_true_for_parent_role(): void
    {
        $user = new User(['role' => 'parent']);
        
        $this->assertFalse($user->isAdmin());
        $this->assertTrue($user->isParent());
        $this->assertFalse($user->isUser());
    }

    public function test_user_is_user_returns_true_for_user_role(): void
    {
        $user = new User(['role' => 'user']);
        
        $this->assertFalse($user->isAdmin());
        $this->assertFalse($user->isParent());
        $this->assertTrue($user->isUser());
    }

    public function test_must_verify_email_returns_correct_value(): void
    {
        $userRequiresVerification = new User(['require_email_verification' => true]);
        $userNoVerification = new User(['require_email_verification' => false]);
        
        $this->assertTrue($userRequiresVerification->mustVerifyEmail());
        $this->assertFalse($userNoVerification->mustVerifyEmail());
    }

    public function test_password_is_hidden_in_array(): void
    {
        $user = User::factory()->make(['password' => 'secret']);
        $array = $user->toArray();
        
        $this->assertArrayNotHasKey('password', $array);
    }

    public function test_sensitive_fields_are_hidden(): void
    {
        $user = User::factory()->make();
        $array = $user->toArray();
        
        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
        $this->assertArrayNotHasKey('two_factor_recovery_codes', $array);
        $this->assertArrayNotHasKey('two_factor_secret', $array);
    }
}
