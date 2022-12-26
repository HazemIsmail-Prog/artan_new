

    <table>

        <tbody>



            <div style="display: none">
                {{ $total_assets = 0 }}
                {{ $total_liabilities = 0 }}
                {{ $total_equity = 0 }}
            </div>

            <tr><th style="font-weight: bolder" colspan="5">Assets</th></tr>

            @foreach ($assets_groups as $group)
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
                            <td class="text-end">
                                {{ $account->total }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="3" style="text-align:left; font-weight: bolder;">Group Total</td>
                    <td class="group-total text-end" style="font-weight: bolder;">
                        {{ $group->childs->sum('total') }}
                    </td>
                </tr>
                <div style="display: none">
                    {{ $total_assets += $group->childs->sum('total') }}
                </div>
            @endforeach
            <tr>
                <th colspan="4" style="font-weight: bolder">Assets Total</th>
                <th style="font-weight: bolder">{{ $total_assets }}</th>
            </tr>





            <tr><th colspan="5" style="font-weight: bolder">Liabilities</th></tr>





            @foreach ($liabilities_groups as $group)
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
                            <td class="text-end">
                                {{ $account->total }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="3" style="font-weight: bolder;">Group Total</td>
                    <td class="group-total text-end" style="font-weight: bolder;">
                        {{ $group->childs->sum('total') }}
                    </td>
                </tr>
                <div style="display: none">
                    {{ $total_liabilities += $group->childs->sum('total') }}
                </div>
            @endforeach
            <tr>
                <th colspan="4" style="font-weight: bolder">Liabilities Total</th>
                <th style="font-weight: bolder">{{ $total_liabilities }}</th>
            </tr>





            <tr><th colspan="5" style="font-weight: bolder">Equity</th></tr>



            @foreach ($equity_group as $group)
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
                            <td>{{ $account->total }}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="3" style="font-weight: bolder">Group Total</td>
                    <td style="font-weight: bolder">
                        {{ $group->childs->sum('total') }}
                    </td>
                </tr>
                <div style="display: none">
                    {{ $total_equity += $group->childs->sum('total') }}
                </div>
            @endforeach
            <tr>
                <th colspan="4" style="font-weight: bolder">Equity Total</th>
                <th style="font-weight: bolder">{{ $total_equity }}</th>
            </tr>

            <tr>
                <td></td>
                <td colspan="4" style="font-weight: bolder">Profit - Loss</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td colspan="2">Net Profit</td>
                <td>{{ $profit }}</td>
            </tr>

            <tr>
                <td></td>
                <td colspan="3" style="font-weight: bolder">Group Total</td>
                <td style="font-weight: bolder">{{ $profit }}</td>
            </tr>

            <tr>
                <th colspan="4" style="font-weight: bolder">Net Account Group Total</th>
                <th style="font-weight: bolder">{{ $total_equity + $profit }}</th>
            </tr>

            <tr>
                <th colspan="4" style="font-weight: bolder">Net Total</th>
                <th style="font-weight: bolder">{{ $total_equity + $profit + $total_liabilities }}</th>
            </tr>

        </tbody>
    </table>

