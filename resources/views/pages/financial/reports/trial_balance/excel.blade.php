    <table>
        <thead>
            <tr>
                <th style="text-align: center;" rowspan="2">Account Ledger Name</th>
                <th style="text-align: center;" colspan="2">Opening Amount</th>
                <th style="text-align: center;" colspan="2">Transaction Amount</th>
                <th style="text-align: center;" colspan="2">Closing Amount</th>
            </tr>
            <tr>
                <th style="text-align: right">Debit</th>
                <th style="text-align: right">Credit</th>
                <th style="text-align: right">Debit</th>
                <th style="text-align: right">Credit</th>
                <th style="text-align: right">Debit</th>
                <th style="text-align: right">Credit</th>
            </tr>
        </thead>
        <tbody>

            <div style="display: none">
                {{ $total_opening_debit = 0 }}
                {{ $total_opening_credit = 0 }}
                {{ $total_transaction_debit = 0 }}
                {{ $total_transaction_credit = 0 }}
                {{ $total_closing_debit = 0 }}
                {{ $total_closing_credit = 0 }}
            </div>


            @foreach ($groups as $group)

                <tr>
                    <th style="font-weight: bolder" colspan="7">{{ $group->name }}</th>
                </tr>

                <div style="display: none">
                    {{ $group_opening_debit = 0 }}
                    {{ $group_opening_credit = 0 }}
                    {{ $group_transaction_debit = 0 }}
                    {{ $group_transaction_credit = 0 }}
                    {{ $group_closing_debit = 0 }}
                    {{ $group_closing_credit = 0 }}
                </div>
                @foreach ($group->childs as $account)
                    @if ($account->opening_debit != $account->opening_credit || $account->transaction_debit > 0 || $account->transaction_credit > 0)

                        <tr>
                            <td>{{ $account->name }}</td>
                            <td>
                                {{ $account->opening_debit > $account->opening_credit ? $account->opening_debit - $account->opening_credit : 0 }}
                            </td>
                            <td>
                                {{ $account->opening_credit > $account->opening_debit ? $account->opening_credit - $account->opening_debit : 0 }}
                            </td>
                            <td>
                                {{ $account->transaction_debit ? $account->transaction_debit : 0 }}
                            </td>
                            <td>
                                {{ $account->transaction_credit ? $account->transaction_credit : 0 }}
                            </td>
                            <td>
                                {{ $account->opening_debit + $account->transaction_debit > $account->opening_credit + $account->transaction_credit ? $account->opening_debit + $account->transaction_debit - $account->opening_credit - $account->transaction_credit : 0 }}
                            </td>
                            <td>
                                {{ $account->opening_credit + $account->transaction_credit > $account->opening_debit + $account->transaction_debit ? $account->opening_credit + $account->transaction_credit - $account->opening_debit - $account->transaction_debit : 0 }}
                            </td>

                            <div style="display: none">
                                {{ $account->opening_debit > $account->opening_credit ? ($group_opening_debit += $account->opening_debit - $account->opening_credit) : '' }}
                                {{ $account->opening_credit > $account->opening_debit ? ($group_opening_credit += $account->opening_credit - $account->opening_debit) : '' }}
                                {{ $group_transaction_debit += $account->transaction_debit }}
                                {{ $group_transaction_credit += $account->transaction_credit }}
                                {{ $account->opening_debit + $account->transaction_debit > $account->opening_credit + $account->transaction_credit ? ($group_closing_debit += $account->opening_debit + $account->transaction_debit - $account->opening_credit - $account->transaction_credit) : '' }}
                                {{ $account->opening_credit + $account->transaction_credit > $account->opening_debit + $account->transaction_debit ? ($group_closing_credit += $account->opening_credit + $account->transaction_credit - $account->opening_debit - $account->transaction_debit) : '' }}
                            </div>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th style="font-weight: bolder">Group Total</th>
                    <th style="font-weight: bolder">
                        {{ $group_opening_debit }}</th>
                    <th style="font-weight: bolder">
                        {{ $group_opening_credit }}</th>
                    <th style="font-weight: bolder">
                        {{ $group_transaction_debit }}</th>
                    <th style="font-weight: bolder">
                        {{ $group_transaction_credit }}</th>
                    <th style="font-weight: bolder">
                        {{ $group_closing_debit }}</th>
                    <th style="font-weight: bolder">
                        {{ $group_closing_credit }}</th>
                    <div style="display: none">
                        {{ $total_opening_debit += $group_opening_debit }}
                        {{ $total_opening_credit += $group_opening_credit }}
                        {{ $total_transaction_debit += $group_transaction_debit }}
                        {{ $total_transaction_credit += $group_transaction_credit }}
                        {{ $total_closing_debit += $group_closing_debit }}
                        {{ $total_closing_credit += $group_closing_credit }}
                    </div>
                </tr>
            @endforeach
            <tr>
                <th style="font-weight: bolder">Grand Total</th>
                <th style="font-weight: bolder">
                    {{ $total_opening_debit }}</th>
                <th style="font-weight: bolder">
                    {{ $total_opening_credit }}</th>
                <th style="font-weight: bolder">
                    {{ $total_transaction_debit }}</th>
                <th style="font-weight: bolder">
                    {{ $total_transaction_credit }}</th>
                <th style="font-weight: bolder">
                    {{ $total_closing_debit }}</th>
                <th style="font-weight: bolder">
                    {{ $total_closing_credit }}</th>
            </tr>
        </tbody>
    </table>
