




{{-- @section('links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection --}}


<div class="card">
    <div class="bg-light border-primary border" wire:loading
        style="position: fixed;top: 70px;right: 10px;padding: 10px 20px;border-radius: 10px;z-index: 1000;">
        <h6 class="m-0 font-weight-bold text-primary">
            <div class="spinner-border small"></div> Loading ...
        </h6>
    </div>
    <!-- Card Header - Dropdown -->
    <div class="card-header d-flex justify-content-between">
        <div>{{ $action == 'create' ? 'Add ' : 'Edit ' }} {{ $card_header }}</div>
        @if ($voucher_type == 'jv' && $action == 'create')
            <button wire:click="generate_opening_voucher" class="btn btn-sm btn-dark">Generate Opening Voucher</button>
        @endif
    </div>

    <!-- Card Body -->
    <div class="card-body">
        @include('includes.alerts')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input wire:model="date" type="date" id="date" class="form-control form-control-sm">
                </div>
            </div>
            @if ($action == 'create')
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="copy">Copy</label>
                        <div class="input-group">
                            <input wire:model="copy_from" type="number" id="copy" class="form-control form-control-sm"
                                placeholder="{{ $placeholder }}">
                            <button wire:click="copy_voucher" class="btn btn-facebook btn-sm">Copy</button>
                        </div>
                        @if ($no_voucher_message)
                            <span class="text-danger">Voucher No. {{ $copy_from }} not found</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless">
                        <thead>
                            <tr class=" bg-light">
                                <th class="text-center">Account</th>
                                <th class="text-center">Narration</th>
                                <th class="text-center">Debit</th>
                                <th class="text-center">Credit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>
                                        <select wire:model="items.{{ $index }}.account_id"
                                            data-index="{{ $index }}"
                                            name="items[{{ $index }}][account_id]"
                                            class="form-control form-control-sm custom-select select2 bg-transparent {{ $errors->has('items.' . $index . '.account_id') ? 'is-invalid' : '' }}">
                                            <option disabled value="">---</option>
                                            @switch($voucher_type)
                                                @case('jv')
                                                    @foreach ($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->name }}
                                                            ({{ $account->balance }})</option>
                                                    @endforeach
                                                @break
                                                @case('bp')
                                                    @if ($index == 0)
                                                        @foreach ($accounts->where('usage', 'bank') as $account)
                                                            <option value="{{ $account->id }}">
                                                                {{ $account->name }} ({{ $account->balance }})
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($accounts->where('usage', '!=', 'bank') as $account)
                                                            <option value="{{ $account->id }}">
                                                                {{ $account->name }} ({{ $account->balance }})
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @break
                                                @case('br')
                                                    @if ($index == 0)
                                                        @foreach ($accounts->where('usage', 'bank') as $account)
                                                            <option value="{{ $account->id }}">
                                                                {{ $account->name }} ({{ $account->balance }})
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($accounts->where('usage', '!=', 'bank') as $account)
                                                            <option value="{{ $account->id }}">
                                                                {{ $account->name }} ({{ $account->balance }})
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @break
                                            @endswitch
                                    </select>
                                    @error('items.' . $index . '.account_id')<span
                                        class="small text-danger">{{ $message }}</span>@enderror
                                </td>
                                <td>
                                    <textarea wire:model.lazy="items.{{ $index }}.narration"
                                        id="items_{{ $index }}_narration" style="min-width: 350px;"
                                        class="form-control form-control-sm bg-transparent"
                                        name="items[{{ $index }}][narration]" rows="1"></textarea>
                                    @if ($errors->has('items.' . $index . '.narration'))
                                        <span
                                            class="text-danger">{{ $errors->first('items.' . $index . '.narration') }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($voucher_type == 'jv' || ($voucher_type == 'bp' && $index > 0) || ($voucher_type == 'br' && $index == 0) || ($voucher_type == 'cp' && $index > 0) || ($voucher_type == 'cr' && $index == 0))
                                        <input style="min-width: 150px;"
                                            wire:model="items.{{ $index }}.debit" type="number" step="0.001"
                                            min="0" id="items_{{ $index }}_debit"
                                            class="text-center form-control form-control-sm bg-transparent {{ $errors->has('items.' . $index . '.debit') ? 'is-invalid' : '' }}"
                                            name="items[{{ $index }}][debit]">

                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($voucher_type == 'jv' || ($voucher_type == 'bp' && $index == 0) || ($voucher_type == 'br' && $index > 0) || ($voucher_type == 'cp' && $index == 0) || ($voucher_type == 'cr' && $index > 0))
                                        <input style="min-width: 150px;"
                                            wire:model="items.{{ $index }}.credit" type="number"
                                            step="0.001" min="0" id="items_{{ $index }}_credit"
                                            class="text-center form-control form-control-sm bg-transparent {{ $errors->has('items.' . $index . '.credit') ? 'is-invalid' : '' }}"
                                            name="items[{{ $index }}][credit]">
                                    @endif
                                </td>
                                <td class="text-center" nowrap>
                                    @if ($voucher_type == 'jv')
                                        <button wire:click="duplicate_row({{ $index }})"
                                            class="text-center btn btn-sm text-success">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-copy') }}">
                                            </use>
                                        </svg>
                                        </button>
                                    @elseif ($index > 0)
                                        <button wire:click="duplicate_row({{ $index }})"
                                            class="text-center btn btn-sm text-success">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-copy') }}">
                                            </use>
                                        </svg>
                                        </button>
                                    @endif
                                    <button wire:click="delete_row({{ $index }})"
                                        class="text-center btn btn-sm text-danger {{ $index < 2 ? 'd-none' : '' }}">
                                        <svg style="width: 15px;height: 15px">
                                            <use
                                                xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                                            </use>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-center" colspan="5">
                                <button wire:click="add_row" class="btn btn-sm text-success">Add</button>
                                <input wire:model="rows_number"
                                    style="width: 50px;background: transparent;text-align: center;border: 0"
                                    type="number" step="1" min="1" value="1">
                                Row(s)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">Total : </td>
                            <td class="text-center">{{ number_format($total_debit, 3) }}</td>
                            <td class="text-center">{{ number_format($total_credit, 3) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">Difference : </td>
                            <td colspan="2" class="text-center {{ $total_difference == 0 ? 'text-success' : 'text-danger' }}">
                                <div>{{ number_format($total_difference, 3) }}</div>
                                @if ($errors->has('total_difference'))
                                    <span class="text-danger">{{ $errors->first('total_difference') }}</span>
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card-footer text-center">
    <button wire:click="save_voucher" class="btn btn-facebook">Save</button>
    <a href="{{ route('vouchers.index',$voucher_type) }}" class="btn text-danger">Back</a>
</div>
</div>


{{-- @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    rows_movments();
    document.addEventListener('livewire:load', function() {
        prepare_select2_dropdown();
        rows_movments();
    })
    window.addEventListener('add_row', event => {
        prepare_select2_dropdown();
        rows_movments();
    })

    function rows_movments() {
        $(".form-control").on('keydown', function(e) {
            // if (e.key == "ArrowRight") {
            //     $(this).parent().next().find('.form-control').focus().select();
            // }
            // if (e.key == "ArrowLeft") {
            //     $(this).parent().prev().find('.form-control').focus().select();
            // }
            if (e.key == "ArrowDown") {
                index = parseInt($(this).attr("id").split("_")[1]) + 1;
                field = $(this).attr("id").split("_")[2];
                string = "#items_" + index + "_" + field;
                $(string).focus().select();
                return false;
            }
            if (e.key == "ArrowUp") {
                index = parseInt($(this).attr("id").split("_")[1]) - 1;
                field = $(this).attr("id").split("_")[2];
                string = "#items_" + index + "_" + field;
                $(string).focus().select();
                return false;
            }
        })
    }

    function prepare_select2_dropdown() {
        $('.select2').select2({
            // theme: "classic",
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $('.select2').on('change', function(e) {
            var data = $(this).val();
            var index = $(this).data('index');
            @this.set('items.' + index + '.account_id', data);
        });
    }
</script> --}}
{{-- @endsection --}}
