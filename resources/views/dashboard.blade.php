<x-layouts>
    @slot('title')
        Dashboard
    @endslot

    @section('content')
        <div class="container">
            <h3 id="datetime"></h3>

            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Pendapatan Hari Ini</div>
                        <div class="card-body">
                            <h3 class="card-title">Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Total Pendapatan Bulan Ini</div>
                        <div class="card-body">
                            <h3 class="card-title">Rp {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Total Pengunjung Hari Ini</div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $totalPengunjungHariIni }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="pendapatanPerMinggu"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="pendapatanPerBulan"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a class="btn btn-primary" href="/laporan">Laporan Harian</a>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-primary" href="/laporanBulanan">Laporan Bulanan</a>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-primary" href="/kasir">Kasir</a>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-primary" href="/menu">Menu</a>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctxPerMinggu = document.getElementById('pendapatanPerMinggu').getContext('2d');
                var pendapatanPerMinggu = new Chart(ctxPerMinggu, {
                    type: 'line',
                    data: {
                        labels: @json($pendapatanPerMinggu->pluck('week')),
                        datasets: [{
                            label: 'Pendapatan Per Minggu',
                            data: @json($pendapatanPerMinggu->pluck('total')),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Week'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Total Pendapatan (Rp)'
                                }
                            }
                        }
                    }
                });

                var ctxPerBulan = document.getElementById('pendapatanPerBulan').getContext('2d');
                var pendapatanPerBulan = new Chart(ctxPerBulan, {
                    type: 'line',
                    data: {
                        labels: @json($pendapatanPerBulan->pluck('month')),
                        datasets: [{
                            label: 'Pendapatan Per Bulan',
                            data: @json($pendapatanPerBulan->pluck('total')),
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1,
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Month'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Total Pendapatan (Rp)'
                                }
                            }
                        }
                    }
                });
            });

            function updateDateTime() {
                var now = new Date();
                var formattedTime = now.toLocaleString();
                document.getElementById("datetime").innerHTML = formattedTime;
            }


            updateDateTime();


            setInterval(updateDateTime, 1000);
        </script>
    @endsection

</x-layouts>
