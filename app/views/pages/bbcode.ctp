<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo'BBCode';?></h2>
	</div> 
   
	<p style="clear: both;">  </p>  
</div>
</div>



<div class="PostBox"> 
	<div class="PostContent">
			
		<div style="padding:20px 20px;">
			<?php $body = $this->Bbcode->doShortcode(strip_tags('
			[url]http://www.opsl.de[/url]
			[code][url]http://www.opsl.de[/url][/code]
			
			[qqqquote] [qqquote] [qquote] [quote]4 times quoted text[/quote]3 times quoted text[/qquote]2 times quoted text[/qqquote]quoted text[/qqqquote]
			[code][qqqquote] [qqquote] [qquote] [quote]4 times quoted text[/quote]3 times quoted text[/qquote]2 times quoted text[/qqquote]quoted text[/qqqquote][/code]
			
			[code]text without bbcode[/code]
			[code] [ code]text without bbcode[/ code] [/code]
			
			[i]cursive text[/i]
			[code][i]cursive text[/i][/code]
			
			[u]underline text[/u]
			[code][u]underline text[/u][/code]
			
			[b]big font text[/b]
			[code][b]big font text[/b][/code]
			
			[small]small text[/small]
			[code][small]small text[/small][/code]
			
			[large]large text[/large]
			[code][large]large text[/large][/code]
			
			[red]red text[/red]
			[code][red]red text[/red][/code]
			
			[green]green text[/green]
			[code][green]green text[/green][/code]
			
			[blue]blue text[/blue]
			[code][blue]blue text[/blue][/code]
			
			[yellow]yellow text[/yellow]
			[code][yellow]yellow text[/yellow][/code]
			
			[orange]orange text[/orange]
			[code][orange]orange text[/orange][/code]
			
			[Sans-Serif]Sans-Serif text[/Sans-Serif]
			[code][Sans-Serif]Sans-Serif text[/Sans-Serif][/code]
			
			[Times-New-Roman]Times-New-Roman text[/Times-New-Roman]
			[code][Times-New-Roman]Times-New-Roman text[/Times-New-Roman][/code]
			
			[Courier]Courier text[/Courier]
			[code][Courier]Courier text[/Courier][/code]
			
			[Comic-Sans]Comic-Sans text[/Comic-Sans]
			[code][Comic-Sans]Comic-Sans text[/Comic-Sans][/code]
			
			[img]img_division_1.png[/img]
			[code][img]img_division_1.png[/img] (only works with pictures in the webroot folder)[/code]
			
			[img width=120 height=50]img_division_1.png[/img]
			[code][img width=120 height=50]img_division_1.png[/img] (only works with pictures in the webroot folder)[/code]
			
'));
				echo ( $this->Text->autoLink($body));
				?>
		</div>	
		
		
		<p style="clear: both;">  </p>
		
	</div>
                            
	<div class="PostFooter">
    	
        
		<div class="bottomaction"> 
			
        </div>
        <div class="bottomaction"> 
				
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>


