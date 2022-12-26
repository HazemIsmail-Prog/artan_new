<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }}</title>
    <style>
        body {
            /* margin-top: 50px; */
            margin-bottom: 30px;
        }

        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 0.8rem;
        }

        #table th {
            /* background-color: #ddd; */
            border-top: 1px solid rgb(190, 190, 190);
            border-bottom: 1px solid rgb(190, 190, 190);

        }

        #table th,
        #table td {
            /* border: 1px solid rgb(190, 190, 190); */
            padding: 5px;
        }

        #table tr:nth-child(even) {
            /* background-color: #eee; */
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .page-header,
        .page-title {
            border: 0 !important;
            background: white;
        }

        .page-header {
            font-size: 1rem;
            font-weight: bolder;
            border-top: 1px solid rgb(190, 190, 190);
            border-bottom: 1px solid rgb(190, 190, 190);
        }

        .page-title {
            font-size: 0.9rem;
            margin-bottom: 25px !important;
        }

        .divider {
            background: white;
            border: 0 !important;
        }

        header,
        footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }

        header {
            top: 0px;
        }

        footer {
            bottom: 0px;
            font-size: 0.8rem;
        }

        .pagenum:before {
            content: counter(page);
        }

        .bold{
            font-weight: bolder;
        }

        .group-total{
            font-weight: bolder;
            border-top: 1px solid rgb(190, 190, 190);
        }

    </style>
</head>

<body>

    {{-- <header>header</header> --}}

    <footer>
        <table style="width: 100%; border-top:1px solid rgb(190, 190, 190);">
            <tbody>
                <tr>
                    <td class="text-left">{{ date('d-m-Y') }}</td>
                    <td class="text-end pagenum-container">Page <span class="pagenum"></span></td>
                </tr>
            </tbody>
        </table>
    </footer>

    <table id="table">
        <thead>
            <tr>
                <td colspan="7" class="page-header">{{ config('app.name', 'Laravel') }}</td>
            </tr>
            <tr>
                <td colspan="7" class="page-title">
                    <div>{{ $page_title }}</div>
                    <div>From {{ date('d-m-Y', strtotime(request('start'))) }} to
                        {{ date('d-m-Y', strtotime(request('end'))) }}</div>
                </td>
            </tr>

            <tr>
                <th rowspan="2">Account Ledger Name</th>
                <th colspan="2">Opening Amount</th>
                <th colspan="2">Transaction Amount</th>
                <th colspan="2">Closing Amount</th>
            </tr>
            <tr>
                <th>Debit</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Credit</th>
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
                    <td class="divider" colspan="7"></td>
                </tr>

                <tr>
                    <td class="text-left bold" colspan="7">{{ $group->name }}</td>
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
                            <td class="text-end">
                                {{ $account->opening_debit > $account->opening_credit ? number_format($account->opening_debit - $account->opening_credit, 3) : '-' }}
                            </td>
                            <td class="text-end">
                                {{ $account->opening_credit > $account->opening_debit ? number_format($account->opening_credit - $account->opening_debit, 3) : '-' }}
                            </td>
                            <td class="text-end">
                                {{ $account->transaction_debit ? ($account->transaction_debit == 0 ? '-' : number_format($account->transaction_debit, 3)) : '-' }}
                            </td>
                            <td class="text-end">
                                {{ $account->transaction_credit ? ($account->transaction_credit == 0 ? '-' : number_format($account->transaction_credit, 3)) : '-' }}
                            </td>
                            <td class="text-end">
                                {{ $account->opening_debit + $account->transaction_debit > $account->opening_credit + $account->transaction_credit ? number_format($account->opening_debit + $account->transaction_debit - $account->opening_credit - $account->transaction_credit, 3) : '-' }}
                            </td>
                            <td class="text-end">
                                {{ $account->opening_credit + $account->transaction_credit > $account->opening_debit + $account->transaction_debit ? number_format($account->opening_credit + $account->transaction_credit - $account->opening_debit - $account->transaction_debit, 3) : '-' }}
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
                <tr class="group-total">
                    <td class="text-end group-total">Group Total</td>
                    <td class="text-end group-total">{{ $group_opening_debit == 0 ? '-' : number_format($group_opening_debit, 3) }}</td>
                    <td class="text-end group-total">{{ $group_opening_credit == 0 ? '-' : number_format($group_opening_credit, 3) }}</td>
                    <td class="text-end group-total">{{ $group_transaction_debit == 0 ? '-' : number_format($group_transaction_debit, 3) }}</td>
                    <td class="text-end group-total">{{ $group_transaction_credit == 0 ? '-' : number_format($group_transaction_credit, 3) }}</td>
                    <td class="text-end group-total">{{ $group_closing_debit == 0 ? '-' : number_format($group_closing_debit, 3) }}</td>
                    <td class="text-end group-total">{{ $group_closing_credit == 0 ? '-' : number_format($group_closing_credit, 3) }}</td>
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
                <td class="divider" colspan="7"></td>
            </tr>

            <tr>
                <th class="text-end">Grand Total</th>
                <th class="text-end">
                    {{ $total_opening_debit == 0 ? '-' : number_format($total_opening_debit, 3) }}</th>
                <th class="text-end">
                    {{ $total_opening_credit == 0 ? '-' : number_format($total_opening_credit, 3) }}</th>
                <th class="text-end">
                    {{ $total_transaction_debit == 0 ? '-' : number_format($total_transaction_debit, 3) }}</th>
                <th class="text-end">
                    {{ $total_transaction_credit == 0 ? '-' : number_format($total_transaction_credit, 3) }}</th>
                <th class="text-end">
                    {{ $total_closing_debit == 0 ? '-' : number_format($total_closing_debit, 3) }}</th>
                <th class="text-end">
                    {{ $total_closing_credit == 0 ? '-' : number_format($total_closing_credit, 3) }}</th>
            </tr>
        </tbody>
    </table>
</body>

</html>
