<div>
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>{{ $card_header }}s</div>
            <div>
                <a class="btn btn-dark btn-sm" href="{{ route('vouchers.form',$voucher_type) }}">Add
                    {{ $card_header }}</a>
            </div>
        </div>
        <div class="card-body">
            @include('includes.alerts')
            <div class="row border-bottom pb-3 mb-3">
                <div class="col-md-6">
                    <input wire:model="search" autocomplete="off" autofocus type="text" id="voucher_no"
                        class="form-control mb-2 bg-light w-100" placeholder="Search ...">
                </div>
                <div class="col-md-6 text-end">
                    @if ($route_name == 'journal_vouchers')
                        <input type="file" wire:model="file">
                        <button wire:click="import" class="btn btn-dark btn-sm" title="Import from Excel file">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                        <button wire:click="template" class="btn btn-dark btn-sm"
                            title="Export to Excel">
                            <i class="fas fa-file-excel"></i> Template
                        </button>
                    @endif
                    <button wire:click="export" class="btn btn-dark btn-sm"
                        title="Export to Excel">
                        <i class="fas fa-file-excel"></i> Excel
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="card-header">
                            <th class="text-center align-middle">Voucher No.</th>
                            <th class="text-center align-middle">Date</th>
                            {{-- <th class="text-center align-middle">Created By</th> --}}
                            <th class="text-end align-middle">Total</th>
                            <th class="text-center align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td nowrap class="text-center align-middle" style="width: 50px;">{{ $voucher->voucher_no }}</td>
                                <td nowrap class="text-center align-middle" style="width: 100px;">
                                    {{ date('d-m-Y', strtotime($voucher->voucher_date)) }}</td>
                                {{-- <td class="text-center align-middle" style="width: 100px;">{{ $voucher->creator->name }}</td> --}}
                                <td class="text-end align-middle">
                                    <a class="btn btn-dark btn-sm" data-bs-toggle="collapse"
                                        href="#collapse{{ $voucher->id }}" role="button" aria-expanded="false"
                                        aria-controls="collapse{{ $voucher->id }}">
                                        {{ number_format($voucher->voucher_details->sum('debit'), 3) }}
                                    </a>
                                    <div class="collapse" id="collapse{{ $voucher->id }}">
                                        <table class=" table table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle text-left">Account</th>
                                                    <th class="align-middle text-left">Narration</th>
                                                    <th class="align-middle text-end">Debit</th>
                                                    <th class="align-middle text-end">Credit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($voucher->voucher_details as $row)
                                                    <tr>
                                                        <td nowrap class="align-middle text-left">{{ $row->account->name }}</td>
                                                        <td class="align-middle text-left">{{ ucwords(strtolower($row->narration)) }}</td>
                                                        <td nowrap class="text-end align-middle">{{ $row->debit == 0 ? '-' : number_format($row->debit, 3) }}</td>
                                                        <td nowrap class="text-end align-middle">{{ $row->credit == 0 ? '-' : number_format($row->credit, 3) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td nowrap class="text-center align-middle" style="width: 150px;">
                                    <button wire:click="show({{ $voucher->id }})"
                                        class="btn btn-outline-success btn-sm" title="Print" target="_blank">
                                        Print </button>
                                    <a href="{{ route('vouchers.form',[$voucher_type,$voucher->id]) }}"
                                        class="btn btn-outline-info btn-sm" title="Edit">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                            </use>
                                        </svg> </a>
                                    <a class="btn btn-outline-danger btn-sm"
                                        {{-- href="{{ route($route_name . '.destroy', $voucher->id) }}" --}}
                                        onclick="event.preventDefault();confirm('You\'r About to Delete This Voucher\nARE YOU SURE???') ? document.getElementById('delete-form-{{ $voucher->id }}').submit() : false;">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                                            </use>
                                        </svg>
                                    </a>
                                    <form action=""
                                    {{-- <form action="{{ route($route_name . '.destroy', $voucher->id) }}" --}}
                                        id="delete-form-{{ $voucher->id }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $vouchers->links() }} --}}
            </div>
        </div>
    </div>
</div>
