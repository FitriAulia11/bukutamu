@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">📊 Statistik Tamu per Bulan ({{ now()->year }})</h4>
            <div class="p-3">
                <canvas id="tamuChart" style="max-height: 500px; height: 400px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('tamuChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!}, // Contoh: ['Jan', 'Feb', 'Mar', ...]
        datasets: [{
            label: 'Jumlah Tamu',
            data: {!! json_encode($data) !!}, // Contoh: [10, 25, 15, ...]
            borderColor: '#3498db',
            backgroundColor: 'rgba(52, 152, 219, 0.2)',
            pointBackgroundColor: '#3498db',
            fill: true,
            tension: 0.4,
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                },
                title: {
                    display: true,
                    text: 'Jumlah Tamu'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Bulan'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Grafik Jumlah Tamu per Bulan',
                font: {
                    size: 18
                }
            },
            tooltip: {
                mode: 'index',
                intersect: false
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    color: '#333'
                }
            }
        }
    }
});
</script>
@endsection
