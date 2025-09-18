@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <form>
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">From</span>
                            <input type="date" class="form-control" placeholder="Username" name="from" value="{{$from}}" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="date" class="form-control" placeholder="Username" name="to" value="{{$to}}" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-2">
                       <input type="submit" value="Filter" class="btn btn-success w-100">
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Receipts</h3>
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
                    <table class="table" id="buttons-datatables">
                        <thead>
                            <th>#</th>
                            <th>Lab ID</th>
                            <th>Entered on</th>
                            <th>Patient</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Entered By</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($receipts as $key => $receipt)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $receipt->id }}</td>
                                    <td>{{ date("d-m-Y", strtotime($receipt->entery_time)) }} {{ \Carbon\Carbon::parse($receipt->entery_time)->format('h:i A') }}</td>
                                    <td>{{ $receipt->patient_name }}</td>
                                    <td>{{ $receipt->patient_gender }}</td>
                                    <td>{{ $receipt->patient_contact }}</td>
                                    <td>{{ $receipt->user->name }}</td>
                                    <td>{{ $receipt->status }}</td>
                                    <td class="text-end">{{ number_format($receipt->net_amount) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                @if(auth()->user()->role == "Cashier")
                                               
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('receipts.show', $receipt->id)}}">
                                                        <i class="ri-printer-fill align-bottom me-2 text-muted"></i>
                                                        Print
                                                    </a>
                                                </li>
                                                @endif

                                                @if (auth()->user()->role == "Admin")

                                                <li>
                                                    <a class="dropdown-item" href="{{ route('receipts.edit', $receipt->id)}}">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" onclick="cancelReceipt({{ $receipt->id }})">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                        Cancel
                                                    </button>
                                                </li>
                                                    
                                                @endif
                                               
                                                
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="8" class="text-end">Total</th>
                                <th  class="text-end">{{number_format($receipts->sum('net_amount'))}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Cancel Receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="{{ route('receipts.cancel') }}" method="post">
                    @csrf
                    <input type="hidden" name="receipt_id" id="receipt_id">
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="reason">Reason</label>
                            <input type="text" name="reason" required id="reason"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="account">Account</label>
                            <select name="account" required id="account" class="form-control">
                                <option value=""></option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script>
        function cancelReceipt(id) {
            document.getElementById('receipt_id').value = id;
            $('#cancelModal').modal('show');
        }
    </script>
@endsection
