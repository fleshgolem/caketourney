<div class="home">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2>OPSL Livestream</h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<?php Configure::load('caketourney_configuration');  ?>
<div class="PostBox"> 
	<div class="PostContentBlack">
		<div class="PostContentBox">
			<div class="Centerbox">
			<div class="PostMainContentbox">
			
				<object width="640" height="360">
					<param name="movie" value="<?php echo (Configure::read('Stream.livestream_url'));?>" />
					<param name="allowscriptaccess" value="always" />
					<param name="allowfullscreen" value="true" />
					<param name="wmode" value="transparent" />
					<embed src="<?php echo (Configure::read('Stream.livestream_url'));?>" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="640" height="360" wmode="transparent"></embed>
				</object><br/>
			</div>
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction"> <a href="<?php echo (Configure::read('Stream.vod_url'));?>"><?php echo (Configure::read('Stream.name'));?></a> </div>
		<p style="clear: both;">  </p>
	</div>
</div>



</div>