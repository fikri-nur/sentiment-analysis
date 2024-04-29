@extends('admin.layouts.app', ['title' => 'Test Data'])

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
            <h6 class="m-0 font-weight-bold text-primary">Test Data</h6>
            <div class="text-right">
                @if ($testDatas->isEmpty() && $stemmedTextEmpty == false)
                    <a href="{{ route('random-sampling') }}" class="btn btn-success"><i
                            class="fas fa-fw fa-solid fa-spinner"></i> Random Sampling</a>
                @endif
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered custom-table" id="test-data-table" width="100%"
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
                        @if ($testDatas->isNotEmpty())
                            @foreach ($testDatas as $index => $testData)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $testData->preprocessing->stemmed_text }}</td>
                                    <td>{{ $testData->label ?: 'Unprocessed' }}</td>
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
            $('#test-data-table').DataTable();
        });
    </script>
@endpush
