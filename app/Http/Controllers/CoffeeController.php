<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoffeeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        $coffees = Coffee::orderBy('created_at', 'desc')->paginate(8);

        return view('coffee.index', [
            'coffees' => $coffees
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function create()
    {
        return view('coffee.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|file',
        ]);

        // save file
        $imagePath = $request->file('image')->store('images', 'public');

        Coffee::create([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'image' => $imagePath,
        ]);

        return redirect()->route('coffee.index')
            ->with('success','Product created successfully.');
    }

    /**
     * @param Coffee $coffee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function edit(Coffee $coffee)
    {
        return view('coffee.edit', [
            'coffee' => $coffee,
        ]);
    }

    /**
     * @param Request $request
     * @param Coffee $coffee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Coffee $coffee)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'file',
        ]);

        // save file
        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $coffee->image;
        }

        $coffee->update([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'image' => $imagePath,
        ]);

        return redirect()->route('coffee.index')
            ->with('success','Coffee updated successfully.');
    }

    /**
     * @param Coffee $coffee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Coffee $coffee)
    {
        $coffee->delete();

        return redirect()->route('coffee.index')
            ->with('success', 'Coffee deleted successfully');
    }
}
