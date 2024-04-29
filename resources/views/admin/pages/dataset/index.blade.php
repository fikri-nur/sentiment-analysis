@extends('admin.layouts.app', ['title' => 'Data Tweet'])

@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .custom-table {
            color: #333;
            /* Warna font */
            border-color: #ddd;
            /* Warna garis */
        }
    </style>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tweet</h6>
            @if (count($datasets) > 0)
                <div class="text-right">
                    <button id="deleteAllData" class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal"><i class="fas fa-fw fa-solid fa-trash"></i> Hapus Semua Data</button>
                    <a href="{{ route('preprocessings.cleansing-index') }}" class="btn btn-primary">Preprocessing <i
                            class="fas fa-fw fa-solid fa-angle-right"></i></a>
                </div>
            @endif
        </div>
        <div class="card-body">
            @if (count($datasets) == 0)
                <form action="{{ route('datasets.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" required>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-3">Import Data</button>
                    </div>
                </form>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered custom-table" id="dataTweet-table" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Full Text</th>
                            <th>Sentiment</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Full Text</th>
                            <th>Sentiment</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($datasets as $dataset)
                            <tr>
                                <td>{{ $dataset->id }}</td>
                                <td>{{ $dataset->username }}</td>
                                <td>{{ $dataset->full_text }}</td>
                                <td>{{ $dataset->sentiment }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Hapus Semua Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus semua data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteAllDataForm" action="{{ route('datasets.clear-all') }}" method="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        // Add change event listener to file input
        document.getElementById('customFile').addEventListener('change', function(e) {
            // Get the name of the selected file
            var fileName = e.target.files[0].name;

            // Update the custom file label with the selected file name
            var label = document.querySelector('.custom-file-label');
            label.textContent = fileName;
        });
    </script>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTweet-table').DataTable();
        });
    </script>
@endpush
