<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prize;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax() && $request->has('page')) {
            return response()->json(Prize::orderBy('id', 'desc')->paginate(10));
        }
        return Inertia::render('Admin/Prizes/Index');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request->ajax() && $request->method('post')) {
            $validated = $request->validate([
                'search' => 'required|string',
            ]);
            return response()->json(Prize::orderBy('id', 'desc')->where('name', 'LIKE', "%{$validated['search']}%")->paginate(10));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Prizes/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price'   => 'required|integer',
            'visible' => 'required|boolean',
        ]);
        Prize::create($validate);
        return redirect()->route('prizes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function show(Prize $prize)
    {
        return Inertia::render('Admin/Prizes/Show', [
            'prize' => $prize,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function edit(Prize $prize)
    {
        return Inertia::render('Admin/Prizes/Edit', [
            'prize' => $prize
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prize $prize)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price'   => 'required|integer',
            'visible' => 'required|boolean',
        ]);
        $prize->update($validate);
        return redirect()->route('prizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prize $prize)
    {
        $prize->delete();
        return redirect()->intended('/admin/prizes');
    }
}
