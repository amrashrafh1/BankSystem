<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\AddCouponsJob;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use FrittenKeeZ\Vouchers\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax() && $request->has('page')) {
            return response()->json(Voucher::orderBy('id', 'desc')->paginate(10));
        }
        return Inertia::render('Admin/Points/Index');
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
            return response()->json(Voucher::orderBy('id', 'desc')->where('code', 'LIKE', "%{$validated['search']}%")->paginate(10));
        }
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
            'points' => 'required|integer',
            'count' => 'required|integer',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date'
        ]);
        
        AddCouponsJob::dispatch($validate);

        return redirect()->intended('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('vouchers')->where('id', $id)->delete();
        return redirect()->intended('/dashboard');
    }
}
