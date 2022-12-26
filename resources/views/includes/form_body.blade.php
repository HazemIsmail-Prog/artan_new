<div class="row border-bottom pb-3 mb-3">
    <div class="col-md-12">
        <div class="form-group text-left">
            <button type="submit" class="btn btn-dark btn-sm" name="action" value="excel">
                <i class="fas fa-file-excel"></i> Excel
            </button>
            <button type="submit" class="btn btn-dark btn-sm" name="action" value="pdf">
                <i class="fas fa-file-export"></i> PDF
            </button>
        </div>
    </div>
</div>
<div class="row pt-3">
    <div class="col-md-3">
        <div class="form-group">
        <label for="start">Start Date</label>
        <input required autocomplete="off" type="date" id="start" class="form-control bg-light w-100"
            name="start" value="{{ old('start',Carbon\Carbon::today()->subMonth(1)->format('Y-m-d'),) }}">
        </div>
        <div class="form-group">
            <label for="end">End Date</label>
            <input required autocomplete="off" type="date" id="end" class="form-control bg-light w-100" name="end"
                value="{{ old('end', Carbon\Carbon::today()->format('Y-m-d')) }}">
        </div>
    </div>
    <div class="col-md-5">
        @stack('extra_fields')
    </div>
</div>
