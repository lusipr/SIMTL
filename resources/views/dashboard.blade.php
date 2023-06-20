@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            {{-- <div class="col-lg-4 ">
                <canvas id="docChartStatusNc" height="220" class="mt-6"></canvas>
            </div> --}}
            <div class="col-lg-4 offset-lg-2">
                <canvas id="docChartStatusNcr" height="220" class="mt-6"></canvas>
            </div>
            <div class="col-lg-4">
                <canvas id="docChartStatusOfi" height="220" class="mt-6"></canvas>
            </div>
        </div>
    </div>

    <script>
        // fetch('{{ url('get/status-nc') }}')
        //     .then(response => response.json())
        //     .then(data => {

        //         // var name = data.map(x => x.name);
        //         // var jumlah = data.map(x => x.jumlah);

        //         const ctxChartStatusNc = document.getElementById('docChartStatusNc').getContext('2d');
        //         const docChartStatusNc = new Chart(ctxChartStatusNc, {
        //             type: 'doughnut',
        //             data: {
        //                 labels: ['Sudah Ditindaklanjuti', 'Belum Ditindaklanjuti', 'Tindak Lanjut Belum Sesuai'],
        //                 datasets: [{
        //                     data: [data[0].jumlah_sudah, data[0].jumlah_belum, data[0].jumlah_tidak],
        //                     backgroundColor: [
        //                         'rgba(46, 204, 113, 1)',
        //                         'rgba(241, 196, 15, 1)',
        //                         'rgba(231, 76, 60, 1)',
        //                     ]
        //                 }]
        //             },
        //             plugins: [ChartDataLabels],
        //             options: {
        //                 plugins: {
        //                     responsive: true,
        //                     legend: {
        //                         position: 'top',
        //                     },
        //                     title: {
        //                         display: true,
        //                         text: 'Chart Status Nc'
        //                     },
        //                     datalabels: {
        //                         color: '#fff'
        //                     }
        //                 }
        //             }
        //         });
        //     });

        fetch('{{ url('get/status-ncr') }}')
            .then(response => response.json())
            .then(data => {

                // var name = data.map(x => x.name);
                // var jumlah = data.map(x => x.jumlah);

                const ctxChartStatusNcr = document.getElementById('docChartStatusNcr').getContext('2d');
                const docChartStatusNcr = new Chart(ctxChartStatusNcr, {
                    type: 'doughnut',
                    data: {
                        labels: ['Sudah Ditindaklanjuti', 'Belum Ditindaklanjuti',
                            'Tindak Lanjut Belum Sesuai'],
                        datasets: [{
                            data: [data[0].jumlah_sudah, data[0].jumlah_belum, data[0].jumlah_tidak],
                            backgroundColor: [
                                'rgba(46, 204, 113, 1)',
                                'rgba(241, 196, 15, 1)',
                                'rgba(231, 76, 60, 1)',
                            ]
                        }]
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        plugins: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Chart Status Ncr'
                            },
                            datalabels: {
                                color: '#fff'
                            }
                        }
                    }
                });
            });

        fetch('{{ url('get/status-ofi') }}')
            .then(response => response.json())
            .then(data => {

                // var name = data.map(x => x.name);
                // var jumlah = data.map(x => x.jumlah);

                const ctxChartStatusOfi = document.getElementById('docChartStatusOfi').getContext('2d');
                const docChartStatusOfi = new Chart(ctxChartStatusOfi, {
                    type: 'doughnut',
                    data: {
                        labels: ['Sudah Ditindaklanjuti', 'Belum Ditindaklanjuti',
                            'Tindak Lanjut Belum Sesuai'],
                        datasets: [{
                            data: [data[0].jumlah_sudah, data[0].jumlah_belum, data[0].jumlah_tidak],
                            backgroundColor: [
                                'rgba(46, 204, 113, 1)',
                                'rgba(241, 196, 15, 1)',
                                'rgba(231, 76, 60, 1)',
                            ]
                        }]
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        plugins: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Chart Status Ofi'
                            },
                            datalabels: {
                                color: '#fff'
                            }
                        }
                    }
                });
            });
    </script>
@endsection
