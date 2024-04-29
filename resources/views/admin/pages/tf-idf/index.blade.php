@extends('admin.layouts.app', ['title' => 'TF-IDF'])

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
            <h6 class="m-0 font-weight-bold text-primary">TF-IDF</h6>
            <div class="text-right">
                @if ($tfidfs->isEmpty() && $stemmedTextEmpty == false)
                    <a href="{{ route('tfidf.calculate') }}" class="btn btn-success"><i
                            class="fas fa-fw fa-solid fa-spinner"></i> Hitung TF-IDF</a>
                @endif
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered custom-table" id="tf-idf-table" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Data</th>
                            <th>Kata</th>
                            <th>Nilai TF-IDF</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>ID Data</th>
                            <th>Kata</th>
                            <th>Nilai TF-IDF</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($tfidfs->isNotEmpty())
                            @foreach ($tfidfs as $index => $tfidf)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tfidf->preprocessing_id }}</td>
                                    <td>{{ $tfidf->word }}</td>
                                    <td>{{ $tfidf->tf_idf_score }}</td>
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
            $('#tf-idf-table').DataTable();
        });
    </script>
@endpush
