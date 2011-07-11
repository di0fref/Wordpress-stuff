<div id="sidebar"> 
	<ul id="nav"> 
		<?php wp_list_pages("depth=1&title_li=");?> 
	</ul>
	<!--<div id="twitter" style="display:block;" class="has_icon">
		<div id="tweets">
		</div>
		<p><a href="http://twitter.com/di0fref">Follow on Twitter</a></p> 
	</div>--> 
	<div id="sidebar_ads">
		<div class="sponsors has_icon"><p class="sp_title">Sponsors</p></div>
		<div class='ads'>
			<?php getLiveCustomerLinks()?>
		</div>
		<div class='ads'>
			<?php tla_ads(); ?>
		</div>
	</div>
</div>

<div id="contact">
	<form>
		<table>
			<tr>
				<td valign="top">Name:</td><td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td valign="top">Email:</td><td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td valign="top">Message:</td><td><textarea name="message"></textarea></td>
			</tr>
			<tr>
				<td></td><td><input type="submit" name="send" value="Send"></td>
			</tr>
		</table>
	</form>	
</div>