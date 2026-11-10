<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SalesRepresentative;
use App\Services\R2StorageService;
use Illuminate\Http\Request;

class SalesRepresentativeController extends Controller
{
    /**
     * Display a listing of sales representatives.
     */
    public function index(Request $request)
    {
        $query = SalesRepresentative::query();

        // Non-authenticated public queries only get active reps by default
        if ($request->boolean('active_only') || !$request->user()) {
            $query->where('is_active', true);
        }

        // District filter
        if ($request->filled('district')) {
            $district = trim($request->input('district'));
            $query->where(function ($q) use ($district) {
                $q->where('districts', 'like', '%"' . $district . '"%')
                  ->orWhere('districts', 'like', '%' . $district . '%');
            });
        }

        // Search query
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('districts', 'like', "%{$search}%");
            });
        }

        $reps = $query->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($reps);
    }

    /**
     * Store a newly created sales representative.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'districts' => 'nullable',
            'image' => 'nullable',
            'is_active' => 'nullable',
            'sort_order' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        // Process districts array
        $districts = $request->input('districts');
        if (is_string($districts)) {
            $decoded = json_decode($districts, true);
            $districts = is_array($decoded) ? $decoded : array_map('trim', explode(',', $districts));
        }

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = R2StorageService::upload($request->file('image'), 'sales-reps');
        } elseif (is_string($request->input('image'))) {
            $imageUrl = $request->input('image');
        }

        $isActive = true;
        if ($request->has('is_active')) {
            $isActive = filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN);
        }

        $rep = SalesRepresentative::create([
            'name' => $validated['name'],
            'designation' => $validated['designation'] ?? 'Area Sales Executive',
            'phone' => $validated['phone'],
            'whatsapp' => $validated['whatsapp'] ?? $validated['phone'],
            'email' => $validated['email'] ?? null,
            'districts' => is_array($districts) ? array_values(array_filter($districts)) : [],
            'image' => $imageUrl,
            'is_active' => $isActive,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'message' => 'Sales representative created successfully',
            'representative' => $rep,
        ], 201);
    }

    /**
     * Display the specified sales representative.
     */
    public function show($id)
    {
        $rep = SalesRepresentative::findOrFail($id);
        return response()->json($rep);
    }

    /**
     * Update the specified sales representative.
     */
    public function update(Request $request, $id)
    {
        $rep = SalesRepresentative::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'districts' => 'nullable',
            'image' => 'nullable',
            'is_active' => 'nullable',
            'sort_order' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        $rep->name = $validated['name'];
        $rep->designation = $validated['designation'] ?? $rep->designation;
        $rep->phone = $validated['phone'];
        $rep->whatsapp = $validated['whatsapp'] ?? $rep->whatsapp;
        $rep->email = $validated['email'] ?? null;
        $rep->notes = $validated['notes'] ?? null;

        if ($request->has('districts')) {
            $districts = $request->input('districts');
            if (is_string($districts)) {
                $decoded = json_decode($districts, true);
                $districts = is_array($decoded) ? $decoded : array_map('trim', explode(',', $districts));
            }
            $rep->districts = is_array($districts) ? array_values(array_filter($districts)) : [];
        }

        if ($request->has('is_active')) {
            $rep->is_active = filter_var($request->input('is_active'), FILTER_VALIDATE_BOOLEAN);
        }

        if ($request->has('sort_order')) {
            $rep->sort_order = (int) $request->input('sort_order');
        }

        if ($request->hasFile('image')) {
            if ($rep->image) {
                R2StorageService::delete($rep->image);
            }
            $rep->image = R2StorageService::upload($request->file('image'), 'sales-reps');
        } elseif ($request->filled('image') && is_string($request->input('image'))) {
            $rep->image = $request->input('image');
        } elseif ($request->has('remove_image') && $request->boolean('remove_image')) {
            if ($rep->image) {
                R2StorageService::delete($rep->image);
            }
            $rep->image = null;
        }

        $rep->save();

        return response()->json([
            'message' => 'Sales representative updated successfully',
            'representative' => $rep,
        ]);
    }

    /**
     * Remove the specified sales representative.
     */
    public function destroy($id)
    {
        $rep = SalesRepresentative::findOrFail($id);

        if ($rep->image) {
            R2StorageService::delete($rep->image);
        }

        $rep->delete();

        return response()->json([
            'message' => 'Sales representative deleted successfully',
        ]);
    }
}
