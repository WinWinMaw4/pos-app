@extends('master')
@section('content')
    <div class="bg-white shadow" style="width: 600px;height:400px">
        <h3>Daily InCome</h3>
        <canvas id="myChart" class="w-100"></canvas>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let date = @json(collect($dailyVouchers)->pluck('date'));
        let total_price = @json(collect($dailyVouchers)->pluck('total_price'));
        let total_voucher = @json(collect($dailyVouchers)->pluck('total_voucher'));

        console.log(total_price);
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date,
                datasets: [{
                    label: 'Daily total price',
                    data: total_price,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
