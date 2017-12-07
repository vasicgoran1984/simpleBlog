@extends('authentication.scheduleTop')

@section('post-page')
    @if(\Auth::user())
        
        <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Post</h3>
                            </div>
                            <!-- Login Form -->
                            <div class="panel-body">
                                <form id="add-new-post" method="POST">
                                    <div class="alert alert-warning" style="display:none"></div>
                                    
                                    <input type="text" id="user_id" value="{{Auth::user()->id}}" style="display:none" name="user_id" class="form-control">
                                    
                                    <div class="form-group">
                                        <label>Title</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sticky-note"></i>
                                            </span>
                                            <input type="text" id="title" name="title" class="form-control" required placeholder="Title">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Text</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sticky-note"></i>
                                            </span>
                                            <textarea id="text" name="text" class="form-control" value="" required placeholder="Text"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group btn-toolbar">
                                        <input type="button" value="Save" onClick="addNewPosts()" class="btn btn-primary pull-left login-user">
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
        
        function addNewPosts() {
            
            var data = $("#add-new-post").serialize();
            
            $.ajax({
                type: 'post',
                url: '{!! URL::route('addNewPost') !!}',
                dataType: 'json',
                data:   data,
                success: function(data) {
                    if (data.status === true) {

                        $.notify("Save", "success");
                        setTimeout(function() {
                             window.location.href = data.relocate;
                        }, 500);
                        $(".alert-warning").hide();
                        
                    } else if (data.errors) {
                        var errors = "";

                        $.each(data, function (val, key) {

                            if (key.title !== undefined) {
                                errors += key.title + '<br>';
                            }
                            if (key.text !== undefined) {
                                errors += key.text + '<br>';
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