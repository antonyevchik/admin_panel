<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = User::query()
            ->when($request->filled('email'), fn($query) => $query->where('email', 'like', '%' . $request->email . '%'))
            ->when($request->filled('name'), fn($query) => $query->where('name', 'like', '%' . $request->name . '%'))
            ->when($request->filled('status'), fn($query) => $query->where('status', $request->status))
            ->get();


        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        return view('admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        $admin->update($request->validated());

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Admin deleted successfully!',
            'redirect_url' => route('admins.index'),
        ]);
    }
}
