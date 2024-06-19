<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AccountDetail;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $accounts=Account::where('user_id',auth()->user()->id)->get();
        foreach($accounts as $data){
            $balances=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$data->id)->get();
            $income=$balances->where('account_type','0')->sum('amount');
            $expense=$balances->where('account_type','1')->sum('amount');

            $data['expense']=$expense;
            $data['income']=$income;
            $data['balance']=$income-$expense;
        }
        return view('container.summary',compact('accounts'));
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
        //
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