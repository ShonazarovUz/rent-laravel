<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
    ): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $ads = Ad::all();
        return view('ads.index', ['ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(
    ): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        $request->validate([
            'title'       => 'required|min:5',
            'description' => 'required',
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title' => ['required' => 'Iltimos, sarlavhani kiriting!'],
        ]);

        $ad = Ad::query()->create([
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'address'     => $request->get('address'),
            'branch_id'   => $request->get('branch_id'),
            'user_id'     => auth()->id(),
            'status_id'   => Status::ACTIVE,
            'price'       => $request->get('price'),
            'rooms'       => $request->get('rooms'),
        ]);

        $file = Storage::disk('public')->put('/', $request->image);

        AdImage::query()->create([
            'ad_id' => $ad->id,
            'name'  => $file,
        ]);

    }

    /**
     * Display the specified resource
     */
    public function show(string $id)
    {
        $ad = Ad::query()->find($id);
        return view('ads.show', ['ad' => $ad]);
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
