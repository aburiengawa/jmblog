    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        $('.send-comment').on('click', function () {
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
                        var newComment = $('<div class="media"><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4>'+body+'{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value='+response+'><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!!Form::label("body","Content:") !!}{!! Form::textarea("body",null,["class"=>"reply-textarea form-control","rows"=>2])!!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply",["class"=>"send-reply btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span></div>{!! Form::close() !!}</div></div>');
                        $("#comments-replies-container").prepend(newComment);                          
                    }
                });
            });
        });
        $('#comments-replies-container').on('click', '.send-reply', function(){
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
                        var newReply = $('<div class="media ml-5"><div class="media-body"><h4 class="media-heading">'+username+'<small> Just now</small></h4>'+body+'{!! Form::open(["method"=>"POST", "class"=>"reply-form", "action"=>"AdminRepliesController@store"]) !!}<input type="hidden" name="comment_id" value="'+comment_id+'"><input type="hidden" name="username" value="{{Auth::user()->name}}"><div class="form-group hide-element">{!! Form::label("body", "Content:") !!}{!! Form::textarea("body", null, ["class"=>"reply-textarea form-control", "rows" => 2]) !!}</div><div class="form-group reply-link"><a href="#void"><small>REPLY</small></a></div><div class="form-group hide-element">{!! Form::submit("Post Reply", ["class"=>"send-reply btn btn-primary"]) !!}<span class="reply-hide"><a href="#void"><small>HIDE</small></a></span></div>{!! Form::close() !!}</div></div>');
                        $this.parent().parent().after(newReply);  
                        alert("Fired");                             
                    }
                });
            });
        });
    });