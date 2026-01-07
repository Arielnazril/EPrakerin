<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jurusan;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $jurusans = Jurusan::all();
        return view('auth.register', compact('jurusans'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:225'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nomor_identitas' => ['required', 'string', 'unique:users,nomor_identitas'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
            'kelas' => ['required', 'string'],
            'no_hp' => ['required', 'string'],
            'alamat' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'status_akun' => 'pending',
            'nomor_identitas' => $request->nomor_identitas,
            'jurusan_id' => $request->jurusan_id,
            'kelas' => $request->kelas,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('login')->with('status', 'Registrasi berhasil! Mohon tunggu Admin memverifikasi akun Anda.');

        // return redirect(RouteServiceProvider::HOME);
    }
}
