@extends('container.index')
@section('content')
    <section class="sec-second">
        <div class="container">
            {{-- <div class="tabs">
                <ul id="tabs-nav">
                    <li><a href="#tab1">All</a></li>
                    <li><a href="#tab2">Daily</a></li>
                    <li><a href="#tab3">Weekly</a></li>
                    <li><a href="#tab4">Monthly</a></li>
                    <li><a href="#tab5">Yearly</a></li>
                </ul>
                <div id="tabs-content">
                    <div id="tab1" class="tab-content">
                        <h2>All</h2>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Iusto, perferendis. Commodi ratione et veritatis porro dicta?
                            Corporis molestiae vero, tempora aperiam repellendus, laborum
                            facere blanditiis fuga enim sapiente, minus a.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Deserunt repellendus neque, dolorum, inventore error doloremque
                            impedit, provident facilis voluptatem cum quas. Facere ut
                            nostrum, nemo dolor tenetur mollitia corrupti iusto?
                        </p>
                    </div>
                    <div id="tab2" class="tab-content">
                        <h2>Daily</h2>
                        <p>This is daily.</p>
                    </div>
                    <div id="tab3" class="tab-content">
                        <h2>Weekly</h2>
                        <p>This is weekly.</p>
                    </div>
                    <div id="tab4" class="tab-content">
                        <h2>Monthly</h2>
                        <p>This is monthly.</p>
                    </div>
                    <div id="tab5" class="tab-content">
                        <h2>Yearly</h2>
                        <p>This is yearly.</p>
                    </div>
                </div>
            </div> --}}
            @forelse ($accounts as $account)
                <div class="" style="border-bottom: 1px solid #8a2be1; height:140px; margin-bottom:10px;">
                    <h4>Account Name - <a href="{{ route('transaction_account', $account->id) }}">
                            {{ $account->account_name }} </a></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total Income</th>
                                <th scope="col">Total Expense</th>
                                <th scope="col">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-danger">
                                <td class="text-success">{{ $account->income }}
                                </td>
                                <td class="@if ($account->income < $account->expense) text-danger @else text-success @endif">
                                    {{ $account->expense }}
                                </td>
                                <td class="@if ($account->income < $account->expense) text-danger @else text-success @endif">
                                    {{ $account->balance }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @empty
            @endforelse

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
    <li><a href="{{ route('downloadAllExcel') }}" class="text-dark"><i class="fa fa-file-excel " aria-hidden="true"></i>
            <span style="font-size: 14px;"> Export to
                Excel</span></a></li>
    <li><a href="{{ route('downloadAllPdf') }}" class="text-dark"><i class="fa-solid fa-file-pdf text-dark"></i><span
                style="font-size: 14px;"> Export to
                Pdf</span></a></li>
@endsection
