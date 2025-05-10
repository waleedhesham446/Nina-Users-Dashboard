<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $perPage = $request->input('perPage', 10);
        
        $users = User::query()
            ->with('address')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->whereRaw("(first_name || ' ' || last_name) LIKE ?", ["%{$search}%"])
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('address', function ($subQuery) use ($search) {
                            $subQuery
                                ->where('country', 'like', "%{$search}%")
                                ->orWhere('city', 'like', "%{$search}%")
                                ->orWhere('post_code', 'like', "%{$search}%")
                                ->orWhere('street', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('Users/Index', [
            'users' => $users,
            'filters' => [
                'search' => $search,
                'perPage' => $perPage,
            ],
        ]);
    }

    public function show($id)
    {
        $user = User::with('address')->findOrFail($id);
        
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address.country' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.post_code' => 'required|string|max:255',
            'address.street' => 'required|string|max:255',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
        ]);

        $user->address()->create([
            'country' => $validated['address']['country'],
            'city' => $validated['address']['city'],
            'post_code' => $validated['address']['post_code'],
            'street' => $validated['address']['street'],
        ]);

        return redirect()->route('users.index')
            ->with('message', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::with('address')->findOrFail($id);
        
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address.country' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.post_code' => 'required|string|max:255',
            'address.street' => 'required|string|max:255',
        ]);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
        ]);

        $user->address()->update([
            'country' => $validated['address']['country'],
            'city' => $validated['address']['city'],
            'post_code' => $validated['address']['post_code'],
            'street' => $validated['address']['street'],
        ]);

        return redirect()->route('users.index')
            ->with('message', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('users.index')
            ->with('message', 'User deleted successfully!');
    }
}
