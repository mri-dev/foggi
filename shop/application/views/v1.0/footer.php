		</div> <!-- .inside-content -->
		<div class="clr"></div>
		</div><!-- #main -->
		<div class="clr"></div>
	</div><!-- website -->
	<footer>
		<div class="pw">
			<div class="grid-layout grid-np">
				<div class="grid-row grid-row-20">
					<div class="cont-info">
						<div class="logo">
							<img src="<?=IMG?>foggi_logo_pink.svg" alt="<?=$this->settings[page_title]?>" />
						</div>
						<div class="address">
							<?=$this->settings[page_author_address]?>
						</div>
						<div class="phone">
							<?=$this->settings[page_author_phone]?>
						</div>
						<div class="clr"></div>
					</div>
				</div>
				<div class="grid-row grid-row-50">
					<div class="cont">
						<ul class="menu">
						<? foreach ( $this->menu_footer->tree as $menu ): ?>
							<li>
								<? if($menu['link']): ?><a href="<?=($menu['link']?:'')?>"><? endif; ?>
									<span class="item <?=$menu['css_class']?>" style="<?=$menu['css_styles']?>">
										<? if($menu['kep']): ?><img src="<?=\PortalManager\Formater::sourceImg($menu['kep'])?>"><? endif; ?>
										<?=$menu['nev']?></span>
								<? if($menu['link']): ?></a><? endif; ?>
								<? if($menu['child']): ?>
									<? foreach ( $menu['child'] as $child ) { ?>
										<div class="item <?=$child['css_class']?>">
											<?
											// Inclue
											if(strpos( $child['nev'], '=' ) === 0 ): ?>
												<? echo $this->templates->get( str_replace('=','',$child['nev']), array( 'view' => $this ) ); ?>
											<? else: ?>
											<? if($child['link']): ?><a href="<?=$child['link']?>"><? endif; ?>
											<? if($child['kep']): ?><img src="<?=\PortalManager\Formater::sourceImg($child['kep'])?>"><? endif; ?>
											<span style="<?=$child['css_styles']?>"><?=$child['nev']?></span>
											<? if($child['link']): ?></a><? endif; ?>
											<? endif; ?>
										</div>
									<? } ?>
								<? endif; ?>
							</li>
						<? endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="grid-row grid-row-30">
					<? if(!empty($this->settings[social_facebook_link])):?>
					<div class="fb-page-title">
						Kövess minket Facebook oldalunkon!
					</div>
					<div class="fb-page" data-href="<?=$this->settings[social_facebook_link]?>" data-width="315" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?=$this->settings[social_facebook_link]?>"><a href="<?=$this->settings[social_facebook_link]?>"><?=$this->settings[page_title]?></a></blockquote></div></div>
					<div class="show-on-mobile center"> <a class="fb-link" target="_blank" href="<?=$this->settings[social_facebook_link]?>"> <i class="fa fa-facebook"></i> Facebook oldalunk</a></div>
					<? endif; ?>
				</div>
			</div>
		</div>
		<div class="copyright">
			<?=$this->settings[page_title]?> &copy; <?=date('Y')?> &mdash; Minden jog fenntartva!
		</div>
	</footer>
</body>
</html>
