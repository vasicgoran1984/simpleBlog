<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        
        <!-- jQuery Notify -->
        <script type="text/javascript" src="js/notify.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <title>BitLab - Demo</title>
    </head>
    <body>
        <div class="main-wrapper">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="#">Simple Blog Demo</a>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Login</h3>
                            </div>
                            <!-- Login Form -->
                                <div class="panel-body">
                                    <form class="form-login-user" method="POST">
                                        <div class="alert alert-warning" style="display:none"></div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input type="email" name="email" class="form-control" required placeholder="example@example.com">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                                <input type="password" name="password" class="form-control" required placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form-group btn-toolbar">
                                            <input type="button" value="Login" onClick="loginUser()" class="btn btn-primary pull-left login-user">
                                            <!--<input type="hidden" name="_token" value="{{ Session::token() }}"-->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                             <input type="button" value="Register" onClick="registerNewUser()" class="btn btn-primary pull-left login-user"
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content"></div>
        <div id="dialog-user"></div>
        <script>
            
         // Function login user-------------------------------------------------
         function loginUser() {
             
            var email = $("form.form-login-user input[name='email']").val();
            var password = $("form.form-login-user input[name='password']").val();
             
            // Ajax ------------------------------------------------------------
            $.ajax({
                type: 'POST',
                url: '{!! URL::route('loginUser') !!}',
                dataType: 'JSON',
                data: 'email=' + email +
                      '&password=' + password +
                      '&_token=' +'{!! csrf_token() !!}',
                success: function(data) {
                    if (data.status === true) {
                        $(".main-wrapper").html(data.body);
                        $(".alert-warning").hide();
                    } else if (data.errors === true) {
                        $(".alert-warning").show();
                        $(".alert-warning").html(data.warning);
                    }
                }
            });
             
         }
         
         function registerNewUser() {

                var id_user = (id_user) ? id_user : '';

                /*
                 * Ajax Request-------------------------------------------------
                 */
                $.ajax({
                    type: 'post',
                    url: '{!! URL::route('createNewUser') !!}',
                    data: 'id_user=' + id_user +
                          '&_token=' + '{!! csrf_token() !!}', 
                    success: function(data) {
                        $("#dialog-user").html(data);
                    },
                    error: function(){

                    }
                });

                /*
                 * Open Dialog----------------------------------------------------------
                 */
                $("#dialog-user").dialog({
                    modal: true,
                    width: 600,
                    height: 500,
                    title: 'Register New User',
                    close: function(){
                        $(this).dialog('destroy').empty();
                    },
                    buttons: [
                        {
                            text: 'Register',
                            click: function() {
                                var data = $("#dialog-user #form-register-new-user").serialize();

                                    console.log(data);

                                $.ajax({
                                    type: 'post',
                                    url: '{!! URL::route('registerNewUser') !!}',
                                    dataType: 'json',
                                    data: data,
                                    success: function(data) {
                                        if (data.status === true) {
                                            $("#dialog-user").dialog("close");
                                            setTimeout(function() {
                                                location.reload();
                                            }, 500);
                                            $.notify("Save", "success");
                                        } else if (data.errors) {
                                            console.log();
                                            var errors = "";

                                            $.each(data, function (val, key) {

                                                if (key.email !== undefined) {
                                                    errors += key.email + '<br>';
                                                }
                                                if (key.password !== undefined) {
                                                    errors += key.password + '<br>';
                                                }
                                                if (key.password_confirmation !== undefined) {
                                                    errors += key.password_confirmation + '<br>';
                                                }
                                            });
                                            $("#dialog-user .alert-warning").show();
                                            $("#dialog-user .alert-warning").html(errors);
                                        }
                                    }
                                });

                            }
                        },
                        {
                            text: 'Close',
                            click: function() {
                                $("#dialog-user").dialog("close");
                                location.reload();
                            }
                        }
                    ]
                });


            }
        </script>
    </body>
</html> 

