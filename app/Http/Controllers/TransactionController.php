<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\AccountDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('user_id',auth()->user()->id)->get();
        $accounts=Account::where('user_id',auth()->user()->id)->get();
        return view('container.transfer',compact('transactions','accounts'));
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

        $request->validate([
            'to_account_id'=>'required|integer',
            'from_account_id'=>'required|integer',
            'amount'=>'required|integer|min:1',
            'description'=>'nullable|string',
            'date'=>'required',
            'time'=>'required',
        ],[
            'to_account_id.required'=>'Account needs to choose to transfer ',
            'from_account_id.required'=>'Account needs to choose to transfer',
            'amount.required'=>'Amount needs to be filled in this box',
            'date.required'=>'Date needs to be filled in this box',
            'time.required'=>'Time needs to be filled in this box',
        ]);
        if($request->to_account_id!=$request->from_account_id){

            $transferAmount=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$request->from_account_id)->get();
            $totalIncome=$transferAmount->where('account_type','0')->sum('amount');
            $totalExpense=$transferAmount->where('account_type','1')->sum('amount');
            if($totalIncome-$totalExpense >= 0 && $totalIncome-$totalExpense >=$request->amount){

                $status=Transaction::create([
                    'amount'=>$request->amount,
                    'to_account_id'=>$request->to_account_id,
                    'from_account_id'=>$request->from_account_id,
                    'date'=>$request->date,
                    'time'=>$request->time,
                    'description'=>$request->description,
                    'user_id'=>auth()->user()->id,
                ]);
                $transferName=$status->fromAccount->account_name;
                $receiveName=$status->toAccount->account_name;
                if($status){
                    $fillReceiveData=AccountDetail::create([
                        'amount'=>$request->amount,
                        'user_id'=>auth()->user()->id,
                        'account_id'=>$request->to_account_id,
                        'account_type'=>'0',
                        'note'=>'From '.$status->fromAccount->account_name.' to '.$status->toAccount->account_name,
                        'date'=>Carbon::now()->format('Y-m-d'),
                        'time'=>Carbon::now()->format('H:i:s'),
                    ]);
                    if($fillReceiveData){
                        $transferData=AccountDetail::create([
                        'amount'=>$request->amount,
                        'user_id'=>auth()->user()->id,
                        'account_id'=>$request->from_account_id,
                        'account_type'=>'1',
                        'note'=>'From '.$status->fromAccount->account_name.' to '.$status->toAccount->account_name,
                        'date'=>Carbon::now()->format('Y-m-d'),
                        'time'=>Carbon::now()->format('H:i:s'),
                    ]);
                    return back()->with('success',"Transaction Successful");
                    }else{
                        return back()->with('error',"Transaction Failed to fill data for expense");
                    }
                }else{
                    return back()->with('error',"Transaction Failed to fill data for income");
                }

            }else{
                return back()->with('error',"The account' balance is lower than the amount you requested ! The Balance is ".$totalIncome-$totalExpense);
            }

        }else{
            return back()->with('error',"Transfer Account and Receive Account must not be the same");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}