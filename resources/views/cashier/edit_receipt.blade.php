@extends('layout.app')
@section('content')
<script>
    var existingTest = [];

    @foreach ($receipt->receipt_tests as $test)
        existingTest.push({{ $test->test_id }});
    @endforeach

</script>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Edit Receipt</h3>
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
                    <form action="{{ route('receipts.update', $receipt->id) }}" method="post">
                        @csrf
                       <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Patient Name</label>
                                <input type="text" name="patient_name" required id="patient_name" class="form-control" value="{{ $receipt->patient_name }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Patient Age</label>
                                <input type="text" name="patient_age" id="patient_age" class="form-control" value="{{ $receipt->patient_age }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Patient Gender</label>
                               <select name="patient_gender" id="patient_gender" class="form-control">
                                <option value="Male" {{ $receipt->patient_gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $receipt->patient_gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ $receipt->patient_gender == 'Other' ? 'selected' : '' }}>Other</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Patient Contact</label>
                                <div class="input-group">
                                    <span class="input-group-text">+92</span>
                                 <input type="text" name="patient_contact" id="patient_contact" placeholder="3456789012" class="form-control" value="{{ $receipt->patient_contact }}">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12 mt-2">
                            <div class="form-group">
                               <select name="entered_by" id="entered_by" class="selectize">
                                <option value="">Select Test</option>
                                @foreach ($tests as $test)
                                    <option value="{{ $test->id }}">{{ $test->name }} - {{ $test->rate }}</option>
                                @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Test Name</th>
                                        <th>Reporting Time</th>
                                        <th width="100px" class="text-center">Rate</th>
                                        <th width="50px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tests_list">
                                    @foreach ($receipt->receipt_tests as $test)
                                    @php
                                        $id  = $test->test_id;
                                    @endphp
                                        <tr id="row_{{ $id }}">
                                            <td class="no-padding"><span class="text-info font-size-18">{{ $test->test->name }}</span><br>{{ $test->test->parameters->pluck('title')->implode(', ') }}</td>
                                            <td class="no-padding">{{ $test->reporting_time }}</td>
                                            <td class="no-padding"><input type="number" name="rate[]" oninput="updateChanges()" min="0" required step="any" value="{{ $test->price }}" class="form-control text-center no-padding" id="rate_{{ $id }}"></td>
                                            <td class="no-padding"> <span class="btn btn-sm btn-danger" onclick="deleteRow({{ $id }})">X</span> </td>
                                            <input type="hidden" name="id[]" value="{{ $test->id }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-end no-padding">Total</th>
                                        <th id="total" class="no-padding text-end">{{ $receipt->amount }}</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-end no-padding">Discount</th>
                                        <th class="no-padding"><input type="number" name="discount" value="{{ $receipt->discount }}" id="discount" oninput="updateChanges()" class="form-control text-center m-0 no-padding"></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-end no-padding">Net Total</th>
                                        <th id="net_total" class="no-padding text-end">{{ $receipt->net_amount }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="name">Refered By</label>
                                <input type="text" name="refered_by" id="refered_by" value="{{ $receipt->refered_by }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="name">Entery Time</label>
                                <input type="datetime-local" name="entery_time" value="{{ $receipt->entery_time }}" id="entery_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="name">Reporting Time</label>
                                <input type="datetime-local" name="reporting_time" value="{{ $receipt->reporting_time }}" id="reporting_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="name">Paid In</label>
                               <select name="paid_in" id="paid_in" class="form-control">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" {{ $account->id == $receipt->paid_in ? 'selected' : '' }}>{{ $account->title }}</option>
                                @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Notes</label>
                                <textarea name="notes" id="notes" class="form-control">{{ $receipt->notes }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary w-100">Save Receipt</button>
                        </div>
                       </div>
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
                getSingleTest(value);
                this.clear();
                this.focus();
                
            }
        },
    });


        function getSingleTest(id) {
            $.ajax({
                url: "{{ url('receipt/getsingletest/') }}/" + id,
                method: "GET",
                success: function(test) {
                    console.log(test);
                    let found = $.grep(existingTest, function(element) {
                        return element === test.id;
                    });
                    if (found.length > 0) {
                    } else {
                       
                        var id = test.id;
                        var html = '<tr id="row_' + id + '">';
                        html += '<td class="no-padding"><span class="text-info font-size-18">' + test.name + '</span><br>'+test.parameters+'</td>';
                        html += '<td class="no-padding">'+test.report_time+'</td>';
                        html += '<td class="no-padding"><input type="number" name="rate[]" oninput="updateChanges()" min="0" required step="any" value="'+test.rate+'" class="form-control text-center no-padding" id="rate_' + id + '"></td>';
                        html += '<td class="no-padding"> <span class="btn btn-sm btn-danger" onclick="deleteRow('+id+')">X</span> </td>';
                        html += '<input type="hidden" name="id[]" value="' + id + '">';
                        html += '</tr>';
                        $("#tests_list").prepend(html);
                        existingTest.push(id);
                        updateChanges(id);
                    }
                }
            });
        }

        function updateChanges() {
           
          
            var total = 0;
            $("input[id^='rate_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                total += parseFloat(inputValue);
            });

            var discount = parseFloat($('#discount').val());
            var net_total = total - discount;
            $('#total').html(total.toFixed(2));
            $('#net_total').html(net_total.toFixed(2));
           
        }

        function deleteRow(id) {
            $('#row_' + id).remove();
            existingTest = $.grep(existingTest, function(value) {
                return value != id;
            });
            updateChanges();
        }
</script>
@endsection
