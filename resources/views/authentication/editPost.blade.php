{!! Form::open(array('method'=>'post', 'id'=>'edit-post')) !!}

    <div class="alert alert-warning" style="display:none"></div>

    <input type="text" id="user_id" value="{{Auth::user()->id}}" style="display:none" name="user_id" class="form-control">
    
    <input type="text" id="post_id" value="<?php echo (isset($post->id) ? $post->id : ''); ?>"  style="display:none" name="post_id" class="form-control">
    
    <div class="form-group">
        <label>Title</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-sticky-note"></i>
            </span>
            <input type="text" id="title" name="title" value="<?php echo (isset($post->title) ? $post->title : ''); ?>" class="form-control" required placeholder="Title">
        </div>
    </div>

    <div class="form-group">
        <label>Text</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-sticky-note"></i>
            </span>
            <textarea id="text" name="text" class="form-control" required placeholder="Text"><?php echo (isset($post->text) ? $post->text : ''); ?></textarea>
        </div>
    </div>

{!! Form::Close() !!}
