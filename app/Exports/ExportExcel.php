<?php
namespace App\Exports;
use App\Models\AccountDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportExcel implements FromView{
    use Exportable;

    public function __construct(int $account_id=0)
    {
        $this->account_id = $account_id;
    }
    public function view(): View {

        if($this->account_id ==0){
        $balances= AccountDetail::where('user_id', auth()->user()->id)->get();
        return view('container.download-all',['balances' => $balances]);
        }else{
            $balances= AccountDetail::where('user_id', auth()->user()->id)->where('account_id', $this->account_id)->get();

        return view('container.download-balance',['balances' => $balances]);
        }

    }
}