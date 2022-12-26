@foreach ($accounts as $account)
    <tr>
        <td style="font-weight: bolder;" colspan="7">{{ $account->name }}</td>
    </tr>
    <tr>
        <th style="font-weight: bolder; text-align:center;">Date</th>
        <th style="font-weight: bolder; text-align:center;">Trn. No.</th>
        <th style="font-weight: bolder; text-align:center;">Type</th>
        <th style="font-weight: bolder; text-align:left;">Narration</th>
        <th style="font-weight: bolder; text-align:right;">Debit</th>
        <th style="font-weight: bolder; text-align:right;">Credit</th>
        <th style="font-weight: bolder; text-align:right;">Balance</th>
    </tr>
    {{ $opening_balance = $account->opening_debit - $account->opening_credit }}
    <tr>
        <th style="font-weight: bolder; text-align:right;" colspan="4">Opening Balance :</th>
        <th style="font-weight: bolder; text-align:right;">{{ $opening_balance > 0 ? abs($opening_balance) : 0 }}</th>
        <th style="font-weight: bolder; text-align:right;">{{ $opening_balance < 0 ? abs($opening_balance) : 0 }}</th>
        <th></th>
    </tr>
    {{ $debit_total = 0 }}
    {{ $credit_total = 0 }}
    @foreach ($account->voucher_details->sortBy('voucher.voucher_date') as $row)
        <tr>
            <td style="text-align: center;">{{ date('d-m-Y', strtotime($row->voucher->voucher_date)) }}</td>
            <td style="text-align: center;">{{ $row->voucher->voucher_no }}</td>
            <td style="text-align: center;">{{ strtoupper($row->voucher->voucher_type) }}</td>
            <td style="text-align: left;">{{ $row->narration }}</td>
            <td style="text-align: right">{{ $row->debit }}</td>
            <td style="text-align: right">{{ $row->credit }}</td>
            <td style="text-align: right">{{ $opening_balance += $row->debit - $row->credit }}</td>
        </tr>
        {{ $debit_total += $row->debit }}
        {{ $credit_total += $row->credit }}
    @endforeach
    <tr>
        <th style="font-weight: bolder; text-align:right" colspan="4">Total</th>
        <th style="font-weight: bolder; text-align:right">{{ $debit_total }}</th>
        <th style="font-weight: bolder; text-align:right">{{ $credit_total }}</th>
        <th></th>
    </tr>
@endforeach
