@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                                <a href="javascript:window.print()" class="btn btn-success ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h1>{{projectNameAuth()}}</h1>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body pl-4 pr-4">
                               <table class="table">
                                <tr class="p-0 m-0">
                                    <td class="p-1 m-0">Lab #</td>
                                    <td class="p-1 m-0">: {{$test->receipt->id}}</td>
                                    <td class="p-1 m-0">Report Date:</td>
                                    <td class="p-1 m-0">: {{date("d-m-Y", strtotime($test->result_entered_at))}} {{\Carbon\Carbon::parse($test->result_entered_at)->format('h:i A')}}</td>
                                </tr>
                                <tr class="p-0 m-0">
                                    <td class="p-1 m-0">Patient</td>
                                    <td class="p-1 m-0">: {{$test->receipt->patient_name}}</td>
                                    <td class="p-1 m-0">Sample Date:</td>
                                    <td class="p-1 m-0">: {{date("d-m-Y", strtotime($test->receipt->entery_time))}} {{\Carbon\Carbon::parse($test->receipt->entery_time)->format('h:i A')}}</td>
                                </tr>
                                <tr class="p-0 m-0">
                                    <td class="p-1 m-0">Gender / Age</td>
                                    <td class="p-1 m-0">: {{$test->receipt->patient_gender}} / {{$test->receipt->patient_age}}</td>
                                    <td class="p-1 m-0">Refered By:</td>
                                    <td class="p-1 m-0">: {{$test->receipt->refered_by}}</td>
                                </tr>
                               </table>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body pl-4 pr-4">
                                <h4 class="text-decoration-underline text-uppercase">{{$test->test->name}}</h4>
                                <table class="table">
                                    <tr>
                                        <td>Test</td>
                                        <td>Value</td>
                                        <td>Unit</td>
                                        <td>Normal Range</td>
                                    </tr>
                                    @foreach ($test->parameters as $parameter)
                                        <tr>
                                            <td>{{$parameter->name}}</td>
                                            <td>{{$parameter->value}}</td>
                                            <td>{{$parameter->unit}}</td>
                                            <td><pre class='fst-normal'>{!! $parameter->normal_range !!}</pre></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection