<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoffeeRequest;
use App\Http\Requests\UpdateCoffeeRequest;
use App\Models\Coffee;
use App\Services\CoffeeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    /**
     * @var CoffeeService
     */
    protected $coffeeService;

    /**
     * CoffeeController constructor.
     * @param CoffeeService $coffeeService
     */
    public function __construct(CoffeeService  $coffeeService)
    {
        $this->coffeeService = $coffeeService;
    }

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
     * @param StoreCoffeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCoffeeRequest $request)
    {
        $validated = $request->validated();

        $imagePath = $this->coffeeService->saveImageAndReturnFilePath($request);

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
     * @param UpdateCoffeeRequest $request
     * @param Coffee $coffee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCoffeeRequest $request, Coffee $coffee)
    {
        $validated = $request->validated();

        if ($request->has('image')) {
            $this->coffeeService->deleteOldImage($coffee);
            $imagePath = $this->coffeeService->saveImageAndReturnFilePath($request);
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
        $this->coffeeService->deleteOldImage($coffee);
        $coffee->delete();

        return redirect()->route('coffee.index')
            ->with('success', 'Coffee deleted successfully');
    }
}
