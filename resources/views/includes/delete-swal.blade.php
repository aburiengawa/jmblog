<script>
	$("#delete_form").submit(function(event) {
		var form = this;
		event.preventDefault();
		swal({
  			title: "You sure about this?",
  			text: "Once deleted, you'll never get it back.",
  			icon: "warning",
  			buttons: ["Take me back...", "Yup!"],
  			dangerMode: true,
		}).then((willDelete) => {
			if(willDelete) {
				swal({
					text: "Cool beans, we'll get rid of it then.",
					icon: "success",
					value: true,
				}).then((value) => {
					if(value) {form.submit();}
				});
			} else {
				swal("No worries, nothing was deleted.");
			}
		});
	});
</script>