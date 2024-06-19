@extends('container.index')
@section('content')
    <section class="sec-second-income">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descriptions</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $key=>$data)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>From <a
                                            href="{{ route('transaction_account', $data->from_account_id) }}">{{ $data->fromAccount->account_name }}</a>
                                        to
                                        <a
                                            href="{{ route('transaction_account', $data->to_account_id) }}">{{ $data->toAccount->account_name }}</a>
                                    </td>
                                    <td>{{ $data->amount }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <form action="{{ route('transfer') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="mb-3">Amount</label>
                            <input type="number" value="{{ old('amount') }}" name="amount" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label class="mb-3">From</label>
                            <select class="form-control mb-3" id="exampleFormControlSelect1" name="from_account_id">
                                <option>Choose Account</option>
                                @forelse ($accounts as $ac)
                                    <option value="{{ $ac->id }}">{{ $ac->account_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-3">To</label>
                            <select class="form-control mb-3" id="exampleFormControlSelect1" name="to_account_id">
                                <option>Choose Account</option>
                                @forelse ($accounts as $ac)
                                    <option value="{{ $ac->id }}">{{ $ac->account_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-3">Date</label>
                            <input type="date" name="date" value="{{ now()->format('Y-m-d') }}"
                                class="form-control mb-3" placeholder="Select Date...">
                        </div>
                        <div class="form-group">
                            <label class="mb-3">Time</label>
                            <input type="time" name="time" value="{{ now()->format('H:i') }}"
                                class="form-control mb-3" placeholder="Select Time...">
                        </div>
                        <button type="submit">Save</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
    </section>
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
