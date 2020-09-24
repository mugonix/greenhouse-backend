@if (session('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <div class="alert-icon contrast-alert">
            <i class="fa fa-check"></i>
        </div>
        <div class="alert-message">
            <span>{{ session('status') }}</span>
        </div>
    </div>
@endif

@foreach($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <div class="alert-icon contrast-alert">
            <i class="fa fa-times"></i>
        </div>
        <div class="alert-message">
            <span>{{$error}}</span>
        </div>
    </div>
@endforeach
