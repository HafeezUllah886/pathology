@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Print Report</h3>
                </div>
                <form action="" method="get">
                <div class="card-body">
                    <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">
                    <ul class="list-unstyled">
                        @foreach ($receipt->receipt_tests as $test)
                            @if ($test->parameters()->count() > 0)
                                <li><input type="checkbox" name="tests[]" value="{{ $test->id }}" id="test{{ $test->id }}" checked><label for="test{{ $test->id }}"> &nbsp;{{ $test->test->name }}</label></li>
                            @endif
                        @endforeach
                    </ul>
                    <button id="printBtn" class="btn btn-primary w-100 mt-2">Print With Header</button>
                    <button id="printBtn" class="btn btn-success w-100 mt-2">Print Without Header</button>
                    
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection
@section('page-js')
<script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        $(".selectize").selectize({
        plugins: ['remove_button'],
        maxItems: null,
        create: false,
        placeholder: 'Select Vendors...'
    });
        
    </script>
    
@endsection
