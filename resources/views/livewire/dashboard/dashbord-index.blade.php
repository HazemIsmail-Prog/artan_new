<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="card-header">Income</div>
                                <div class="card-body">
                                    <select wire:model="year" class="form-control form-control-sm text-center">
                                        @foreach ($yearList as $year)
                                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>
                        @foreach ($widgets as $key => $value)
                            <div class="col-md-6 mb-2">
                                <div class="card">
                                    <div class="card-header">{{ $key }}</div>
                                    <div class="card-body">{{ number_format($value, 3) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            loadChart(@js($chartData));
        });

        document.addEventListener('loadChart', event => {
            loadChart(event.detail);
        });

        function loadChart(data) {
            months = [];
            totals = [];
            data.forEach((row) => months.push(row.month));
            data.forEach((row) => totals.push(row.total));
            var ctxB = document.getElementById("barChart").getContext('2d');
            var myBarChart = new Chart(ctxB, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Income',
                        data: totals,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    </script>
@endpush
