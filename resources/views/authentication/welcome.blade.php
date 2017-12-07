@extends('authentication.scheduleTop')

@section('home-page')
    @if(\Auth::user())
        <h2>Hello {{Auth::user()->first_name}}, you are logged in.</h2>
        
        @if(isset($profile->first_name))
   
        @else
        <h2>Please update profile.</h2>
        @endif
        
        
        @if(isset($allPosts))
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>TEXT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allPosts as $onePost)
                    <tr>
                        <td>{{$onePost->id}}</td>
                        <td>{{$onePost->title}}</td>
                        <td>{{$onePost->text}}</td>

                        <td><a onClick="editPost({{$onePost->id}})"  class="btn btn-warning">Change</a></td>
                        <td><a onClick="commentPost({{$onePost->id}})"  class="btn btn-success">Comment</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
    <div id="dialog-post"></div>
    <div id="dialog-comment"></div>
    
    <script>
        function editPost(id_post) {
            
            var id_post = (id_post) ? id_post : '';
              
            $.ajax({
                type: 'post',
                //dataType: 'json',
                url: '{!! URL::route('selectPost') !!}',
                data: 'id_post=' + id_post +
                  '&_token=' + '{!! csrf_token() !!}', 
                success: function(data) {
                    $("#dialog-post").html(data);
                }
            });
            /*
         * Open Dialog Vehicle--------------------------------------------------
         */
        
        $("#dialog-post").dialog({
            modal: true,
            width: 640,
                height: 420,
                title: 'Edit Post',
            close: function(){
                $(this).dialog("destroy").empty();
            },
            buttons: [
                {
                    text: 'Save',
                    click: function(data) {
                        
                        var data = $("#edit-post").serialize();
                       
                        $.ajax({
                            type: 'POST',
                            url: '{!! URL::route('editPost') !!}',
                            dataType: 'json',
                            data: data,
                            success: function(data) {
                               console.log(data);
                                if (data.status === true) {
                                    $("#dialog-post").dialog("close");
                                    setTimeout(function() {
                                        location.reload();
                                    }, 500);
                                    $.notify("Save", "success");
                                } else if (data.errors) {
                                    var errors = "";
                                    $.each(data, function (val, key) {});
                                    $("#dialog-post .alert-warning").show();
                                    $("#dialog-post .alert-warning").html(data.notification);
                                }
                            }
                        });
                                    
                    }
                },
                {
                    text: 'Close',
                    click: function(){
                        $("#dialog-post").dialog("close");
                        location.reload();
                    }
                }
            ]
        });
            
            
        }
    
        function commentPost(id_post) {
            var id_post = (id_post) ? id_post : '';
            
            $.ajax({
                type: 'post',
                //dataType: 'json',
                url: '{!! URL::route('selectPostForComment') !!}',
                data: 'id_post=' + id_post +
                  '&_token=' + '{!! csrf_token() !!}', 
                success: function(data) {
                    $("#dialog-comment").html(data);
                }
            });
            
            
            /*
         * Open Dialog Owner----------------------------------------------------
         */
        $("#dialog-comment").dialog({
            modal: true,
            width: 380,
            height: 440,
            title: 'Comment Post',
            close: function(){
                $(this).dialog('destroy').empty();
            },
            buttons: [
                {
                    text: 'Snimi',
                    click: function() {
                        var data = $("#dialog-comment #comment-post").serialize();
                        
                        $.ajax({
                            type: 'post',
                            url: '{!! URL::route('saveCommentedPost') !!}',
                            dataType: 'json',
                            data: data,
                            success: function(data) {
                                if (data.status === true) {
                                    $("#dialog-comment").dialog("close");
                                    setTimeout(function() {
                                        location.reload();
                                    }, 500);
                                    $.notify("Save", "success");
                                } else if (data.errors) {
                                    console.log();
                                    var errors = "";
                                    $.each(data, function (val, key) {
                                         if (key.posts_id !== undefined) {
                                                errors += key.posts_id + '<br>';
                                            }
                                            if (key.comments_id !== undefined) {
                                                errors += key.comments_id + '<br>';
                                            }
                                    });
                                    $("#dialog-comment .alert-warning").show();
                                    $("#dialog-comment .alert-warning").html(errors);
                                }
                            }
                        });
                        
                    }
                },
                {
                    text: 'Zatvori',
                    click: function() {
                        $("dialog-comment").dialog("close");
                        location.reload();
                    }
                }
            ]
        });
            
        }
    
    </script>
    
@endsection