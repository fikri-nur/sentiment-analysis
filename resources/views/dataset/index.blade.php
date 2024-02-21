@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dataset</h1>

        @if ($datasets == null)
            <form action="{{ route('datasets.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <button type="submit" class="btn btn-primary">Import Data</button>
            </form>
            <p>The table has not been imported.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Full Text</th>
                        <th>Sentiment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datasets as $dataset)
                        <tr>
                            <td>{{ $dataset->id }}</td>
                            <td>{{ $dataset->username }}</td>
                            <td>{{ $dataset->full_text }}</td>
                            <td>{{ $dataset->sentiment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
