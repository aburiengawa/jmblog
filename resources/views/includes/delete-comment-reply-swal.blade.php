<script>
$('#ajax-comment-container').on('click', '.delete-comment', function(e){
	e.preventDefault();
	$(this).off('click');
	swal({
		title: "You sure about this?",
		text: "Deleting this comment will also delete all its replies.",
		icon: "warning",
		buttons: ["No, take me back...", "Yup, I'm sure!"],
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			swal({
				text: "Cool beans, we'll get rid of it then.",
				icon: "success",
				value: true,
			}).then((value) => {
				if(value) {
		            var token = $('input[name=_token]').val();
		            var id = $(this).parents().eq(2).find('.comment-id').val();
		            var comment_id = $(this).parent().eq(3).find('.comment-id-delete').val();            
		            $.ajax({
		                url: '../post-comment/delete',
		                type: "DELETE",
		                data: {_token: token, id: id},
		                success: function (response) {
		                    // alert("Success. Id is: "+response);                             
		                }
		            });               
		            // alert('clicked');
		            $('.comment-id-delete[value="'+comment_id+'"]').parent().remove();         
		            $(this).parents().eq(3).remove();
				}
			});
		} else {
			swal("No worries, nothing was deleted.");
		}
	});
});	
$('#ajax-comment-container').on('click', '.delete-reply', function(e){
	e.preventDefault();
	$(this).off('click');
	swal({
		title: "You sure about this?",
		text: "Once deleted, it ain't comin' back.",
		icon: "warning",
		buttons: ["No, take me back...", "Yup, I'm sure!"],
		dangerMode: true,
	}).then((willDelete) => {
		if(willDelete) {
			swal({
				text: "Cool beans, we'll get rid of it then.",
				icon: "success",
				value: true,
			}).then((value) => {
				if(value) {
		            var token = $('input[name=_token]').val();
        			var id = $(this).parents().eq(2).find('.reply-id').val();
        			$.ajax({
	                url: '../post-reply/delete',
	                type: "DELETE",
	                data: {_token: token, id: id},
	                success: function (response) {
	                    // alert("Success. Id is: "+response);                             
	                }
		            });
		            $(this).parents().eq(3).remove();
				}
			});
		} else {
			swal("No worries, nothing was deleted.");
		}
	});
});
</script>