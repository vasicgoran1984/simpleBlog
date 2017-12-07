@extends('authentication.scheduleTop')

@section('comment-page')
    @if(\Auth::user())
        
        <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Comment</h3>
                            </div>
                            <!-- Login Form -->
                            <div class="panel-body">
                                <form id="add-new-comment" method="POST">
                                    <div class="alert alert-warning" style="display:none"></div>
               
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
                                        <input type="button" value="Save" onClick="addNewComments()" class="btn btn-primary pull-left login-user">
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
        
        function addNewComments() {
            
            var data = $("#add-new-comment").serialize();
            
            $.ajax({
                type: 'post',
                url: '{!! URL::route('addNewComment') !!}',
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