<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // ✅ IMPORTANTE: Para manejar archivos
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile picture.
     * ✅ MÉTODO AGREGADO PARA LA FOTO PREMIUM
     */
    public function updateFoto(Request $request): RedirectResponse
    {
        $request->validate([
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = $request->user();

        if ($request->hasFile('foto')) {
            // 1. Borrar la foto anterior si existe para ahorrar espacio
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            // 2. Guardar la nueva foto en la carpeta 'perfiles' dentro de storage/app/public
            $path = $request->file('foto')->store('perfiles', 'public');

            // 3. Actualizar la ruta en la base de datos
            $user->update([
                'foto' => $path
            ]);
        }

        return Redirect::route('profile')->with('status', 'profile-photo-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // ✅ Borrar la foto del disco antes de eliminar al usuario
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}