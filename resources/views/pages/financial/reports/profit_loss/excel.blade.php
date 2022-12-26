    <table id="table">
        <tbody>
            <div style="display: none">
                {{ $total_income = 0 }}
                {{ $total_expenses = 0 }}
            </div>
            <tr>
                <th colspan="5" style="font-weight: bolder">Income</th>
            </tr>
            @foreach ($income_groups as $group)
                <tr>
                    <td></td>
                    <td colspan="4" style="font-weight: bolder">{{ $group->name }}</td>
                </tr>
                @foreach ($group->childs as $account)
                    @if ($account->total != 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="2">{{ $account->name }}</td>
                            <td class="text-end">{{ $account->total }}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="3" style="font-weight: bolder">Group Total</td>
                    <td style="font-weight: bolder">{{ $group->childs->sum('total') }}</td>
                </tr>
                <div style="display: none">
                    {{ $total_income += $group->childs->sum('total') }}
                </div>
            @endforeach
            <tr>
                <th colspan="4" style="font-weight: bolder">Income Total</th>
                <th style="font-weight: bolder">{{ $total_income }}</th>
            </tr>
            <tr>
                <th colspan="5" style="font-weight: bolder">Expenses</th>
            </tr>
            @foreach ($expenses_groups as $group)
                <tr>
                    <td></td>
                    <td colspan="4" class="text-left" style="font-weight: bolder">{{ $group->name }}</td>
                </tr>
                @foreach ($group->childs as $account)
                    @if ($account->total != 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="2">{{ $account->name }}</td>
                            <td class="text-end">{{ $account->total }}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="3" style="font-weight: bolder">Group Total</td>
                    <td style="font-weight: bolder">{{ $group->childs->sum('total') }}</td>
                </tr>
                <div style="display: none">
                    {{ $total_expenses += $group->childs->sum('total') }}
                </div>
            @endforeach
            <tr>
                <th colspan="4" style="font-weight: bolder">Expenses Total</th>
                <th style="font-weight: bolder">{{ $total_expenses }}</th>
            </tr>
            <tr>
                <th colspan="4" style="font-weight: bolder">Net Profit for the Year</th>
                <th style="font-weight: bolder">{{ $total_income - $total_expenses }}</th>
            </tr>
        </tbody>
    </table>
