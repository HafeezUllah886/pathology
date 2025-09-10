@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
           
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>{{$test->test->name}} - {{$test->receipt->id}} | {{$test->receipt->patient_name}} | {{$test->receipt->patient_age}} | {{$test->receipt->patient_gender}}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('reporting.store') }}" method="post">
                    @csrf
                    <table class="table no-padding" id="buttons-datatables">
                        <thead>
                            <th>Test</th>
                            <th>Unit</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($parameters as $key => $parameter)
                            <input type="hidden" name="parameter_id[]" value="{{ $parameter->id }}">
                                <tr class="no-padding" id="row_{{ $key }}">
                                    @if($parameter->type == "Heading")
                                    <th colspan="4" class="no-padding">{{ $parameter->title }}</th>
                                    <input type="hidden" name="result[]">
                                    @else
                                    <td class="no-padding">{{ $parameter->title }} @if($parameter->type == "Text" && $parameter->options != "") 
                                            <span data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content=" @foreach ($parameter->options as $option)
                                                    {{ $option }}, 
                                                @endforeach">
                                                <i class="ri-question-line text-info"></i>
                                            </span>
                                        
                                        @endif</td>
                                    <td class="no-padding">{{ $parameter->unit }}</td>
                                    <td class="no-padding">
                                        @if($parameter->type == "Numeric")
                                            <input type="number" name="result[]" step="any" required id="result_{{ $key }}" class="form-control no-padding">
                                        @elseif($parameter->type == "Text")
                                            <textarea name="result[]" required rows="1" id="result_{{ $key }}" class="form-control autocomplete-textarea no-padding"></textarea>
                                        @elseif($parameter->type == "Select")
                                            <select name="result[]" required id="result_{{ $key }}" class="form-control no-padding">
                                                @foreach ($parameter->options as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                    <td class="no-padding">@if($parameter->normal_range != "")<pre class="form-control p-0 m-0">{{ $parameter->normal_range }}</pre>@endif</td>
                                    @endif
                                    <td class="no-padding"><button type="button" class="btn btn-danger no-padding" tabindex="-1" onclick="deleteParameter({{ $key }})">Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="receipt_id" value="{{ $test->receipt_id }}">
                    <input type="hidden" name="test_id" value="{{ $test->test_id }}">
                    <input type="hidden" name="receipt_test_id" value="{{ $test->id }}">
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes"  class="form-control w-100"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 w-100">Save Report</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
<script>
function deleteParameter(id) {
        $('#row_' + id).remove();
    }
</script>
@endsection
