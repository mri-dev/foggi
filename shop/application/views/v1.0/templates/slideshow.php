<? if( count($this->slideshow ) > 0):?> 
	<div class="slideShow">
	<? foreach($this->slideshow as $ss): ?>
		<div>
			<? if($ss['url'] != ''): ?><a href="<?=$ss['url']?>"><? endif; ?>
	    	<img src="<?=$ss['kep']?>">
	        <? if($ss['url'] != ''): ?></a><? endif; ?>
	        <? if($ss['focim']): ?>
	        <div class="info-box">
	    		<div class="strip">
	    			<h2><?=$ss['focim']?></h2>
	    			<? if($ss['alcim']): ?>
	    			<h3><?=$ss['alcim']?></h3>
	    			<? endif; ?>
	    		</div>

	    	</div>
	    	<? endif; ?>
	    	<? if($ss['focim_link']): ?>
    		<div class="more-link"><a target="_blank" href="<?=$ss['focim_link']?> "><?=$ss['focim_link_text']?></a></div>
    		<? endif; ?>
		</div>
	<? endforeach; ?>
	</div>
<? endif; ?>
