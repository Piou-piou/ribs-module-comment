<form action="" class="row">
	<?php if (!isset($_SESSION['idlogin'.CLEF_SITE])):?>
		<input type="text" name="first_name" placeholder="First name">
		<input type="text" name="last_name" placeholder="Last name">
	<?php endif;?>
	<textarea name="comment" id="" cols="30" rows="10"></textarea>
	<button>Send</button>
</form>