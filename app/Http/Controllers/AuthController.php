<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
  public function register(Request $request)
  {

    $validatedData = $request->validate([
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'age' => 'required|integer|min:18|max:100',
      'email' => 'required|string|email|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create($request->all());

    return redirect()->route('login-page')->with('success', 'Вы успешно зарегестрировались!');
  }

  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      return redirect()->route('index');
    } else {
      return redirect()->route('login-page')->with('error', 'Неверные данные!');
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect()->route('login-page');
  }
}
