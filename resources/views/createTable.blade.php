@extends('layouts.main')
@section('main')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Form Create Table - Database Connect in {{ $db_name }}</h4>
                        <form action="{{ route('createTable.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="db_name" value="{{ $db_name }}" id="" class="form-control" placeholder="Database Name" aria-describedby="helpId">
                            <div class="form-group">
                              <label for="">Table Name</label>
                              <input type="text" name="tbl_name" id="" class="form-control" placeholder="Table Name" aria-describedby="helpId">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <div class="form-group">
                              <label for="">Field Name</label>
                              <input type="text" name="field" id="" class="form-control" placeholder="Field Name 1" aria-describedby="helpId">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Show Tables - Database Connect in {{ $db_name }}</h4>
                        <ul>
                            @foreach ($tables as $table)
                                <li><h2>{{ $table[0] }}</h2></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection
