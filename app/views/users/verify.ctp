<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2>Recover Password</h2>
 	</div> 
	
	<p style="clear: both;">  </p>  
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php if (isset($success)): ?>
					<div class="message">Access verified. Your new password has been emailed to you.</div>
					<p>A new password has been generated for your account and mailed to you. After you've logged in, you should change your password to something memorable via the account information page.</p>
				<?php else: ?>
					<div class="warning">Invalid token. This page has expired, or the link was not copied from your email client correctly.</div>
					<p>Make sure you have copied the entire link correctly, pasting it together if the link was split over two lines. If you're copying the link correctly and still can't get access, please contact us.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>