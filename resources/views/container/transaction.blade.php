@extends('container.index')
@section('content')
    <div class="row px-5">
        <div class="col">
            <table class="table table-striped-column table-striped" style="margin-bottom: 100px;">
                <thead>
                    <tr class="text-left">
                        <th scope="col">#</th>
                        <th scope="col">Particular</th>
                        <th scope="col">Account</th>
                        <th scope="col" class="text-center">Income</th>
                        <th scope="col " class="text-center">Expense</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $income = 0;
                        $expense = 0;
                    @endphp
                    @forelse ($balances as $key=>$data)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td><a href="{{ route('balance', [$data->account_id, $data->id]) }}">
                                    <h6>{{ $data->note }}</h6>
                                    <small style="font-size: 8px">{{ $data->date }}</small>
                                    <small style="font-size: 8px">{{ $data->created_at->diffForHumans() }}</small>
                                </a>
                            </td>
                            <td>
                                <a
                                    href="{{ route('transaction_account', $data->account_id) }}">{{ $data->account->account_name }}</a>
                            </td>
                            @if ($data->account_type == '0')
                                <td class="text-end pe-5">{{ $data->amount }}</td>
                                @php
                                    $income += $data->amount;
                                @endphp
                                <td></td>
                            @else
                                <td></td>
                                @php
                                    $expense += $data->amount;
                                @endphp
                                <td class="text-end pe-5">{{ $data->amount }}</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <p class="text-secondary"> @isset($searchKey)
                                        <span class="text-danger"> " {{ $searchKey }} "</span> is not found!!
                                    @endisset
                                </p>
                            </td>
                            <td>
                                <a href="javascript:history.back();">Go Back</a>
                            </td>
                        </tr>
                        <script>
                            swal("Message", "Try Again To Search", 'error', {
                                button: true,
                                button: "OK",
                                timer: 5000,
                                dangerMode: true,
                            })
                        </script>
                    @endforelse

                </tbody>
            </table>
            <div class="bottom-0  w-100 position-fixed d-flex justify-content-center">
                <div class="w-25 ">
                    <h5>Total Balance</h5>
                    <p class="@if ($income < $expense) text-danger @else text-success @endif">
                        {{ $income - $expense }}</p>
                </div>
                <div class="w-25 ">
                    <h5>Total Income</h5>
                    <p class="text-success">{{ $income }}</p>
                </div>
                <div class="w-25     mb-2">
                    <h5 class=""> Total Expense</h5>
                    <p class="@if ($income < $expense) text-danger @else text-success @endif">

                        {{ $expense }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('search')
    <div class="search-box">
        <form action="{{ route('searchBalance') }}" method="POST">
            @csrf
            <input type="text" value="@isset($searchKey) {{ $searchKey }} @endisset" name="search"
                placeholder="Search...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
@endsection

@section('download')
    <li><a href="{{ route('downloadAllExcel') }}" class="text-dark"><i class="fa fa-file-excel " aria-hidden="true"></i>
            <span style="font-size: 14px;"> Export to
                Excel</span></a></li>
    <li><a href="{{ route('downloadAllPdf') }}" class="text-dark"><i class="fa-solid fa-file-pdf text-dark"></i><span
                style="font-size: 14px;"> Export to
                Pdf</span></a></li>
@endsection
