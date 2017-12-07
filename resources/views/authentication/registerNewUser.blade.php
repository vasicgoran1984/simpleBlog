@extends('authentication.scheduleTop')

@section('register-user')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Register</h3>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-warning" style="display:none"></div>
                            <form method="POST" id="newUserSave">
                             
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" value="{{ Request::old('email') }}" required placeholder="example@example.com">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                <label>First Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="first_name" class="form-control" value="{{ Request::old('first_name') }}" required placeholder="First Name">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="last_name" class="form-control" value="{{ Request::old('last_name') }}" required placeholder="Last Name">
                                </div>
                            </div>
                                
                            <div class="form-group {{ $errors->has('user_type') ? 'has-error' : '' }}">
                                <label>User Type</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="user_type" class="form-control" value="{{ Request::old('user_type') }}" required placeholder="User Type">
                                </div>
                            </div>
                                
                            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                <label>Location</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" name="location" id="location" class="form-control" value="" required placeholder="Location">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label>Price Hour</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <input type="text" name="price_hour" class="form-control" value="{{ Request::old('price_hour') }}" required placeholder="Price/Hour">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" required placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label>Password Confirm</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Password Confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="button" value="Register" id="register-new-user" class="btn btn-primary pull-left">
                                <input type="hidden" name="_token" value="{{ Session::token() }}"
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $("#register-new-user").on('click', function(){
               
            var data = $("#newUserSave").serialize();
            // Ajax call for insert/save new user-------------------------------
            $.ajax({
                type: 'POST',
                url:  '{!! URL::route('saveNewUser') !!}',
                dataType: 'json',
                data: data,
                success: function(data){
                    if (data.status === true) {
                        $.notify("Saved", "success");
                        $(".alert-warning").hide();
                        $("#newUserSave")[0].reset();
                    } else if (data.errors) {
                        
                        var errors = '';
                        $.each(data, function(val, key) {
                            
                            if (key.email !== undefined) {
                                errors += key.email + '<br/>';
                            }
                            if (key.first_name !== undefined) {
                                errors += key.first_name + '<br/>';
                            }
                            if (key.last_name !== undefined) {
                                errors += key.last_name + '<br/>';
                            }
                            if (key.user_type !== undefined) {
                                errors += key.user_type + '<br/>';
                            }
                            if (key.location !== undefined) {
                                errors += key.location + '<br/>';
                            }
                            if (key.price_hour !== undefined) {
                                errors += key.price_hour + '<br/>';
                            }
                            if (key.password !== undefined) {
                                errors += key.password + '<br/>';
                            }
                            if (key.password_confirmation !== undefined) {
                                errors += key.password_confirmation + '<br/>';
                            }
                        });
                        $(".alert-warning").show();
                        $(".alert-warning").html(errors);
                    }
                }
            });
        });
    </script>
@endsection