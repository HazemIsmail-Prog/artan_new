<tr>
    <th>account_id</th>
    <th>account_name</th>
    <th>narration</th>
    <th>debit</th>
    <th>credit</th>
</tr>
@foreach ($accounts as $account)
    <tr>
        <td>{{ $account->id }}</td>
        <td>{{ $account->name }}</td>
        <td></td>
        <td>0</td>
        <td>0</td>
    </tr>
@endforeach
