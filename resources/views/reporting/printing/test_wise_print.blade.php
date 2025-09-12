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
                            <div class="card-header p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <img src="{{asset('assets/images/header.jpg')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12 border-bottom-dashed border-1" style="padding: 0 80px 0px 80px">
                            <div class="card-body pl-4 pr-4 pt-1 pb-1">
                               <table class="w-100">
                                <tr class="p-0 m-0">
                                    <th class="no-padding">Lab #</th>
                                    <td class="no-padding">: {{$test->receipt->id}}</td>
                                    <th class="no-padding">Report Date:</th>
                                    <td class="no-padding">: {{date("d-m-Y", strtotime($test->result_entered_at))}} {{\Carbon\Carbon::parse($test->result_entered_at)->format('h:i A')}}</td>
                                </tr>
                                <tr class="p-0 m-0">
                                    <th class="no-padding">Patient</th>
                                    <td class="no-padding">: {{$test->receipt->patient_name}}</td>
                                    <th class="no-padding">Sample Date:</th>
                                    <td class="no-padding">: {{date("d-m-Y", strtotime($test->receipt->entery_time))}} {{\Carbon\Carbon::parse($test->receipt->entery_time)->format('h:i A')}}</td>
                                </tr>
                                <tr class="p-0 m-0">
                                    <th class="no-padding">Gender / Age</th>
                                    <td class="no-padding">: {{$test->receipt->patient_gender}} / {{$test->receipt->patient_age}}</td>
                                    <th class="no-padding">Refered By:</th>
                                    <td class="no-padding">: {{$test->receipt->refered_by}}</td>
                                </tr>
                               </table>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12 mt-2" style="padding: 0 80px 0px 80px">
                            <div class="card-body pl-4 pr-4">
                                <h4 class="text-decoration-underline text-uppercase">{{$test->test->name}}</h4>
                                <table class="w-100">
                                    <tr class="border-bottom">
                                        <th>Test</th>
                                        <th>Result</th>
                                        <th>Unit</th>
                                        <th>Normal Range</th>
                                    </tr>
                                    @foreach ($test->parameters as $parameter)
                                        <tr class="border-bottom">
                                            @if($parameter->is_heading == "yes")
                                            <td colspan="4" class="no-padding"><h6 class="mt-2 text-uppercase">{{$parameter->name}}</h6></td>
                                            @else
                                            <td class="no-padding">{{$parameter->name}}</td>
                                            <td class="no-padding">{{$parameter->value}}</td>
                                            <td class="no-padding">{{$parameter->unit}}</td>
                                            <td class="no-padding"><pre class='pre-like-p no-padding m-0'>{!! $parameter->normal_range !!}</pre></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                           
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12 mt-2" style="padding: 0 80px 0px 80px">
                            <div class="card-body pl-4 pr-4">
                                <p class="no-padding"> <strong>Remarks:</strong> {{$test->notes}}</p>
                               <center><p class="no-padding"> --------------------------------- End of Report --------------------------------</p></center>
                               <center><p class="no-padding"> This is Computer Generated Report, Doesn't Require any Signature <br> <strong> Note: </strong> This Report in not Valid for Court</p></center>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection