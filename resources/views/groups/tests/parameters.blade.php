@extends('layout.popups')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3> Manage Parameters - {{$test->name}} </h3>
                                </div>
                                <div class="col-6 d-flex flex-row-reverse"><a href="{{ route('tests.index', ['id' => $test->test_groups_id]) }}"
                                        class="btn btn-danger">Close</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('test_parameters.store', ['id' => $test->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <h4>Parameters</h4>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse"><button type="button" onclick="addTestValue()"
                                    class="btn btn-primary">Add Parameter (Alt)</button></div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th width="100px">#</th>
                                            <th width="">Name</th>
                                            <th width="" class="text-center">Unit</th>
                                            <th width="" class="text-center">Normal Range</th>
                                            <th width="" class="text-center">Type</th>
                                            <th width="" class="text-center">Options / Hints</th>
                                            <th></th>
                                        </thead> 
                                        <tbody id="test_values">
                                            @foreach ($parameters as $key => $parameter)
                                            @php
                                                $key = $key + 1;
                                            @endphp
                                            <tr id="row_{{ $key }}">
                                                <td><input type="text" name="sort[]" value="{{ $key }}" required id="sort_{{ $key }}" class="form-control"></td>
                                                <td><input type="text" name="name[]" value="{{ $parameter->title }}" required id="name_{{ $key }}" class="form-control"></td>
                                                <td><select name="unit[]" id="unit_{{ $key }}" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->name }}" @selected($unit->name == $parameter->unit)>{{ $unit->name }}</option>
                                                    @endforeach
                                                </select></td>
                                                <td><textarea name="normal_range[]" required id="normal_range_{{ $key }}" class="form-control">{!! $parameter->normal_range !!}</textarea></td>
                                                <td><select name="type[]" required id="type_{{ $key }}" class="form-control"> <option value="Numaric" @selected($parameter->type == 'Numaric')>Numaric</option><option value="Text" @selected($parameter->type == 'Text')>Text</option><option value="Select" @selected($parameter->type == 'Select')>Select</option><option value="Heading" @selected($parameter->type == 'Heading')>Heading</option></select></td>
                                                <td><textarea name="options[]" id="options_{{ $key }}" placeholder="Seperated by comma" class="form-control">{{ is_array($parameter->options) ? implode(', ', $parameter->options) : $parameter->options }}</textarea></td>
                                                <td><span class="btn btn-sm btn-danger" onclick="deleteTestValue({{ $key }})">X</span></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('page-css')
    <style>
        .no-padding {
            padding: 5px 5px !important;
        }
    </style>
@endsection
@section('page-js')
    <script>
        $(document).ready(function() {
            $(document).keydown(function(e) {
                if (e.key === 'Alt') {
                    e.preventDefault();
                    addTestValue();
                }
            });
        });
     
        var test_id = {{ $test->parameters()->count() }};
        function addTestValue() {
            test_id++;
            var $newRow = $('<tr id="row_' + test_id + '">' +
                '<td><input type="text" name="sort[]" required id="sort_' + test_id + '" class="form-control"></td>' +
                '<td><input type="text" name="name[]" required id="name_' + test_id + '" class="form-control"></td>' +
                '<td><select name="unit[]" required id="unit_' + test_id + '" class="form-control"><option value=""></option>@foreach ($units as $unit)<option value="{{ $unit->name }}">{{ $unit->name }}</option>@endforeach</select></td>' +
                '<td><textarea name="normal_range[]" required id="normal_range_' + test_id + '" class="form-control"></textarea></td>' +
                '<td><select name="type[]" required id="type_' + test_id + '" class="form-control"> <option value="Numaric">Numaric</option><option value="Text">Text</option><option value="Select">Select</option></select></td>' +
                '<td><textarea name="options[]" id="options_' + test_id + '" placeholder="Seperated by comma" class="form-control"></textarea></td>' +
                '<td><span class="btn btn-sm btn-danger" onclick="deleteTestValue(' + test_id + ')">X</span></td>' +
                '</tr>');
            $("#test_values").append($newRow);
        }

        function deleteTestValue(id) {
            $('#row_' + id).remove();
        }
    </script>
@endsection
