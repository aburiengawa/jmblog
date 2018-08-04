<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
//main comment form        
        $('.send-comment').on('click', function (e) {
            // Remove whitespace for validation
            var bodyContent = $(this).parent().parent().find('textarea[name=body]').val().trim();
            if (bodyContent.length !== 0) {
                $('.send-comment').off("click");
                $('#comment-form').submit(function (e) {
                    e.preventDefault();
                    var token = $('input[name=_token]').val();
                    var post_id = $('input[name=post_id]').val();
                    var username = $('input[name=username]').val();
                    var body = $('textarea[name=body]').val();
                    $.ajax({
                        url: '../comments/create',
                        type: "POST",
                        data: {_token: token, post_id: post_id, body: body},
                        success: function (response) {
                            $("#comment-textarea").val('');   
                            var newComment = $('<div class="media"><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4><input class="comment-id" type="hidden" name="id" value='+response+'><div class="comment-body">'+body+'</div>{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value='+response+'><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::textarea("body",null,["class"=>"reply-textarea form-control","rows"=>2, "required"])!!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY | OPTIONS</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply",["class"=>"send-reply-to-comment btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span><span class="delete-comment"><a href="#void"><small>DELETE</small></a></span></div>{!! Form::close() !!}</div></div>');
                            // Ensures first posted comment is visible when posted via ajax
                            if ($('article').find('.show-comment-button').length !== 0) {
                                $('#comments-replies-container').prepend(newComment);
                            } else {
                                $("#ajax-comment-container").prepend(newComment);
                            }               
                        }
                    });
                });
            } else {
                e.preventDefault();
                $('#comment-textarea').val('');
                var thisForm = $(this).parent().parent();
                // Forces HTML validation
                thisForm[0].reportValidity();
            }          
        });
//reply to comment        
        $('#ajax-comment-container').on('click', '.send-reply-to-comment', function(e){
            // Remove whitespace for validation
            var bodyContent = $(this).parent().parent().find('textarea[name=body]').val().trim();
            if (bodyContent.length !== 0) {
                $(this).parent().parent().submit(function (e) {
                    e.preventDefault();
                    $(this).off('submit');
                    var $this = $(this);
                    var token = $this.find('input[name=_token]').val();
                    var comment_id = $this.find('input[name=comment_id]').val();
                    var username = $this.find('input[name=username]').val();
                    var body = $this.find('textarea[name=body]').val();
                    $.ajax({
                        url: '../replies/create',
                        type: "POST",
                        data: {_token: token, comment_id: comment_id, body: body},
                        success: function (response) {
                            $(".reply-textarea").val('');  
                            var newReply = $('<div class="media ml-5"><input class="comment-id-delete" type="hidden" value='+comment_id+'><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4><input class="reply-id" type="hidden" name="id" value='+response+'><div class="comment-body">'+body+'</div>{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value="'+comment_id+'"><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::label("body", "Content:") !!}{!! Form::textarea("body", null, ["class"=>"reply-textarea form-control", "rows" => 2, "required"]) !!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY | OPTIONS</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply", ["class"=>"send-reply-to-reply btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span><span class="delete-reply"><a href="#void"><small>DELETE</small></a></span></div>{!! Form::close() !!}</div></div>');
                            $this.after(newReply);
                            // $this.parent().parent.after(newReply);                              
                        }
                    });
                });
            } else {
                e.preventDefault();
                $('.reply-textarea').val('');                
                var thisForm = $(this).parent().parent();
                //Forced HTML validation
                thisForm[0].reportValidity();
            }
        });
//reply to reply  
        $('#ajax-comment-container').on('click', '.send-reply-to-reply', function(e){
            // Remove whitespace for validation
            var bodyContent = $(this).parent().parent().find('textarea[name=body]').val().trim();
            if (bodyContent.length !== 0) {
                $(this).parent().parent().submit(function (e) {
                    e.preventDefault();
                    $(this).off('submit');
                    var $this = $(this);
                    var token = $this.find('input[name=_token]').val();
                    var comment_id = $this.find('input[name=comment_id]').val();
                    var username = $this.find('input[name=username]').val();
                    var body = $this.find('textarea[name=body]').val();
                    $.ajax({
                        url: '../replies/create',
                        type: "POST",
                        data: {_token: token, comment_id: comment_id, body: body},
                        success: function (response) {
                            // Adds ml-5 class if reply is under a comment, and none if under a reply. Keeps replies aligned.
                            $(".reply-textarea").val('');  
                            var newReply = $('<div class="media ml-5"><input class="comment-id-delete" type="hidden" value='+comment_id+'><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4><input class="reply-id" type="hidden" name="id" value='+response+'><div class="comment-body">'+body+'</div>{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value="'+comment_id+'"><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::label("body", "Content:") !!}{!! Form::textarea("body", null, ["class"=>"reply-textarea form-control", "rows" => 2, "required"]) !!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY | OPTIONS</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply", ["class"=>"send-reply-to-reply btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span><span class="delete-reply"><a href="#void"><small>DELETE</small></a></span></div>{!! Form::close() !!}</div></div>');
                            $this.parent().parent().after(newReply);
                            // $this.parent().parent.after(newReply);                              
                        }
                    });
                });
            } else {
                e.preventDefault();
                $('.reply-textarea').val('');                
                var thisForm = $(this).parent().parent();
                //Forced HTML validation
                thisForm[0].reportValidity();
            }
        });      
    });
</script>