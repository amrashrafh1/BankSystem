<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax() && $request->has('page')) {
            return response()->json(Transaction::orderBy('id', 'desc')->paginate(10));
        }
        return Inertia::render('Admin/Transactions/Index');
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
            return response()->json(Transaction::orderBy('id', 'desc')->whereHas('sender', function ($query) use ($validated) {
                $query->where('email', 'like', '%' . $validated['search'] . '%');
            })->orWhereHas('receiver', function ($query) use ($validated) {
                $query->where('email', 'like', '%' . $validated['search'] . '%');
            })->paginate(10));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Transactions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender' => 'required|email|exists:users,email',
            'receiver' => 'required|email|exists:users,email',
            'points' => 'required|numeric'
        ]);
        $sender = User::where('email', $validated['sender'])->first();
        $receiver = User::where('email', $validated['receiver'])->first();
        Transaction::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'points' => $validated['points']
        ]);

        return redirect()->route('admin.transactions.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return Inertia::render('Admin/Transactions/Edit', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'sender' => 'required|email|exists:users,email',
            'receiver' => 'required|email|exists:users,email',
            'points' => 'required|numeric'
        ]);
        $sender = User::where('email', $validated['sender'])->first();
        $receiver = User::where('email', $validated['receiver'])->first();
        Transaction::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'points' => $validated['points']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
