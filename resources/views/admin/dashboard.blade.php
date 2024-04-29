@extends('admin.layouts.app', ['title' => 'Dashboard Admin'])
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @foreach ($countEverySentiment as $key => $value)
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                @if ($key == 'positif')
                    @php
                        $color = 'primary';
                    @endphp
                @elseif ($key == 'negatif')
                    @php
                        $color = 'danger';
                    @endphp
                @else
                    @php
                        $color = 'warning';
                    @endphp
                @endif
                <div class="card border-left-{{ $color }} shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">
                                    {{ $key }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $value }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-comment fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Bar Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Sentimen</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @empty($countEverySentiment)
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data yang tersedia.
                        </div>
                    @else
                        <div class="chart-bar">
                            <div class="m-0 font-weight-bold text-secondary">Total Data: <span id="totalData"></span></div>
                            <canvas id="myBarChart"></canvas>
                            <div id="chartData" data-sentiment="{{ json_encode($countEverySentiment) }}"></div>
                        </div>
                    @endempty

                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Word Cloud</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @empty($countEverySentiment)
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data yang tersedia.
                        </div>
                    @else
                        <div class="">
                            <img src="{{ asset('assets/img/wordcloud-dummy.jpg') }}" alt="Word Cloud" class="img-fluid">
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/chart/dashboard-chartbar.js') }}"></script>
@endpush
