<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }} - {{ $voucher->voucher_no }}</title>
    <style>
        body{
            /* margin-top: 50px; */
            margin-bottom: 30px;
        }
        #table {
            font-family: Arial, Helvetica, sans-serif;
            /* font-family: 'dejavu sans', sans-serif; */
            border-collapse: collapse;
            width: 100%;
            font-size: 0.8rem;
        }

        #table th {
            background-color: #ddd;
        }

        #table th,
        #table td {
            border: 1px solid #eee;
            padding: 5px;
        }

        #table tr:nth-child(even) {
            background-color: #eee;
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
        }

        .page-title {
            font-size: 0.9rem;
            margin-bottom: 25px !important;
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
        <table style="width: 100%;">
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
                <td colspan="4" class="page-header">{{ config('app.name', 'Laravel') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="page-title">
                    <div>{{ $page_title }} No. : {{ $voucher->voucher_no }}</div>
                    <div>Date : {{ date('d-m-Y', strtotime($voucher->voucher_date)) }}</div>
                </td>
            </tr>
            <tr>
                <th class=" text-left">Account</th>
                <th class=" text-left">Narration</th>
                <th class=" text-end">Debit</th>
                <th class=" text-end">Credit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voucher->voucher_details as $row)
                <tr>
                    <td class=" text-left">{{ $row->account->name }}</td>
                    <td class=" text-left">{{ $row->narration }}</td>
                    <td class=" text-end">{{ $row->debit == 0 ? '' : number_format($row->debit, 3) }}</td>
                    <td class=" text-end">{{ $row->credit == 0 ? '' : number_format($row->credit, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class=" text-end" colspan="2">Total :</th>
                <th class=" text-end">{{ number_format($voucher->voucher_details->sum('debit'), 3) }}</th>
                <th class=" text-end">{{ number_format($voucher->voucher_details->sum('credit'), 3) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
