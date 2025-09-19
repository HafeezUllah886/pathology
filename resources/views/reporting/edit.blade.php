@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
           
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Re-Enter Test : {{$test->test->name}} - {{$test->receipt->id}} | {{$test->receipt->patient_name}} | {{$test->receipt->patient_age}} | {{$test->receipt->patient_gender}}</h3>
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
                <form action="{{ route('reporting.update', $test->id) }}" method="post">
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
                                            <input type="number" name="result[]" value="{{ $parameter->value }}" step="any" required id="result_{{ $key }}" class="form-control">
                                        @elseif($parameter->type == "Text")
                                            <textarea name="result[]" required rows="1" id="result_{{ $key }}" class="form-control autocomplete-textarea">{!! $parameter->value !!}</textarea>
                                        @elseif($parameter->type == "Select")
                                            <select name="result[]" required id="result_{{ $key }}" class="form-control">
                                                @foreach ($parameter->options as $option)
                                                    <option value="{{ $option }}" {{ $parameter->value == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                    <td class="no-padding">@if($parameter->normal_range != "")<pre class="form-control p-0 m-0"><p class="p-0 m-0">{!! $parameter->normal_range !!}</p></pre>@endif</td>
                                    @endif
                                    <td class="no-padding"><button type="button" class="btn btn-danger" tabindex="-1" onclick="deleteParameter({{ $key }})">Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="receipt_id" value="{{ $test->receipt_id }}">
                    <input type="hidden" name="test_id" value="{{ $test->test_id }}">
                    <input type="hidden" name="receipt_test_id" value="{{ $test->id }}">
                    <div class="form-group">
                        <label for="notes">Remarks</label>
                        <textarea name="notes" id="notes"  class="form-control w-100">{!! $test->notes !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="remarks">Add Remarks</label>
                        <select id="remarks" class="selectize">
                            <option value=""></option>
                            @foreach (($test->test->remarks ?? []) as $remark)
                                <option value="{{ $remark }}">{{ $remark }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 w-100">Save Report</button>
                </form>
                </div>
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
        onChange: function(value) {
            if (!value.length) return;
            if (value != 0) {
                add_remarks(value);
                this.clear();
                this.focus();
            }
        },
    });

    function add_remarks(value)
    {
        $("#notes").append(value + "\n");
    }

function deleteParameter(id) {
        $('#row_' + id).remove();
    }
</script>
@endsection
