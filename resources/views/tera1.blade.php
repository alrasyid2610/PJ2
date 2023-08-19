<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> --}}
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/searchBuilder.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/dataTables.dateTime.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/teradocu/searchPanes.dataTables.min.css') }}">
    <title>Teradocu - view SO</title>
    <style>
        .my_class {
            background-color: red !important;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-12">
                <input type="date">
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12 p-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Sales Order</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped responsive" id="myTable">
                                @php
                                    // dd($item2);
                                @endphp
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            {{-- <label for="">
                                                <input type="text" id="so_number">
                                            </label> --}}
                                            SO Number
                                        </th>
                                        <th>Type</th>
                                        <th>Print Date</th>
                                        <th>Sales Name</th>
                                        <th>Customer Name</th>
                                        <th>Item FG</th>
                                        <th>Time Stamp</th>
                                        <th>Have Ready Date</th>
                                        <th>Document Download</th>
                                        <th>Attachment Download</th>
                                        {{-- <th>Status</th> --}}
                                        {{-- <th>Customer Name</th> --}}
                                        {{-- <th>Item FG</th> --}}
                                        {{-- <th>Created Date</th> --}}
                                    </tr>
                                </thead>
                                @php
                                    $no = 0;
                                @endphp
                                <tbody>
                                    @foreach ($data as $item2)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $item2->procedureno }}</td>
                                            <td>{{ $item2->type }}</td>
                                            <td>{{ $item2->print_date }}</td>
                                            <td>{{ $item2->salesname }}</td>
                                            <td>{{ Str::upper($item2->customername) }}</td>
                                            <td>{{ $item2->itemfg }}</td>
                                            <td>{{ $item2->timestamp }}</td>
                                            <td>{{ $item2->havereadydate }}</td>
                                            <td><a href="http://172.16.128.120/rest/sales-orders/documents/{{ $item2->documentid }}/download">{{ $item2->documentname }}</a></td>
                                            <td>
                                                {{-- {{ $item2->attacmentid == null ? "Kosokng" : "<a href='http://172.16.128.120/rest/sales-orders/attachments/$item2->attacmentid/download'>Download Document</a>" }} --}}
                                                @if ($item2->attacmentid == null)
                                                    <p>Kosong</p>
                                                @else
                                                    <a href='http://172.16.128.120/rest/sales-orders/attachments/{{ $item2->attacmentid }}/download'>{{  substr($item2->attachmentname, '0', '15')  }}</a>
                                                @endif
                                            </td>
                                            {{-- <td><iframe src="http://172.16.128.120/rest/sales-orders/documents/{{ $item2->documentid }}/download" width='100%' height='1000px' allowfullscreen webkitallowfullscreen></iframe></td> --}}
                                            {{-- <td>{{ $item2->status }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('plugins/teradocu/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/dataTables.searchPanes.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/dataTables.searchBuilder.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/teradocu/buttons.html5.min.js') }}"></script>
    <script>
        let table = $('#myTable').DataTable({
            dom: 'QBlfrtip',
            // dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
            // responsive: true,
        });
        // $('#so_number').on('keyup', (event) => {
        //     console.log($(event.currentTarget).val())
        // })
    </script>
</body>
</html>
