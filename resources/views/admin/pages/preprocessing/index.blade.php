@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Preprocessing</h1>                
                @if (count($preprocessings) == 0 && count($datasets) > 0)
                    <a href="{{ route('preprocessings.cleansing') }}" class="btn btn-primary">Cleansing</a>
                @endif
                
                @foreach ($preprocessings as $index => $preprocessing)
                    @if ($preprocessing->cleaned_text == null)
                        <a href="{{ route('preprocessings.cleansing') }}" class="btn btn-primary">Cleansing</a>
                    @endif

                    @if ($preprocessing->case_folded_text == null)
                        <a href="{{ route('preprocessings.case-folding') }}" class="btn btn-primary">Case Folding</a>
                    @endif
                    @if ($preprocessing->tokenized_text == null)
                        <a href="{{ route('preprocessings.tokenizing') }}" class="btn btn-primary">Tokenizing</a>
                    @endif

                    @if ($preprocessing->normalized_text == null)
                        <a href="{{ route('preprocessings.normalization') }}" class="btn btn-primary">Normalization</a>
                    @endif

                    @if ($preprocessing->stopwords_removed_text == null)
                        <a href="{{ route('preprocessings.stopword-removal') }}" class="btn btn-primary">Stopword
                            Removal</a>
                    @endif

                    @if ($preprocessing->stemmed_text == null)
                        <a href="{{ route('preprocessings.stemming') }}" class="btn btn-primary">Stemming</a>
                    @endif
                    @break
                    @endforeach
            </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="preprocessing-table">
                    @if (count($datasets) != 0)
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Original</th>
                                <th>Cleaned</th>
                                <th>Case Folded</th>
                                <th>Tokenized</th>
                                <th>Normalized</th>
                                <th>Stopword Removal</th>
                                <th>Stemmed</th>
                            </tr>
                        </thead>
                    @endif
                    <tbody>
                        @if (count($preprocessings) == 0 && count($datasets) > 0)
                            @foreach ($datasets as $dataset)
                                <tr>
                                    <td>{{ $dataset->id }}</td>
                                    <td>{{ $dataset->full_text }}</td>
                                    <td>Not processed</td>
                                    <td>Not processed</td>
                                    <td>Not processed</td>
                                    <td>Not processed</td>
                                    <td>Not processed</td>
                                    <td>Not processed</td>
                                </tr>
                            @endforeach
                        @elseif (count($datasets) == 0)
                            <p>The data has not been imported.</p>
                        @else
                            @foreach ($preprocessings as $index => $preprocessing)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $preprocessing->dataset->full_text }}</td>
                                    <td>{{ $preprocessing->cleaned_text ?: 'Not processed' }}</td>
                                    <td>{{ $preprocessing->case_folded_text ?: 'Not processed' }}</td>
                                    <td>{{ $preprocessing->tokenized_text ?: 'Not processed' }}</td>
                                    <td>{{ $preprocessing->normalized_text ?: 'Not processed' }}</td>
                                    <td>{{ $preprocessing->stopwords_removed_text ?: 'Not processed' }}</td>
                                    <td>{{ $preprocessing->stemmed_text ?: 'Not processed' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
