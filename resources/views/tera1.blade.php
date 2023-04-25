<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <title>Hello</title>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <input type="date">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped" id="myTable">
                        @php
                            // dd($item2);
                        @endphp
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>SO Number</th>
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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
</body>
</html>
