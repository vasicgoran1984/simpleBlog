{!! Form::open(array('method'=>'post', 'id'=>'comment-post')) !!}

    <div class="alert alert-warning" style="display:none"></div>

    <input type="text" id="post_id"  style="display:none" value="<?php echo (isset($post->id) ? $post->id : ''); ?>" name="posts_id" class="form-control">
    
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
    
    <div class="form-comment">
        <div class="select-comment">
            {!! Form::Label('label-commentl', 'Comment') !!}<br/>
            <select class="comment-id" name="comments_id">
                <option value="">Select Comment</option>
                <?php if (isset($data['allComments'])) : ?>
                    <?php foreach ($data['allComments'] as $oneComment) : ?>
                        <option <?php  ?> value="{{ $oneComment->id }}">{{$oneComment->text}}</option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>

{!! Form::Close() !!}
