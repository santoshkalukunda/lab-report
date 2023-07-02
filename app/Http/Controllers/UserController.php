<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->hasRole('supre-admin')) {
            $validatedData = $request->validate([
                'email' => ['required', 'email', 'unique:users,email,' . $user->id],
                'name' => ['required', 'string', 'max:255'],
                'role' => ['required'],
                'council_no' => ['nullable'],
            ]);

            $user->syncRoles($validatedData['role']);
            $user = $user->update($validatedData);
        } else {
            $validatedData = $request->validate([
                'email' => ['required', 'email', 'unique:users,email,' . $user->id],
                'name' => ['required', 'string', 'max:255'],
                'council_no' => ['nullable'],
            ]);
            $user = User::findOrFail(Auth::user()->id);
            $user = $user->update($validatedData);
        }

        return redirect()
            ->back()
            ->with('success', 'User Updated');
    }

    public function changePassword(Request $request, User $user)
    {
        if (Auth::user()->hasRole('super-admin')) {
            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'password' => Hash::make($validatedData['password']),
            ]);
            return redirect()
                ->back()
                ->with('success', 'Password Changed');
        } else {
            $validatedData = $request->validate([
                'oldPassword' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user = User::findOrFail(Auth::user()->id);
            if (Hash::check($validatedData['oldPassword'], $user->password)) {
                $user->update([
                    'password' => Hash::make($validatedData['password']),
                ]);
                return redirect()
                    ->back()
                    ->with('success', 'Password Changed');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Old Pasword Not matched');
            }
        }
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->back()
            ->with('success', 'User Deleted');
    }
}
