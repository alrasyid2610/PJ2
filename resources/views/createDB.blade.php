@extends('layouts.main')
@section('main')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Form</h4>
                        <form action="{{ route('createDB.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="">Database</label>
                              <input type="text" name="db_name" id="" class="form-control" placeholder="Database Name" aria-describedby="helpId">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection
