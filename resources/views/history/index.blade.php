@extends('layout.main')

@section('container')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Riwayat Diagnosa Hama</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="data-tab" data-bs-toggle="tab" href="#data" role="tab"
                                aria-controls="data" aria-selected="false">Data</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="graph-tab" data-bs-toggle="tab" href="#graph" role="tab"
                                aria-controls="graph" aria-selected="true">Graph</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show p-3" id="data" role="tabpanel"
                            aria-labelledby="data-tab">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Hama</th>
                                            <th>Hasil Diagnosa</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($histores as $history)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $history->name }}</td>
                                                <td>{{ $history->hama->name }}</td>
                                                <td class="text-end">{{ $history->value }} %</td>
                                                <td>{{ date_format($history->created_at, 'd/m/Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">History Case Not Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade p-3" id="graph" role="tabpanel" aria-labelledby="graph-tab">
                            <canvas id="bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('mazer/vendors/chartjs/Chart.min.js') }}"></script>
    <script>
        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            info: '#41B1F9',
            blue: '#3245D1',
            purple: 'rgb(153, 102, 255)',
            grey: '#EBEFF6'
        };

        var ctxBar = document.getElementById("bar").getContext("2d");
        var myBar = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($hypotesis as $hypo)
                        "{{ $hypo->name }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Hypothesis',
                    backgroundColor: chartColors.blue,
                    data: [
                        @foreach ($hypotesis as $hypo)
                            {{ $history->where('hama_id', $hypo->id)->count() }},
                        @endforeach
                    ]
                }]
            },
            options: {
                responsive: true,
                barRoundness: 1,
                title: {
                    display: true,
                    text: "Hypotheses Graph"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 40 + 20,
                            padding: 10,
                        },
                        gridLines: {
                            drawBorder: false,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }]
                }
            }
        });
    </script>
@endsection
