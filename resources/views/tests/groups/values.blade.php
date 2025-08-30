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
                                    <h3> Manage Values - {{$group->name}} </h3>
                                </div>
                                <div class="col-6 d-flex flex-row-reverse"><a href="{{ route('test_groups.index') }}"
                                        class="btn btn-danger">Close</a></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('test_values.store', ['id' => $group->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <h4>Values</h4>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse"><button type="button" onclick="addTestValue()"
                                    class="btn btn-primary">Add Value (Alt)</button></div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th width="">Name</th>
                                            <th width="" class="text-center">Unit</th>
                                            <th width="" class="text-center">Normal Range</th>
                                            <th width="" class="text-center">Type</th>
                                            <th width="" class="text-center">Options / Hints</th>
                                            <th></th>
                                        </thead> 
                                        <tbody id="test_values">
                                            @foreach ($group->values as $key => $value)
                                            @php
                                                $key = $key + 1;
                                            @endphp
                                            <tr id="row_{{ $key }}">
                                                <td><input type="text" name="name[]" value="{{ $value->name }}" required id="name_{{ $key }}" class="form-control"></td>
                                                <td><input type="text" name="unit[]" value="{{ $value->unit }}" required id="unit_{{ $key }}" class="form-control"></td>
                                                <td><textarea name="normal_range[]" required id="normal_range_{{ $key }}" class="form-control">{!! $value->normal_range !!}</textarea></td>
                                                <td><select name="type[]" required id="type_{{ $key }}" class="form-control"> <option value="Numaric" @selected($value->type == 'Numaric')>Numaric</option><option value="Text" @selected($value->type == 'Text')>Text</option><option value="Select" @selected($value->type == 'Select')>Select</option></select></td>
                                                <td><textarea name="options[]" id="options_{{ $key }}" placeholder="Seperated by comma" class="form-control">{{ is_array($value->options) ? implode(', ', $value->options) : $value->options }}</textarea></td>
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
     
        var test_id = {{ $group->values()->count() }};
        function addTestValue() {
            test_id++;
            var $newRow = $('<tr id="row_' + test_id + '">' +
                '<td><input type="text" name="name[]" required id="name_' + test_id + '" class="form-control"></td>' +
                '<td><input type="text" name="unit[]" required id="unit_' + test_id + '" class="form-control"></td>' +
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
