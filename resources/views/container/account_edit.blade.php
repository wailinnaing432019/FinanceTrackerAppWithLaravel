@extends('container.index')
@section('content')
    {{-- <section class="sec-mv-income">
        <header>
            <nav class="hnav">
                <div class="income-div">
                    <a href="index.html"><i class="fa-solid fa-arrow-left"></i></a>
                    <h3>Account</h3>
                </div>
            </nav>
        </header>
    </section> --}}
    <section class="sec-second-income">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Account Name</th>
                                <th scope="col">Opening Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accounts as $key=>$acc)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><a href="\transaction\account\{{ $acc->id }}">{{ $acc->account_name }}</a></td>
                                    <td>{{ $acc->opening_balance }}</td>
                                    <td><a href="\account\{{ $acc->id }}"><i class="fa fa-edit"
                                                aria-hidden="true"></i></a></td>
                                    <td><a href="\account\destory\{{ $acc->id }}"><i class="fa fa-trash"
                                                aria-hidden="true"></i></a></td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <form action="{{ url('account/' . $account->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <a href="/account" class="float-end"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <label class="mb-3 fw-bold">Account Name</label>
                            <input type="text"
                                @error('account_name')
                    style="border: 1px solid red;"
                @enderror
                                name="account_name" value="{{ $account->account_name }}" class="form-control mb-3">
                            @error('account_name')
                                <span class="text-danger t-8 ">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-3 fw-bold">Openning Balance</label>
                            <input type="number"
                                @error('opening_balance')
                    style="border: 1px solid red;"
                @enderror
                                name="opening_balance" value="{{ $account->opening_balance }}" class="form-control mb-3">
                            @error('opening_balance')
                                <span class="text-danger t-8">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-3 fw-bold">Description</label>
                            <textarea class="form-control mb-3" name="description">{{ $account->description }}</textarea>
                        </div>

                        <button type="submit">Update account</button>
                        <button class="btn btn-secondary" type="reset">Cancel</button>
                    </form>
                </div>
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
@section('download')
    <li><a href="{{ route('downloadExcel', $account->id) }}" class="text-dark"><i class="fa fa-file-excel "
                aria-hidden="true"></i>
            <span style="font-size: 14px;"> Export to
                Excel</span></a></li>
    <li><a href="{{ route('downloadPdf', $account->id) }}" class="text-dark"><i
                class="fa-solid fa-file-pdf text-dark"></i><span style="font-size: 14px;"> Export to
                Pdf</span></a></li>
@endsection
