<table class="table table-striped-column table-striped" style="margin-bottom: 100px; width:800px;">
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
                    </a>
                </td>
                <td>
                    <a href="">{{ $data->account->account_name }}</a>
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
        <tr>
            <td colspan="3">Total</td>
            <td>{{ $income }}</td>
            <td>{{ $expense }}</td>
        </tr>
        <tr>
            <td colspan="3">Total Balance</td>
            <td colspan="2" class="text-center">{{ $income - $expense }}</td>
        </tr>
    </tbody>
</table>
