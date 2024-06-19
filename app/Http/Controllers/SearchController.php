<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AccountDetail;

class SearchController extends Controller
{
    public function searchBalance(Request $request){
        $searchKey = $request->search;
        $accountId = $request->account_id;
        if($request->account_id){
            $balances = AccountDetail::where('user_id', auth()->user()->id)
            ->where('account_id', $accountId)
            ->where(function ($query) use ($searchKey) {
                $query->where('amount', 'LIKE', '%' . $searchKey . '%')
                    ->orWhere('note', 'LIKE', '%' . $searchKey . '%');
            })
            ->get();

            $accounts=Account::where('user_id', auth()->user()->id)->get();

            if($balances->isEmpty()){
            return back()->with('noSearch',"Not Data found");
            }else{
            return view('container.balance',compact('balances','accounts','searchKey'));
            }
        }else{
            $balances = AccountDetail::where('user_id', auth()->user()->id)
            ->where(function ($query) use ($searchKey) {
                $query->where('amount', 'LIKE', '%' . $searchKey . '%')
                    ->orWhere('note', 'LIKE', '%' . $searchKey . '%');
            })
            ->get();

            $accounts=Account::where('user_id', auth()->user()->id)->get();

            // if($balances->isEmpty()){
            //     return back()->with('noSearch',"Not Data found");
            // }else{
            return view('container.transaction',compact('balances','searchKey'));
            // }
        }


    }
}