<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use App\Models\Veterinarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function pets()
    {
        $pets = Pet::where('owner_id', auth()->id())->get();
        return view('user_pets', compact('pets'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', 'in:user,staff'],
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('status', 'User role updated successfully.');
    }

    public function userRedirect()
    {
        $role = Auth::user()->role ?? 'user';

        return match ($role) {
            'admin' => view('dashboard'),
            'vet' => view('veterinarian_dashboard'),
            'user'  => view('user_dashboard'),
            default => redirect('/'),
        };
    }

    public function updateSpecialization(Request $request, $vetId)
    {
        $request->validate([
            'specialization' => 'required|string|max:255',
            'approve' => 'boolean'
        ]);

        DB::beginTransaction();
        try {
            // Update specialization and is_active in vet_profile
            DB::table('vet_profile')->updateOrInsert(
                ['user_id' => $vetId],
                [
                    'specialization' => $request->specialization,
                    'is_active' => $request->approve ? 1 : 0,
                ]
            );

            // Optional: update status in users table if you want
            if ($request->approve) {
                DB::table('users')->where('id', $vetId)->update([
                    'status' => 'approved',
                ]);
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleActiveStatus(Request $request, $vetId)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        try {
            // Update the is_active field in vet_profile for the given user_id
            $updated = DB::table('vet_profile')
                ->where('user_id', $vetId)
                ->update(['is_active' => $request->is_active]);

            if ($updated) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'Vet profile not found or no changes made.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

}