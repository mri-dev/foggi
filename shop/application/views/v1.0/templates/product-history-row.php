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
    <div class="image">
			<a href="<?=$link?>"><img class="aw" title="<?=$product_nev?>" src="<?=$profil_kep?>" alt="<?=$product_nev?>"></a>
		</div>
    <div class="info">
      <div class="title"><a href="<?=$link?>"><?=$product_nev?></a></div>
      <div class="def_cat"><?=$alap_kategoria?></div>
      <div class="action">
        <div class="price">
					<? $ar = $brutto_ar; ?>
					<?
					if( $akcios == '1' ):
					$ar = $akcios_fogy_ar;
					?>
					<div class="old"><?=Helper::cashFormat($brutto_ar)?> <?=$valuta?></div>
					<? endif; ?>
					<div class="current"><?=Helper::cashFormat($ar)?> <?=$valuta?></div>
				</div>
        <div class="cart">
          <button type="button" cart-data="<?=$product_id?>" cart-remsg="cart-msg"><i class="fa fa-shopping-basket"></i></button>
        </div>
      </div>
    </div>
    <div class="clr"></div>
  </div>
</div>
