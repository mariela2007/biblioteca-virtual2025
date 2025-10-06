<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        // Actualizar nombre y email
        $user->fill($request->only('name', 'email'));

        // Solo actualizar la contraseña si se escribió
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Desverificar email si cambió
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Avatar
        if ($request->hasFile('avatar')) {
            // Borrar avatar anterior si existe
            if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            // Guardar nuevo avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = basename($path); // Solo el nombre del archivo
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}