<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 0.8rem;
        }
    
        .table th {
            background-color: #ddd;
        }
    
        .table th,
        .table td {
            border: 1px solid rgb(190, 190, 190);
            padding: 5px;
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
    </style>
    <title>Account Statement</title>
</head>
<body>
    @foreach ($accounts as $account)
        <table class="table" style="{{ $loop->last ? '' : 'page-break-after:always' }};">
            <thead>
                <tr>
                    <th class="text-left" colspan="7">
                        {{ $account->name }}
                    </th>
                </tr>
                <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">Trn. No.</th>
                    <th class="text-center">Type</th>
                    <th class="text-left">Narration</th>
                    <th class="text-end">Debit</th>
                    <th class="text-end">Credit</th>
                    <th class="text-end">Balance</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-end">Opening Balance :</th>
                    {{ $opening_balance = $account->opening_debit - $account->opening_credit }}
                    <th class="text-end">
                        {{ $opening_balance > 0 ? number_format(abs($opening_balance), 3) : '-' }}
                    </th>
                    <th class="text-end">
                        {{ $opening_balance < 0 ? number_format(abs($opening_balance), 3) : '-' }}
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    
                {{ $debit_total = 0 }}
                {{ $credit_total = 0 }}
                @foreach ($account->voucher_details->sortBy('voucher.voucher_date') as $row)
                    <tr>
                        <td nowrap class="text-center">{{ date('d-m-Y', strtotime($row->voucher->voucher_date)) }}
                        </td>
                        <td class="text-center">{{ $row->voucher->voucher_no }}</td>
                        <td class="text-center">{{ strtoupper($row->voucher->voucher_type) }}</td>
                        <td class="text-left">{{ Str::limit($row->narration, 45, '...') }}</td>
                        <td class="text-end">{{ $row->debit == 0 ? '-' : number_format($row->debit, 3) }}</td>
                        <td class="text-end">{{ $row->credit == 0 ? '-' : number_format($row->credit, 3) }}</td>
                        {{ $balance = $opening_balance += $row->debit - $row->credit }}
                        {{ $status = $balance == 0 ? '' : ($balance > 0 ? 'DR' : 'CR') }}
                        <td nowrap class="text-end"> {{ $balance == 0 ? '-' : number_format(abs($balance), 3) }} <span
                                style="font-size: 0.5rem;">{{ $status }}</span></td>
                    </tr>
                    {{ $debit_total += $row->debit }}
                    {{ $credit_total += $row->credit }}
                @endforeach
                <tr>
                    <th class="text-end" colspan="4">Total</th>
                    <th class="text-end">{{ $debit_total == 0 ? '-' : number_format($debit_total, 3) }}</th>
                    <th class="text-end">{{ $credit_total == 0 ? '-' : number_format($credit_total, 3) }}</th>
                    <th></th>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>



