@extends('admin.layouts.app', ['title' => 'Train Data'])

@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .custom-table {
            color: #333;
            /* Warna font */
            border-color: #ddd;
            /* Warna garis */
        }

        .custom-table td {
            max-width: 200px;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold text-primary">Train Data</h6>
            <div class="text-right">
                @if ($trainDatas->isEmpty() && $stemmedTextEmpty == false)
                    <a href="{{ route('random-sampling') }}" class="btn btn-success"><i
                            class="fas fa-fw fa-solid fa-spinner"></i> Random Sampling</a>
                @endif
            </div>

        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('data.train') ? 'active' : '' }}" href="{{ route('data.train') }}">70%</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('data.train-80') ? 'active' : '' }}" href="{{ route('data.train-80') }}">80&</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('data.train-90') ? 'active' : '' }}" href="{{ route('data.train-90') }}">90%</a>
                </li>
            </ul>
            <div class="table-responsive">
                <table class="table table-striped table-bordered custom-table" id="train-data-table" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tweet</th>
                            <th>Label</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tweet</th>
                            <th>Label</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($trainDatas->isNotEmpty())
                            @foreach ($trainDatas as $index => $trainData)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $trainData->preprocessing->stemmed_text }}</td>
                                    <td>{{ $trainData->preprocessing->dataset->sentiment }}</td>
                                </tr>
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#train-data-table').DataTable();
        });
    </script>
@endpush
