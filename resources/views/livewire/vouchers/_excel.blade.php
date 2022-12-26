<table>
    <thead>
        <tr>
            <th>Voucher</th>
            <th>Date</th>
            <th>Account</th>
            <th>Narration</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vouchers as $voucher)
            @foreach ($voucher->voucher_details as $row)
                <tr>
                    <td>{{ $voucher->voucher_no }}</td>
                    <td>{{ date('d-m-Y', strtotime($voucher->voucher_date)) }}</td>
                    <td>{{ $row->account->name }}</td>
                    <td>{{ ucwords(strtolower($row->narration)) }}</td>
                    <td>{{ $row->debit }}</td>
                    <td>{{ $row->credit }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
