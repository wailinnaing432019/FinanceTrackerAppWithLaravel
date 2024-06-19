<table style="width:100%" class="table table-striped-column table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col" style="width:40%;height:50px;">Particular</th>
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
                <td style="width:40%;height:50px;"><a href="{{ route('balance', [$data->account_id, $data->id]) }}">
                        <h6>{{ $data->note }}</h6>

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
        <tr>
            <td colspan="2">Total</td>
            <td>{{ $income }}</td>
            <td>{{ $expense }}</td>
        </tr>
        <tr>
            <td colspan="2">Total Balance</td>
            <td colspan="2">{{ $income - $expense }}</td>
        </tr>
    </tbody>
</table>
