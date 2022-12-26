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

        .group-total{
            border-top: 1px solid rgb(190, 190, 190) !important;
            border-bottom: 1px solid rgb(190, 190, 190) !important;
            font-weight: bolder;
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
                <td colspan="5" class="page-header">{{ config('app.name', 'Laravel') }}</td>
            </tr>
            <tr>
                <td colspan="5" class="page-title">
                    <div>{{ $page_title }}</div>
                    <div>From {{ date('d-m-Y', strtotime(request('start'))) }} to
                        {{ date('d-m-Y', strtotime(request('end'))) }}</div>
                </td>
            </tr>
            </tr>
        </thead>

        <tbody>
            <div style="display: none">
                {{ $total_income = 0 }}
                {{ $total_expenses = 0 }}
            </div>
    
            <tr>
                <th colspan="5" class="text-left">Income</th>
            </tr>
            @foreach ($income_groups as $group)
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
                            <td class="text-end">{{ number_format($account->total, 3) }}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="4" class="text-end group-total">Group Total</td>
                    <td class="text-end group-total">{{ number_format($group->childs->sum('total'), 3) }}</td>
                </tr>
                <div style="display: none">
                    {{ $total_income += $group->childs->sum('total') }}
                </div>
            @endforeach
            <tr>
                <th colspan="4" class="text-end">Income Total</th>
                <th class="text-end">{{ number_format($total_income, 3) }}</th>
            </tr>

            <tr><td></td></tr>
    
    
            <tr>
                <th colspan="5" class="text-left">Expenses</th>
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
                            <td class="text-end">{{ number_format($account->total, 3) }}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="4" class="text-end group-total">Group Total</td>
                    <td class="text-end group-total">{{ number_format($group->childs->sum('total'), 3) }}</td>
                </tr>
                <div style="display: none">
                    {{ $total_expenses += $group->childs->sum('total') }}
                </div>
            @endforeach
            <tr>
                <th colspan="4" class="text-end">Expenses Total</th>
                <th class="text-end">{{ number_format($total_expenses, 3) }}</th>
            </tr>

            <tr><td></td></tr>
    
            <tr>
                <th colspan="4" class="text-end">Net Profit for the Year</th>
                <th class="text-end">{{ number_format($total_income - $total_expenses, 3) }}</th>
            </tr>
    
        </tbody>





    </table>
</body>

</html>
