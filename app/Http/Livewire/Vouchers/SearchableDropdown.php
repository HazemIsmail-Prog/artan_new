<?php

namespace App\Http\Livewire\Vouchers;

use Livewire\Component;
use Illuminate\Support\Str;


class SearchableDropdown extends Component
{
    public $data;
    public $name;
    public $original_data;
    public $search;
    public $selected = [];
    public $selected_list = [];
    public $select_all = false;
    public function render()
    {
        return view('livewire.vouchers.searchable-dropdown');
    }

    public function mount()
    {
        $this->original_data = $this->data;
    }

    public function updatedSearch()
    {
        if ($this->search != '') {
            $this->data = $this->original_data;
            $this->data = $this->data->filter(function ($list) {
                if (Str::contains(Str::lower($list->name), Str::lower($this->search))) {
                    return true;
                }
                return false;
            });
        } else {
            $this->data = $this->original_data;
        }
    }

    public function updatedSelected($key, $val)
    {
        if ($key) {
            $this->selected_list[] = $val;
        } else {
            
            $index = array_search($val, $this->selected_list);
            unset($this->selected_list[$index]);
        }
        if (count($this->selected_list) == count($this->original_data)) {
            $this->select_all = true;
        } else {
            $this->select_all = false;
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            foreach ($this->original_data->pluck('id') as $val) {
                $this->selected[$val] = true;
            }

            $this->selected_list = $this->original_data->pluck('id')->toArray() ;
        } else {
            foreach ($this->original_data->pluck('id') as $val) {
                $this->selected[$val] = false;
            }
            $this->selected_list = [];
        }
    }
    
    public function clear_filter()
    {
        $this->search = '';
        $this->updatedSearch();;
    }
}
