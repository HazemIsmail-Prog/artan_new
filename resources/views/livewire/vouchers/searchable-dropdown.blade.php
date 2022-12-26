<div>
    <select required class="d-none w-100" name="{{ $name }}[]" multiple>
        <option value="">---</option>
        @foreach ($selected_list as $row)
            <option value="{{ $row }}" selected = "selected">{{ $row }}</option>
        @endforeach
    </select>
    <div class="input-group mb-3">
        <div class="input-group-text">
            <input wire:model="select_all" class="form-check-input mt-0" type="checkbox">
        </div>
        <input wire:model="search" type="text" class="form-control shadow-none" placeholder="search...">
        @if ($search != '')
            <div wire:click="clear_filter" class="input-group-text" style="cursor: pointer">
                <svg style="width: 15px;height: 15px">
                    <use
                        xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-x') }}">
                    </use>
                </svg>
            </div>
        @endif
    </div>
    <div style="height: 150px; overflow-y:auto;">
        @foreach ($data as $index => $row)
            <div class="d-flex mb-1 p-1" style="border-radius: 5px; background-color:#ebedef;">
                <div class="input-group-text border-0">
                    <input wire:model="selected.{{ $row->id }}" type="checkbox" id="{{ $row->id }}">
                </div>
                <div class="w-100">
                    <label class="mt-1 mb-0 w-100" for="{{ $row->id }}">
                        {{ $row->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
