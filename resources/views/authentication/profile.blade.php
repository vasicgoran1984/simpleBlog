@extends('authentication.scheduleTop')

@section('profile-page')
    @if(\Auth::user()->id)
      
      
        <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Profile</h3>
                            </div>
                            <!-- Login Form -->
                            <div class="panel-body">
                                <form id="add-edit-profile-user" method="POST" enctype="multipart/form-data">
                                    <div class="alert alert-warning" style="display:none"></div>
                                    
                                    <input type="text" id="users_id" value="{{Auth::user()->id}}" name="users_id" class="form-control">
                                    
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" id="first_name" value="<?php echo (isset($profile->first_name) ? $profile->first_name : ''); ?>" name="first_name" class="form-control" required placeholder="First Name">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" id="last_name" value="<?php echo (isset($profile->last_name) ? $profile->last_name : ''); ?>" name="last_name" class="form-control" required placeholder="Last Name">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" id="phone_number" value="<?php echo (isset($profile->phone_number) ? $profile->phone_number : ''); ?>" name="phone_number" class="form-control" required placeholder="Phone">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" id="mobile_number" value="<?php echo (isset($profile->mobile_number) ? $profile->mobile_number : ''); ?>"  name="mobile_number" class="form-control" required placeholder="Mobile">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Address</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <input type="text" id="address" value="<?php echo (isset($profile->address) ? $profile->address : ''); ?>"  name="address" class="form-control" required placeholder="Address">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <input type="text" id="city" value="<?php echo (isset($profile->city) ? $profile->city : ''); ?>"  name="city" class="form-control" required placeholder="City">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>State</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-flag-o"></i>
                                            </span>
                                            <input type="text" id="state" value="<?php echo (isset($profile->state) ? $profile->state : ''); ?>"  name="state" class="form-control" required placeholder="State">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Zip</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-flag-o"></i>
                                            </span>
                                            <input type="text" id="zip" value="<?php echo (isset($profile->zip) ? $profile->zip : ''); ?>"  name="Zip" class="form-control" required placeholder="Zip">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Profile Picture</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-picture-o"></i>
                                            </span>
                                            <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group btn-toolbar">
                                        <input type="button" value="Save" onClick="addEditProfile()" class="btn btn-primary pull-left login-user">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endif
    
    <script>
        
        function addEditProfile() {
            var data = $("#add-edit-profile-user").serialize();

            console.log(data);

            $.ajax({
                type: 'post',
                url: '{!! URL::route('addEditProfileUser') !!}',
                dataType: 'json',
                data:   'users_id=' + $("#add-edit-profile-user #users_id").val() +
                        '&first_name=' + $("#add-edit-profile-user #first_name").val() +
                        '&last_name=' + $("#add-edit-profile-user #last_name").val() +
                        '&phone_number=' + $("#add-edit-profile-user #phone_number").val() +
                        '&mobile_number=' + $("#add-edit-profile-user #mobile_number").val() +
                        '&address=' + $("#add-edit-profile-user #address").val() +
                        '&city=' + $("#add-edit-profile-user #city").val() +
                        '&state=' + $("#add-edit-profile-user #state").val() +
                        '&zip=' + $("#add-edit-profile-user #zip").val() +
                        '&profile_pic=' + $("#add-edit-profile-user #profile_pic").val() +
                        '&_token=' + '{!! csrf_token() !!}',
                success: function(data) {
                    if (data.status === true) {
                        //$(".main-wrapper").html(data.body);
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                        $.notify("Save", "success");
                        $(".alert-warning").hide();
                    } else if (data.errors) {
                        var errors = "";

                        $.each(data, function (val, key) {

                            if (key.first_name !== undefined) {
                                errors += key.first_name + '<br>';
                            }
                            if (key.last_name !== undefined) {
                                errors += key.last_name + '<br>';
                            }
                            if (key.phone_number !== undefined) {
                                errors += key.phone_number + '<br>';
                            }
                            if (key.mobile_number !== undefined) {
                                errors += key.mobile_number + '<br>';
                            }
                            if (key.address !== undefined) {
                                errors += key.address + '<br>';
                            }
                            if (key.city !== undefined) {
                                errors += key.city + '<br>';
                            }
                            if (key.state !== undefined) {
                                errors += key.state + '<br>';
                            }
                            if (key.zip !== undefined) {
                                errors += key.zip + '<br>';
                            }
                        });
                        $(".alert-warning").show();
                        $(".alert-warning").html(errors);
                    }
                }
            });
        }
        
    
    </script>
    
@endsection