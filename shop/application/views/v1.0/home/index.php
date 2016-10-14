<div class="home">
	<? $this->render('templates/slideshow'); ?>
	<? if( count($this->product_list) > 0): ?>
	<div class="webshop-product-top products">
		<div class="head">
			<h3 class="stitle"><?=__('Kiemelt termékek')?></h3>
			<div class="clr"></div>
		</div>
		<div class="items">
			<? foreach( $this->product_list as $item ): ?>
				<? echo $this->template->get('product_item', array_merge($item, (array)$this)); ?>
			<? endforeach; ?>
		</div>
	</div>
	<? endif; ?>
	<? if( count($this->product_discount_list) > 0): ?>
	<div class="webshop-product-discount products">
		<div class="head">
			<h3 class="stitle"><?=__('Akciós termékek')?></h3>
			<div class="clr"></div>
		</div>
		<div class="items">
			<? foreach( $this->product_list as $item ): ?>
				<? echo $this->template->get('product_item', array_merge($item, (array)$this)); ?>
			<? endforeach;?>
		</div>
	</div>
	<? endif; ?>

	<pre><? //print_r($this->product_list); ?></pre>
</div>
