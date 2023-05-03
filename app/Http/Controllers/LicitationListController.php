<?php

namespace App\Http\Controllers;

use App\Models\Licitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LicitationListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'duration' => 'required|integer|gt:0|lte:30',
            'min_bid' => 'required|integer|gte:0',
            'buy_price' => 'nullable|gt:min_bid',
            'photo' => 'required|image|mimes:jpeg,jpg,png',
            'manufacturer' => 'required|max:25',
            'model' => 'required|max:50',
            'year' => 'required|integer|gt:1900|lte:2023',
            'mileage' => 'required|integer|gte:0',
            'fuel' => 'required',
            'transmission' => 'required',
            'engine_size' => 'required|numeric|gt:0|lt:10',
            'horse_power' => 'required|integer|gt:0',
            'description' => 'required|max:255',
        ]);

        $licitation = new Licitation;
        $licitation->user_id = auth()->user()->id;
        $licitation->end = now()->addDays($validatedData['duration']);
        $licitation->views = 0;
        
        $licitation->manufacturer = $validatedData['manufacturer'];
        $licitation->model = $validatedData['model'];
        $licitation->year = $validatedData['year'];
        $licitation->mileage = $validatedData['mileage'];
        $licitation->fuel = $validatedData['fuel'];
        $licitation->engine_size = round($validatedData['engine_size'], 1);
        $licitation->horse_power = $validatedData['horse_power'];
        $licitation->transmission = $validatedData['transmission'];
        $licitation->description = $validatedData['description'];
        $licitation->min_bid = $validatedData['min_bid'];
        $licitation->buy_price = $validatedData['buy_price'];

        $photo_hash = Str::replace('/', '_', Hash::make($request->photo));
        $extension = $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('images/uploaded'), $photo_hash . '.' . $extension);
        $licitation->photo_path = '/images/uploaded/' . $photo_hash . '.' . $extension;

        $licitation->save();

        session()->flash('message', 'Licitation was created.');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
