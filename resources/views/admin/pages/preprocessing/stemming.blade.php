@extends('admin.layouts.app', ['title' => 'Stemming'])

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
            <h6 class="m-0 font-weight-bold text-primary">Stemmed Data</h6>
            <div class="text-right">
                <a href="{{ route('preprocessings.stopword-removal-index') }}" class="btn btn-primary"><i
                        class="fas fa-fw fa-solid fa-angle-left"></i></a>
                @if ($preprocessings->isNotEmpty())
                    @if ($preprocessings->contains('stemmed_text', null))
                        <a href="{{ route('preprocessings.stemming') }}" class="btn btn-success"><i
                                class="fas fa-fw fa-solid fa-spinner"></i> Stemming</a>
                    @else
                        <a href="{{ route('tfidf.index') }}" class="btn btn-success">TF-IDF <i
                                class="fas fa-fw fa-solid fa-angle-right"></i></a>
                    @endif
                @endif
            </div>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered custom-table" id="stemmed-table" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Stopword Removed</th>
                            <th>Stemmed</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Stopword Removed</th>
                            <th>Stemmed</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (count($preprocessings) > 0)
                            @foreach ($preprocessings as $index => $preprocessing)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $preprocessing->stopwords_removed_text }}</td>
                                    <td>{{ $preprocessing->stemmed_text ?: 'Unprocessed' }}</td>
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
            $('#stemmed-table').DataTable();
        });
    </script>
@endpush
