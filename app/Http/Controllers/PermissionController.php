<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Hakikisha hii ipo

class PermissionController extends Controller
{
    // --- USER SIDE ---
    public function index() {
        $my_requests = Permission::where('user_id', Auth::id())->latest()->get();
        // Hakikisha view hii ipo: resources/views/user/permissions/index.blade.php
        return view('user.permissions.index', compact('my_requests'));
    }

    public function store(Request $request) {
        $request->validate([
            'reason' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Imebadilishwa hapa
        ]);

        Permission::create([
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending', // Ni vizuri kuweka default status hapa kama hukuiweka kwenye Database
        ]);

        return redirect()->back()->with('success', 'Maombi yako ya ruhusa yametumwa!');
    }

    // --- ADMIN SIDE ---
   public function adminIndex()
{
    // Hakikisha unatumia variable inayoitwa $permissions
    $permissions = Permission::with('user')->latest()->paginate(20);
    
    // Lazima upitishe hiyo variable hapa
    return view('admin.permissions.index', compact('permissions'));
}

    public function updateStatus(Request $request, $id)
{
    $permission = Permission::findOrFail($id);
    
    // Validasi hali inayokuja (approved au rejected)
    $request->validate([
        'status' => 'required|in:approved,rejected'
    ]);

    $permission->update([
        'status' => $request->status
    ]);

    return back()->with('success', 'Hali ya ruhusa imerekebishwa kikamilifu.');
}
    public function adminProcess(Request $request, $id) {
        $permission = Permission::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_remark' => 'nullable|string'
        ]);

        $permission->update([
            'status' => $request->status,
            'admin_remark' => $request->admin_remark
        ]);

        return redirect()->back()->with('success', 'Maombi yamefanyiwa kazi!');
    }
}