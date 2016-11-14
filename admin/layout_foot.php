	</div>
	<!-- /container -->

<!-- jQuery library -->
<script src="<?php echo $home_url; ?>libs/js/jquery.js"></script>

<!-- our custom JavaScript -->
<script src="<?php echo $home_url; ?>libs/js/custom-script.js"></script>

<!-- jQuery UI JavaScript -->
<script src="<?php echo $home_url; ?>libs/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
	
<!-- Bootstrap JavaScript -->
<script src="<?php echo $home_url; ?>libs/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $home_url; ?>libs/js/bootstrap/docs-assets/js/holder.js"></script>

<script>
// jQuery codes
$(document).ready(function(){
	
	// date picker
	$( "#active-until" ).datepicker({ dateFormat: 'yy-mm-dd' });
	
	// change order status
	$('input[type=radio][name=status]').change(function() {
		// get the transaction id
		var transaction_id=$(this).attr('transaction-id');
		
		// post the change status request to change_order_status.php file
		// post variable include transaction_id and status
		$.post("change_order_status.php", {
			transaction_id: transaction_id,
			status: this.value
		}, function(data){
			
			// view the response in the log
			console.log(data);
			
			// tell the user order status was changed
			alert('Order status was changed.');
			
		}).fail(function() {
			
			// in case posting the request failed, tell the user
			alert('Unable to change order status.');
			
		});
	});
	
	// click listener for all delete buttons
	$(document).on('click', '.delete-object', function(){

		// current button
		var current_element=$(this);
		
		// id of record to be deleted
		var id = $(this).attr('delete-id');
		
		// php file used for deletion
		var delete_file = $(this).attr('delete-file');
		
		// confirmation pop up before deleting a record
		var q = confirm("Record will be deleted.");
		
		// if the user clicked ok
		if (q == true){

			// post the request to specified delete file
			$.post(delete_file, {
				object_id: id
			}, function(data){
				
				// show the response to the console
				console.log(data);
				
				// if deleting product image or pdf
				if(delete_file=='delete_image.php'){
					current_element.parent().hide();
				}
				
				// if deleting product, category, user, etc.
				else{
					document.location.href = document.URL;
				}
				
			}).fail(function() {
				alert('Object was deleted!');
				document.location.href = document.URL;
			});
		}
			
		return false;
	});
	
	// for browsing and uploading multiple images
	$('.new-btn').bind("click" , function () {
		$('#html-btn').click();
	});
	
	// register and edit profile submit form catch, used to tell user if password is strong enough or not
	$('#create-user, #update-user').submit(function(){
			
		
		if($('#passwordInput').val()!=""){
			var password_strenght=$('#passwordStrength').text();
			if(password_strenght!='Good Password!'){
				alert('Password not strong enough');
				return false
			}
		}
		return true;
	});
	
});


</script>

<!-- rich text editor for product description, etc. -->
<script type="text/javascript" src="<?php echo $home_url; ?>libs/js/yellow-text-master/dist/yellow-text.min.js"></script>
<script type="text/javascript">
$(function() {
	// make the rich text editor plugin work
	$('.js-textarea').YellowText({
		defaultFont: 'Arial'
	});
});
</script>
	
<!-- end the HTML page -->
</body>
</html>