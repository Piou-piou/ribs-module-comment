<?php if ((($this->required_connection == 1) && (isset($_SESSION['idlogin'.CLEF_SITE]))) || ($this->required_connection == 0)):?>
	<form action="<?=WEBROOT?>controller/modules/comment/write_comment" method="post" class="row">
		<?php if (!isset($_SESSION['idlogin'.CLEF_SITE])):?>
			<input type="text" name="pseudo" placeholder="Your pseudo">
		<?php endif;?>
		<textarea name="comment" id="" cols="30" rows="10"></textarea>
		<button>Send</button>
		
		<input type="hidden" name="return_page" value="http://<?=$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]?>">
	</form>
<?php else: ?>
	<div class="row">
		<p>You must be connected to publish a comment</p>
	</div>
<?php endif;?>