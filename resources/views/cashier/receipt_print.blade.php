<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style>
        body{
            background: rgb(232, 232, 232);
            font-size: 15px;
            font-family: "Helvetica";
        }
        .main{
            width: 80mm;
            background: #fff;
            overflow: hidden;
            margin: 0px auto;
            padding: 10px;
        }
        .logo{
            width: 100%;
            overflow: hidden;
            height: 130px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo img{
            width:80%;
        }
        .header p{
            margin: 2px 0px;
        }
        .content{
            overflow: hidden;
            width: 100%;
        }
        .content table{
            width: 100%;
            border-collapse: collapse;
        }

        .bg-dark{
            background: black;
            color:#ffff;
        }

        .text-left{
            text-align: left !important;
        }
        .text-right{
            text-align: right !important;
        }
        .text-center{
            text-align: center !important;
        }
        .area-title{

            font-size: 18px;
        }
        tr.bottom-border {
            border-bottom: 1px solid #ccc; /* Add a 1px solid border at the bottom of rows with the "my-class" class */
        }
        .uppercase{
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="main" id="main">
        <div style="text-align: center;">
            <h2 class="text-center" style="margin: 0">{{projectNameHeader()}}</h2>
            <h3 class="text-center" style="margin: 0">{{projectAddress()}}</h3>
            <h3 class="text-center" style="margin: 0">{{projectContact()}}</h3>
          
         </div>
        <div class="header">
            <div class="area-title">
                <p class="text-center bg-dark">Receipt</p>
            </div>
            <table>
                <tr>
                    <td width="15%">Lab # </td>
                    <td width="35%"> {{ $receipt->id }}</td>
                    <td width="15%">Date: </td>
                    <td width="35%"> {{ date("d-m-Y", strtotime($receipt->entery_time)) }} {{ \Carbon\Carbon::parse($receipt->entery_time)->format('h:i A') }}</td>
                </tr>
                <tr>
                    <td width="15%"> Patient: </td>
                    <td width="55%" colspan="3">
                        {{ $receipt->patient_name }} | 
                        {{ $receipt->patient_age }} | 
                        {{ $receipt->patient_gender }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="content">
            <table>
                <thead class="bg-dark">
                    <th class="text-left">Test</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $items = 0;
                        $qty = 0;
                    @endphp
                   @foreach ($receipt->receipt_tests as $item)
                            <tr class="bottom-border">
                                <td class="text-start">{{ $item->test->name }}</td>
                                <td class="text-right">{{ number_format($item->price, 2) }}</td>
                            </tr>
                   @endforeach
                   <tr>
                    <td>
                        Test(s) = {{ $receipt->receipt_tests->count() }} 
                    </td>
                    <td  class="text-right" style="font-size: 18px"><strong>{{ number_format($receipt->amount,0) }}</strong></td>
                   </tr>
                   <tr>
                    <td class="text-right">Dis:</td>
                    <td class="text-right">{{ number_format($receipt->discount,0) }}</td>
                   </tr>
                   <tr>
                    <td class="text-right">Net Amount:</td>
                    <td class="text-right" style="font-size: 20px"><strong>{{ number_format($receipt->net_amount, 0) }}</strong></td>
                   </tr>
                  {{--  <tr>
                    <td colspan="3" class="text-right">Received:</td>
                    <td colspan="3" class="text-right" style="font-size: 20px"><strong>{{ number_format($invoice->received, 0) }}</strong></td>
                   </tr>
                   <tr>
                    <td colspan="3" class="text-right">Cash Back:</td>
                    <td colspan="3" class="text-right" style="font-size: 20px"><strong>{{ number_format($invoice->change, 0) }}</strong></td>
                   </tr> --}}
                </tbody>
            </table>
        </div>
        <div class="notes">
            <span style="font-weight: bold">Refered By: </span> {{ $receipt->refered_by }}
        </div>
        <div class="notes">
            <span style="font-weight: bold">Entered By: </span> {{ $receipt->user->name }}
        </div>
        <div class="notes">
            <span style="font-weight: bold">Expected Report Date: </span> {{ date("d-m-Y", strtotime($receipt->reporting_time)) }} 
            <span style="font-weight: bold">Expected Report Time: </span> {{ \Carbon\Carbon::parse($receipt->reporting_time)->format('h:i A') }}
        </div>
        <hr>
        <div class="notes">
            <span>{{ $receipt->notes }}</span>
        </div>
        <div class="footer">
            <hr>
            <h5 class="text-center">Developed by Diamond Software <br> diamondsoftwareqta.com</h5>
        </div>
    </div>
</body>

</html>
<script src="{{ asset('src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
setTimeout(function() {
    window.print();
    }, 2000);
        setTimeout(function() {
            window.location.href = "{{ route('receipts.create')}}";
    }, 5000);

</script>
