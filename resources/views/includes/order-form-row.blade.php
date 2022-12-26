<div class="card mb-2">
    <div class="card-header text-end">
        <button wire:click="duplicate_row({{$index}})" class="btn btn-sm text-success">
            <svg style="width: 20px;height:20px">
                <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-copy') }}"></use>
            </svg>
        </button>
        @if(count($rows) > 1)
            <button wire:click="delete_row({{$index}})" class="btn btn-sm text-danger">
                <svg style="width: 20px;height:20px">
                    <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-trash') }}"></use>
                </svg>
            </button>
        @endif
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="d-flex gap-2">
                    <select wire:model="rows.{{ $index }}.part_id" class="form-control form-control-sm">
                        <option selected disabled value="">-- Part --</option>
                        @foreach ($row['parts'] as $part)
                            <option value="{{ $part['id'] }}">{{ $part['name'] }}</option>
                        @endforeach
                    </select>
                    
                    <select wire:model="rows.{{ $index }}.material_id" class="form-control form-control-sm">
                        <option selected value="">-- Material --</option>
                        @foreach ($row['materials'] as $material)
                        <option value="{{ $material['id'] }}">{{ $material['name'] }}</option>
                        @endforeach
                    </select>
                    <input wire:model="rows.{{ $index }}.length" class=" form-control form-control-sm" type="text" placeholder="Length">
                    <input wire:model="rows.{{ $index }}.width" class=" form-control form-control-sm" type="text" placeholder="Width">
                    <input wire:model="rows.{{ $index }}.thickness" class=" form-control form-control-sm" type="text" placeholder="Thickness">
                    <input wire:model="rows.{{ $index }}.qty" class=" form-control form-control-sm" type="text" placeholder="Qty">
                </div>
            </div>
            @if (!$rows[$index]['routings'] == [])
                <div class="col-12 mt-2">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($row['routings'] as $routing)
                            <input wire:model="rows.{{ $index }}.routing_ids" type="checkbox" class="btn-check" id="{{ $index.$routing['id'] }}" value="{{ $routing['id'] }}" autocomplete="off">
                            <label class="btn btn-outline-dark" for="{{ $index.$routing['id'] }}">{{ $routing['name'] }}</label>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (!$rows[$index]['routing_ids'] == [])
                <div class="col-12 mt-2">
                    <div>Material Cost : {{ $rows[$index]['material_cost'] }}</div>
                    <div>Machining Cost : {{ $rows[$index]['machining_cost'] }}</div>
                </div>
            @endif
        </div>
    </div>
</div>