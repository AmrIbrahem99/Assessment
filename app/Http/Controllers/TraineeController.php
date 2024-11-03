<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TraineeController extends Controller
{
    public function index(Request $request): Factory|Application|View
    {
        $query = Trainee::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%");
            });
        }

        $trainees = $query->latest()->paginate(10);
        return view('trainees.index', compact('trainees'));
    }

    public function create(): Factory|Application|View
    {
        return view('trainees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:trainees',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|in:active,completed,dropped'
        ]);

        Trainee::create($validated);
        return redirect()->route('admin.trainees.index')->with('success', 'Trainee added successfully');
    }

    public function edit(Trainee $trainee): Factory|Application|View
    {
        return view('trainees.edit', compact('trainee'));
    }

    public function update(Request $request, Trainee $trainee):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:trainees,email,'.$trainee->id,
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|in:active,completed,dropped'
        ]);

        $trainee->update($validated);
        return redirect()->route('admin.trainees.index')->with('success', 'Trainee updated successfully');
    }

    public function destroy(Trainee $trainee): RedirectResponse
    {
        $trainee->delete();
        return redirect()->route('admin.trainees.index')->with('success', 'Trainee deleted successfully');
    }
}
