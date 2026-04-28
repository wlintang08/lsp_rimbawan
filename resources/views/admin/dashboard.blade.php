@extends('layouts.app')

@section('content')

<h2>Dashboard Admin</h2>

<!-- ===================== -->
<!-- STATISTIK -->
<!-- ===================== -->
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card bg-primary text-white p-3">
            <h5>Total Asesi</h5>
            <h3>{{ $totalAsesi }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white p-3">
            <h5>Total Pendaftaran</h5>
            <h3>{{ $totalPendaftaran }}</h3>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card bg-info text-white p-3">
            <h5>Lulus</h5>
            <h3>{{ $totalLulus }}</h3>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card bg-danger text-white p-3">
            <h5>Tidak Lulus</h5>
            <h3>{{ $totalTidakLulus }}</h3>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card bg-warning text-dark p-3">
            <h5>Pending</h5>
            <h3>{{ $totalPending }}</h3>
        </div>
    </div>

</div>

<!-- ===================== -->
<!-- CHART BAR -->
<!-- ===================== -->
<div class="card p-3 mb-4">
    <h5>Grafik Pendaftaran per Bulan</h5>
    <canvas id="chartBar"></canvas>
</div>

<!-- ===================== -->
<!-- CHART PIE -->
<!-- ===================== -->
<div class="card p-3 mb-4">
    <h5>Distribusi Status</h5>
    <canvas id="chartPie"></canvas>
</div>

<!-- ===================== -->
<!-- TOP SKEMA -->
<!-- ===================== -->
<div class="card p-3">
    <h5>Top Skema</h5>

    <table class="table table-bordered">
        <tr>
            <th>Skema</th>
            <th>Total</th>
        </tr>

        @foreach($topSkema as $t)
        <tr>
            <td>{{ $t->skema->nama_skema }}</td>
            <td>{{ $t->total }}</td>
        </tr>
        @endforeach

    </table>
</div>

<!-- ===================== -->
<!-- CHART JS -->
<!-- ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// =====================
// BAR CHART (PER BULAN)
// =====================
new Chart(document.getElementById('chartBar'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($chart->keys()) !!},
        datasets: [{
            label: 'Pendaftaran',
            data: {!! json_encode($chart->values()) !!}
        }]
    }
});

// =====================
// PIE CHART (STATUS)
// =====================
new Chart(document.getElementById('chartPie'), {
    type: 'pie',
    data: {
        labels: {!! json_encode($statusChart->pluck('status')) !!},
        datasets: [{
            data: {!! json_encode($statusChart->pluck('total')) !!}
        }]
    }
});
</script>

@endsection