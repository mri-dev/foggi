<div class="item">
	<div class="item-wrapper">
		<?
			$ar = $brutto_ar;
			if( $akcios == '1' ):
				$ar = $akcios_fogy_ar;
			endif;

			// Cashoff ár
			$dar = $ar-$user['data']['cash'];
			if( $dar < 0) $dar = 0;
		?>
		<? if( $akcios == '1' ): ?><div class="discount-percents">-<? echo 100-round($akcios_fogy_ar / ($brutto_ar / 100)); ?>%</div> <? endif; ?>
		<div class="image">
			<a href="<?=$link?>"><img class="aw" title="<?=$product_nev?>" src="<?=$profil_kep?>" alt="<?=$product_nev?>"></a>
		</div>
		<div class="info">
			<div class="title"><a href="<?=$link?>"><?=$product_nev?></a></div>
			<?
				$szinek = '';
				$color_count = count($hasonlo_termek_ids['colors']);
				foreach ($hasonlo_termek_ids['colors'] as $hszin => $sz) {
					$szinek .= $hszin.', ';
				}

				$szinek = rtrim($szinek, ', ');
			?>
			<div class="def_cat"><?=$alap_kategoria?><? if($color_count > 1): ?><span class="color-n" title="Színek: <?=$szinek?>"> &bull; <?=$color_count?> színvariáció</span><? endif; ?></div>
			<div class="sizes">
				<ul>
				<? foreach($hasonlo_termek_ids['colors'][$szin]['size_set'] as $meretek ): ?>
					<li class="<?=($meret == $meretek['size'])?'active':''?>"><a href="<?=$meretek['link']?>"><?=$meretek['size']?></a></li>
				<? endforeach; ?>
				</ul>
			</div>

			<div class="info-row-bottom">
				<div class="price">
					<? $ar = $brutto_ar; ?>
					<?
					if( $akcios == '1' ):
					$ar = $akcios_fogy_ar;
					?>
					<div class="old"><?=Helper::cashFormat($brutto_ar)?> <?=$valuta?> </div>
					<? endif; ?>
					<div class="current"><?=Helper::cashFormat($ar)?> <?=$valuta?></div>
				</div>
				<div class="cart">
					<button type="button" cart-data="<?=$product_id?>" cart-remsg="cart-msg">Kosárba <i class="fa fa-shopping-basket"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
