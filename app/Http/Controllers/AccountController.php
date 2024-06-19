<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AccountDetail;
use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    public function index(){
        $accounts=Account::where('user_id',auth()->user()->id)->get();
        foreach($accounts as $acc){
            // get the open balance
        $opening_balance=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$acc->id)->where('opening_balance','1')->first('amount');
        $acc['opening_balance'] =$opening_balance['amount'] ;
        }
        return view('container.account',compact('accounts'));;
    }

    public function store(AccountRequest $req){
        $req->validated();
        $acc=Account::create([
            'account_name'=>$req['account_name'],
            'description'=>$req['description'],
            'user_id'=>auth()->user()->id,
        ]);
        if($acc){
            AccountDetail::create([
                'user_id'=>auth()->user()->id,
                'account_id'=>$acc->id,
                'amount'=>$req['opening_balance'],
                'opening_balance'=>"1",
                'account_type'=>'0',
                'date'=>Carbon::now()->format('Y-m-d'),
                'time'=>Carbon::now()->format('H:i:s'),
                'note'=>'Opening Balance',
            ]);
        }

        $accounts=Account::where('user_id',auth()->user()->id)->get();
        return redirect()->route('account',compact('accounts'))->with('success', "Account Created Successfully");
    }

    public function show($id)
    {
        $account=Account::where('user_id',auth()->user()->id)->where('id',$id)->first();
        // get the open balance
        $opening_balance=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$id)->where('opening_balance','1')->first('amount');
        $account['opening_balance'] =$opening_balance['amount'] ;

        $accounts=Account::where('user_id',auth()->user()->id)->get();

        foreach($accounts as $acc){
            // get the open balance
        $opening_balance=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$acc->id)->where('opening_balance','1')->first('amount');
        $acc['opening_balance'] =$opening_balance['amount'] ;
        }
        return view('container.account_edit',compact('account', 'accounts'));
    }

    public function update($id,AccountRequest $request){
        $request->validated();
        $account=Account::find($id);
        $account->update([
            'account_name' => $request->account_name,
            'description' => $request->description,
        ]);

         AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$id)->where('opening_balance','1')->update([
            'amount'=>$request->opening_balance,
            ]
         );

        $account=Account::where('user_id',auth()->user()->id)->where('id',$id)->first();
        // get the open balance
        $opening_balance=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$id)->where('opening_balance','1')->first('amount');
        $account['opening_balance'] =$opening_balance['amount'] ;

        $accounts=Account::where('user_id',auth()->user()->id)->get();

        foreach($accounts as $acc){
            // get the open balance
        $opening_balance=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$acc->id)->where('opening_balance','1')->first('amount');
        $acc['opening_balance'] =$opening_balance['amount'] ;
        }
        return view('container.account_edit',compact('account', 'accounts'));

    }

    public function destroy($id){
        $account=Account::findOrFail($id);
        if($account->user_id==auth()->user()->id){
            $account->delete();
            AccountDetail::where('account_id',$id)->delete();

            $accounts=Account::where('user_id',auth()->user()->id)->get();
        return view('container.account',compact('accounts'));;
        }else{
            return redirect()->back();
        }
    }
}