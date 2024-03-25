<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('/register');
    }

    public function authenticate(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Verifica se existe um usuário com o nome de usuário fornecido
        $user = User::where('username', $username)->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'Usuário não encontrado.',
            ]);
        }
        if ($user->password === $password) {
            // Autenticação bem-sucedida]
            Auth::login($user);

            if ($user->is_admin) {
                return redirect()->intended('admin');
            } else {
                return redirect()->intended('');
            }
            return redirect()->intended('dashboard');
        } else {
            // Senha incorreta
            return back()->withErrors([
                'password' => 'Senha incorreta.',
            ]);
        }


        return back()->withErrors([
            'email' => 'As credenciais informadas estão incorretas.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function createUser(Request $request)
{
    $data = $request->validate([
        'username' => 'required|unique:users',
        'password' => 'required',
        'email' => 'required|email|unique:users',
        'is_admin' => 'nullable|boolean',
    ]);

    $data['password'] = $data['password'];

    if (isset($data['is_admin'])) {
        $data['is_admin'] = $data['is_admin'];
    } else {
        $data['is_admin'] = false;
    }

    $user = User::create($data);
    return redirect('login')->with('success', 'Usuário criado com sucesso.');
    //return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
}




}