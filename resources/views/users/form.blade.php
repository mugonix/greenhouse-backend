<div class="form-group row">
    <label for="name"
           class="col-md-2 col-form-label text-md-right">Role ID</label>

    <div class="col-md-10">
        {!! Form::select("role_id",\DB::table("roles")->pluck("display_name","id"),null,["id"=>"role_id",
            "class"=>"form-control ".($errors->has("role_id")?"is-invalid":""),
            "required", "autofocus"]) !!}

        @error('role_id')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="username"
           class="col-md-2 col-form-label text-md-right">{{ __('Username') }}</label>

    <div class="col-md-10">
        {!! Form::text("username",null,["id"=>"username",
            "class"=>"form-control ". ($errors->has("username")?"is-invalid":""),
            "required", "autocomplete"=>"username",(isset($user)?"disabled":"")]) !!}

        <small class="form-text">Username must on contain characters and digits</small>
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="first_names"
           class="col-md-2 col-form-label text-md-right">First Name(s)</label>

    <div class="col-md-10">
        {!! Form::text("first_names",null,["id"=>"first_names",
            "class"=>"form-control ". ($errors->has("first_names")?"is-invalid":""),
            "required", "autocomplete"=>"first_names"]) !!}

        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="surname"
           class="col-md-2 col-form-label text-md-right">Surname</label>

    <div class="col-md-10">
        {!! Form::text("surname",null,["id"=>"surname",
            "class"=>"form-control ". ($errors->has("surname")?"is-invalid":""),
            "required", "autocomplete"=>"surname"]) !!}

        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email"
           class="col-md-2 col-form-label text-md-right">E-Mail Address</label>

    <div class="col-md-10">
        {!! Form::email("email",null,["id"=>"email",
            "class"=>"form-control ". ($errors->has("email")?"is-invalid":""),
            "required", "autocomplete"=>"email"]) !!}

        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>



