@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <canvas id="docChartStatusNcr" height="220" class="mt-6"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="docChartStatusOfi" height="220" class="mt-6"></canvas>
            </div>
        </div>
    </div>

    <script>
        fetch('{{ url('get/status-ncr') }}')
            .then(response => response.json())
            .then(data => {

                var name = data.map(x => x.name);
                var jumlah = data.map(x => x.jumlah);

                const ctxChartStatusNcr = document.getElementById('docChartStatusNcr').getContext('2d');
                const docChartStatusNcr = new Chart(ctxChartStatusNcr, {
                    type: 'doughnut',
                    data: {
                        labels: name,
                        datasets: [{
                            data: jumlah,
                            backgroundColor: [
                                // 'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                // 'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Chart Status Ncr'
                        }
                    }
                });
            });

        fetch('{{ url('get/status-ofi') }}')
            .then(response => response.json())
            .then(data => {

                var name = data.map(x => x.name);
                var jumlah = data.map(x => x.jumlah);

                const ctxChartStatusOfi = document.getElementById('docChartStatusOfi').getContext('2d');
                const docChartStatusOfi = new Chart(ctxChartStatusOfi, {
                    type: 'doughnut',
                    data: {
                        labels: name,
                        datasets: [{
                            data: jumlah,
                            backgroundColor: [
                                // 'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                // 'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Chart Status Ofi'
                        }
                    }
                });
            });
    </script>
@endsection
