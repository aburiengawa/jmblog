<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
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
                            var newComment = $('<div class="media"><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4><input class="comment-id" type="hidden" name="id" value='+response+'><div class="comment-body">'+body+'</div>{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value='+response+'><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::textarea("body",null,["class"=>"reply-textarea form-control","rows"=>2, "required"])!!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply",["class"=>"send-reply btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span><span class="delete-comment"><a href="#void"><small>DELETE</small></a></span></div>{!! Form::close() !!}</div></div>');
                            $("#comments-replies-container").prepend(newComment);                          
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
        $('#comments-replies-container').on('click', '.send-reply', function(e){
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
                            var marginClass = '';
                            if (!$this.parent().parent().hasClass('ml-5')){
                                marginClass = ' ml-5';
                            }
                            $(".reply-textarea").val('');  
<<<<<<< HEAD
                            var newReply = $('<div class="media'+marginClass+'"><input class="comment-id-delete" type="hidden" value='+comment_id+'><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4><input class="reply-id" type="hidden" name="id" value='+response+'><div class="comment-body">'+body+'</div>{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value="'+comment_id+'"><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::label("body", "Content:") !!}{!! Form::textarea("body", null, ["class"=>"reply-textarea form-control", "rows" => 2, "required"]) !!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply", ["class"=>"send-reply btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span><span class="delete-reply"><a href="#void"><small>DELETE</small></a></span></div>{!! Form::close() !!}</div></div>');
=======
                            var newReply = $('<div class="media ml-5"><input class="comment-id-delete" type="hidden" value='+comment_id+'><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4><input class="reply-id" type="hidden" name="id" value='+response+'><div class="comment-body">'+body+'</div>{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value="'+comment_id+'"><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::textarea("body", null, ["class"=>"reply-textarea form-control", "rows" => 2, "required"]) !!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply", ["class"=>"send-reply btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span><span class="delete-reply"><a href="#void"><small>DELETE</small></a></span></div>{!! Form::close() !!}</div></div>');
>>>>>>> master
                            $this.after(newReply);                              
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
        // $('#comments-replies-container').on('click', '.delete-comment', function(e){
        //     e.preventDefault();
        //     $(this).off('click');
        //     var token = $('input[name=_token]').val();
        //     var id = $(this).parents().eq(2).find('.comment-id').val();
        //     var comment_id = $(this).parent().eq(3).find('.comment-id-delete').val();            
        //     $.ajax({
        //         url: '../post-comment/delete',
        //         type: "DELETE",
        //         data: {_token: token, id: id},
        //         success: function (response) {
        //             alert("Success. Id is: "+response);                             
        //         }
        //     });               
        //     $('.comment-id-delete[value="'+comment_id+'"]').parent().remove();         
        //     $(this).parents().eq(3).remove();
        // });
        // $('#comments-replies-container').on('click', '.delete-reply', function(e){
        //     e.preventDefault();
        //     $(this).off('click');
        //     var token = $('input[name=_token]').val();
        //     var id = $(this).parents().eq(2).find('.reply-id').val();
        //     $.ajax({
        //         url: '../post-reply/delete',
        //         type: "DELETE",
        //         data: {_token: token, id: id},
        //         success: function (response) {
        //             alert("Success. Id is: "+response);                             
        //         }
        //     });
        //     $(this).parents().eq(3).remove();
        // });
    });
</script>