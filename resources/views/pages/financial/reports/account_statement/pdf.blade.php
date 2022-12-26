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
            background-color: #ddd;
        }

        #table th,
        #table td {
            border: 1px solid rgb(190, 190, 190);
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
        </thead>
        <tbody>
            @foreach ($accounts as $account)
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
                        {{ $status = $balance == 0 ? '' : ( $balance > 0 ? 'DR' : 'CR') }}
                        <td nowrap class="text-end"> {{ number_format(abs($balance), 3) }} <span style="font-size: 0.5rem;">{{ $status }}</span></td>
                    </tr>
                    {{ $debit_total += $row->debit }}
                    {{ $credit_total += $row->credit }}
                @endforeach
                <tr>
                    <th class="text-end" colspan="4">Total</th>
                    <th class="text-end">{{ number_format($debit_total , 3) }}</th>
                    <th class="text-end">{{ number_format($credit_total , 3) }}</th>
                    <th></th>
                </tr>
                <tr style="page-break-after: always;"><td style="padding:0;" colspan="7"></td></tr>
            @endforeach
        </tbody>
    </table>

































</body>

</html>
