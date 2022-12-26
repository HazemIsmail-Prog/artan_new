@foreach ($accounts as $account)
    <table>
        <thead>
            <tr>
                <td style="font-weight: bolder;" colspan="6">{{ $account->name }}</td>
            </tr>
            <tr>
                <th style="font-weight: bolder; text-align:center;">Date</th>
                <th style="font-weight: bolder; text-align:center;">Trn. No.</th>
                <th style="font-weight: bolder; text-align:center;">Type</th>
                <th style="font-weight: bolder; text-align:left;">Narration</th>
                <th style="font-weight: bolder; text-align:right;">Debit</th>
                <th style="font-weight: bolder; text-align:right;">Credit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($account->voucher_details->sortBy('voucher.voucher_date') as $row)
                <tr>
                    <td style="text-align: center;">{{ date('d-m-Y', strtotime($row->voucher->voucher_date)) }}</td>
                    <td style="text-align: center;">{{ $row->voucher->voucher_no }}</td>
                    <td style="text-align: center;">{{ strtoupper($row->voucher->voucher_type) }}</td>
                    <td style="text-align: left;">{{ $row->narration }}</td>
                    <td style="text-align: right">{{ $row->debit }}</td>
                    <td style="text-align: right">{{ $row->credit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
