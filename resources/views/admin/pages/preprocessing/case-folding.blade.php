@extends('admin.layouts.app', ['title' => 'Case Folding'])

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
            <h6 class="m-0 font-weight-bold text-primary">Case Folded Data</h6>
            <div class="text-right">
                <a href="{{ route('preprocessings.cleansing-index') }}" class="btn btn-primary"><i
                        class="fas fa-fw fa-solid fa-angle-left"></i></a>
                @if ($preprocessings->isNotEmpty())
                    @if ($preprocessings->contains('case_folded_text', null))
                        <a href="{{ route('preprocessings.case-folding') }}" class="btn btn-success"><i
                                class="fas fa-fw fa-solid fa-spinner"></i> Case Fold</a>
                    @endif
                @endif
                <a href="{{ route('preprocessings.tokenizing-index') }}" class="btn btn-primary"><i
                        class="fas fa-fw fa-solid fa-angle-right"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered custom-table" id="caseFolded-table" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cleaned</th>
                            <th>Case Folded</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Cleaned</th>
                            <th>Case Folded</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (count($preprocessings) > 0)
                            @foreach ($preprocessings as $index => $preprocessing)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $preprocessing->cleaned_text }}</td>
                                    <td>{{ $preprocessing->case_folded_text ?: 'Unprocessed' }}</td>
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
            $('#caseFolded-table').DataTable();
        });
    </script>
@endpush
