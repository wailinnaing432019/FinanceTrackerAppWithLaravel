@extends('container.index')

@section('content')
    @if ($balances->count() == 0)
        <div class="alert alert-info">
            <p>Data not found {{ $balances->count() }}</p>
        </div>
    @else
        @if (Session::has('noSearch'))
            <script>
                swal("Message", "{{ Session::get('noSearch') }}", 'success', {
                    button: true,
                    button: "OK",
                    timer: 5000,
                    dangerMode: true,
                })
            </script>
        @endif
        <div class="row ms-5">
            <div class="col-7">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Account -
                        <a
                            href="{{ route('transaction_account', $balances[0]->account_id) }}">{{ $balances[0]->account->account_name }}</a>
                    </h5>
                    <div>
                        <form action="{{ route('filterBalance') }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <div>
                                <input type="hidden" name="account_id" value="{{ $balances[0]->account_id }}">
                                <label style="font-size: 14px;" for="start">Start Date</label>
                                <input type="date" class="form-control" name="start"
                                    value="" id="">
                            </div>
                            <div>
                                <label style="font-size: 14px;" for="start">End Date</label>
                                <input type="date" class="form-control" name="end"
                                    value="{{ now()->format('Y-m-d') }}" id="">
                            </div>
                            <div class="pt-4">
                                <button type="submit" id="filter"><i class="fa fa-filter"
                                        aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-striped-column table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Particular</th>
                            <th scope="col">Income</th>
                            <th scope="col">Expense</th>
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
                        @endforelse

                    </tbody>
                </table>
                <div class="bottom-0 w-50 position-fixed d-flex justify-content-center ">
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
            <div class="col">
                <section class="sec-second-income">
                    <div class="container">

                        <div class="d-flex justify-content-center mt-3">
                            <button id="inc-btn" class="btn rounded-pill me-1">Income</button>
                            <button id="exp-btn" class="btn rounded-pill me-1">Expense</button>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" style="width:150px;height:40px; background-color:#8a2be1;"
                                    class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Choose Account
                                </button>
                                <ul class="dropdown-menu ">
                                    @forelse ($accounts as $acc)
                                        <li><a class="dropdown-item"
                                                href="/transaction/account/{{ $acc->id }}">{{ $acc->account_name }}</a>
                                        </li>
                                    @empty
                                        <li><a href="/account"><span style="color: green;">Add Acount</span> </a></li>
                                    @endforelse
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a href="/account" class="ps-3">Add Acount</a></li>
                                </ul>
                            </div>
                        </div>
                        <form id="form-data" action="{{ route('transaction_account', $data->account_id) }}" method="POST">
                            @csrf
                            <div>
                                <input type="hidden" name="account_id" value="{{ $data->account_id }}">
                                <input type="hidden" class="" name="account_type" value="" id="data">
                            </div>
                            <div class="form-group">
                                <label class="mb-3" for="amount">Choose Expense Or Income</label>
                                <input type="number"
                                    @error('amount')
                    style="border: 1px solid red;"
                @enderror
                                    disabled name="amount" id="amount" class="form-control mb-3"
                                    placeholder="Enter ...">
                                @error('amount')
                                    <span class="text-danger t-8">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="mb-3" for="note">Notes</label>
                                <input type="text"
                                    @error('note')
                    style="border: 1px solid red;"
                @enderror
                                    id="note" disabled name="note" class="form-control mb-3"
                                    placeholder="Enter notes..">
                                @error('amount')
                                    <span class="text-danger t-8">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="mb-3">Date</label>
                                <input type="date" disabled value="{{ now()->format('Y-m-d') }}" name="date"
                                    class="form-control mb-3" placeholder="Select Date...">
                            </div>
                            <div class="form-group">
                                <label class="mb-3">Time</label>
                                <input type="time" disabled value="{{ now()->format('H:i') }}" name="time"
                                    class="form-control mb-3" placeholder="Select Time...">
                            </div>
                            <button type="submit" id="save" disabled>Save</button>
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    @endif
@endsection

@section('search')
    <div class="search-box">
        <form action="{{ route('searchBalance') }}" method="POST">
            @csrf
            <input type="hidden" name="account_id" value="{{ $data->account_id }}">
            <input type="text" value="@isset($searchKey) {{ $searchKey }} @endisset"
                name="search" placeholder="Search...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
@endsection
@section('download')
    <li><a href="{{ route('downloadExcel', $data->account_id) }}" class="text-dark"><i class="fa fa-file-excel "
                aria-hidden="true"></i>
            <span style="font-size: 14px;"> Export to
                Excel</span></a></li>
    <li><a href="{{ route('downloadPdf', $data->account_id) }}" class="text-dark"><i
                class="fa-solid fa-file-pdf text-dark"></i><span style="font-size: 14px;"> Export to
                Pdf</span></a></li>
@endsection
