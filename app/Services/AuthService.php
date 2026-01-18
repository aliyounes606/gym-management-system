<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService
{
    /**
     * Summary of registerUser
     * @param array $data
     * @return array{token: string, user: User}
     */
    public function registerUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'age' => $data['age'] ?? null,
            'weight' => $data['weight'] ?? null,
        ]);

        if (method_exists($user, 'assignRole')) {
            $user->assignRole('member');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Summary of loginUser
     * @param mixed $email
     * @param mixed $password
     * @throws \Exception
     * @return array{token: string, user: User}
     */
    public function loginUser($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new Exception('بيانات الدخول غير صحيحة.', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Summary of logoutUser
     * @param mixed $user
     * @return bool
     */
    public function logoutUser($user)
    {
        $user->currentAccessToken()->delete();
        return true;
    }
}