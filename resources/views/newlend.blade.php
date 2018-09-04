@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card bg-white">
                    <div class="card-body">
                        <h4 class="card-title text-md-center" style="color: #c7254e">ලිපිගොනුව බැහැරට දීම </h4>
                        <form action="/lendings/add" method="POST">
                            <div class="form-group">
                                <label for="form-got-name" class=" col-form-label font-weight-bold">ලිපිගොනු අංකය</label>
                                <input type="text" class="form-control" name="form_id" value="{{$data->form_id}}" disabled>
                                <input type="hidden" name="form_id" value="{{$data->form_id}}">
                            </div>
                            <div class="form-group">
                                <label for="form-got-name" class=" col-form-label font-weight-bold">ලිපිගොනුවෙ නම</label>
                                <input type="text" class="form-control" name="form_name" value="{{$data->form_name}}" disabled>
                                <input type="hidden" name="form_name" value="{{$data->form_name}}">
                            </div>
                            <div class="form-group">
                                <label for="form-got-officer-name" class=" col-form-label  font-weight-bold">නිලධාරියාගේ නම</label>
                                <input type="text" class="form-control" name="officer_name" required>
                            </div>
                            <div class="form-group" align="center">
                                <input type="submit" class="btn btn-primary" value="Submit" onclick="return confirm('Are you sure?')" style="width: 200px">
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // window.onunload = function(){
        //     window.opener.location.reload();
        // };
    </script>
@endsection