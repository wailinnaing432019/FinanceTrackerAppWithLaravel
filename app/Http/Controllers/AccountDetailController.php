<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use App\Exports\ExportExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Models\AccountDetail;

class AccountDetailController extends Controller
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
        $validatedData=$request->validate(
          [
            'account_type'=>'required|integer',
            'amount'=>'required|integer|min:1',
            'note'=>'required|string',
            'date'=>'string',
            'time'=>'string',
          ],
          [
            'account_type.required'=>'Choose Income Or Expense First',
          'amount.required'=>'Please enter amount',
          'amount.min'=>'Please enter positive integer or real amount',
          'date.required'=>'Please Choose date',
          'time.required'=>'Please Choose time',
          'note.required'=>'Please Fill a note',
          ]
        );
        $validatedData['user_id']=auth()->user()->id;
        $validatedData['account_id']=$request->account_id;
        $accountDetail=AccountDetail::create($validatedData);
        if($accountDetail){
            return back()->with('success','Account Detail Added Successfully');
        }else{
            return back()->with('error','Something went wrong');
        }
    }

        public function allView(){
            $balances=AccountDetail::where('user_id',auth()->user()->id)->get();

        return view('container.transaction',compact('balances'));
    }

    public function downloadExcel($id){
        $time=Carbon::now();
        $name=Account::where('id',$id)->pluck('account_name')->first();
        return (new ExportExcel($id))->download($name.'-'.$time.'.csv');

    }
        public function downloadPdf($id){
        $time=Carbon::now();
        $name=Account::where('id',$id)->pluck('account_name')->first();
        return (new ExportExcel($id))->download($name.'-'.$time.'.pdf',Excel::DOMPDF);

    }

    public function downloadAllExcel(){
        return (new ExportExcel)->download('Wai-.csv');
    //     $time=Carbon::now();
    //     return (new ExportExcel)->download('wai-'.$time.'.xlsx');

    }
 public function downloadAllPdf(){
    $time=Carbon::now();
        return (new ExportExcel)->download('wai-'.$time.'.pdf',Excel::DOMPDF);

 }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $balances=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$id)->orderBy('date')->get();
        $accounts=Account::where('user_id',auth()->user()->id)->get();
        return view('container.balance',compact('balances','accounts'));
    }
public function filterBalance(Request $request){
    // return $request->account_id;
    $balances=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$request->account_id)->whereBetween('date', [$request->start, $request->end])->get();
    // $balances=$balances->where('date', '=>', $request->start)->orWhere('date', '<=', $request->end)->get();
    $accounts=Account::where('user_id',auth()->user()->id)->get();
    $startDate=$request->start;
    $endDate=$request->date;
    if($balances->isEmpty()){
        $balances=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$request->account_id)->orderBy('date')->get();
        // return view('container.balance',compact('balances','accounts'))->with('noSearch',"Not Data found");
        return back()->with('noSearch',"Not Data found");
    }else{
        // return $balances;
        // return redirect()->with(['balances' => $balances,'accounts'=>$accounts]);
        // return $balances;
        return view('container.balance',compact('balances','accounts','startDate','endDate'));

    }
}
    // view Balance
    public function balanceView($account_id,$id){
        $balances=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$account_id)->get();
        $accounts=Account::where('user_id',auth()->user()->id)->get();
        $balance=AccountDetail::where('account_id',$account_id)->where('id',$id)->where('user_id',auth()->user()->id)->first();
        return view('container.balance_edit',compact('balances','accounts','balance'));
    }

    // update balance
    public function balanceUpdate($account_id,$id,Request $request){
        $validatedData=$request->validate(
          [
            'account_type'=>'required|integer',
            'amount'=>'required|integer|min:0',
            'note'=>'required|string',
            'date'=>'string',
            'time'=>'string',
          ],
          [
            'account_type.required'=>'Choose Income Or Expense First',
          'amount.required'=>'Please enter amount',
          'amount.min'=>'Please enter positive integer or real amount',
          'date.required'=>'Please Choose date',
          'time.required'=>'Please Choose time',
          'note.required'=>'Please Fill a note',
          ]
        );
if($request->amount<=0){
    AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$request->account_id)->where('id',$id)->delete();
    return redirect()->route('transaction_account',$account_id)->with('success','Balance Detail Deleted Successfully');
}else{
        $validatedData['user_id']=auth()->user()->id;
        $validatedData['account_id']=$request->account_id;
        $status=AccountDetail::where('user_id',auth()->user()->id)->where('account_id',$validatedData['account_id'])->where('id',$id)->update($validatedData);
        if($status){
            return back()->with('success','Successfully updated');

        }else{
            return back()->with('error','Something went wrong');

        }
    }

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountDetail $accountDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountDetail $accountDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountDetail $accountDetail)
    {
        //
    }
}