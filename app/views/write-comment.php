<?php if ((($this->required_connection == 1) && (isset($_SESSION['idlogin'.CLEF_SITE]))) || ($this->required_connection == 0)):?>
	
	<form action="" class="row">
		<?php if (!isset($_SESSION['idlogin'.CLEF_SITE])):?>
			<input type="text" name="first_name" placeholder="First name">
			<input type="text" name="last_name" placeholder="Last name">
		<?php endif;?>
		<textarea name="comment" id="" cols="30" rows="10"></textarea>
		<button>Send</button>
	</form>

<?php else: ?>
	<div class="row">
		<p>You must be connected to publish a comment</p>
	</div>
<?php endif;?>