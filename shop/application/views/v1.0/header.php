<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/html4"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml" lang="hu-HU" ng-app="casada">
<head>
    <title><?=$this->title?></title>
    <?=$this->addMeta('robots','index,folow')?>
    <?=$this->SEOSERVICE?>
    <meta property="fb:app_id" content="<?=$this->settings['FB_APP_ID']?>" />
    <? $this->render('meta'); ?>
</head>
<body>
<div ng-show="showed" ng-controller="popupReceiver" class="popupview" data-ng-init="init({'contentWidth': 1050, 'domain': '.mri-dev.com', 'receiverdomain' : '<?=POPUP_RECEIVER_URL?>', 'imageRoot' : '<?=POPUP_IMG_ROOT?>/'})"><ng-include src="'/<?=VIEW?>popupview.html'"></ng-include></div>
<? if(!empty($this->settings[google_analitics])): ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', ' <?=$this->settings[google_analitics]?>', 'auto');
  ga('send', 'pageview');
</script>
<? endif; ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<header>
	<div class="pw">
    <div class="topper">
  		<div class="grid-layout grid-np">
  			<div class="grid-row grid-row-70 left vra-middle"></div>
  			<div class="grid-row grid-row-30 center vra-top">
  				<div class="short-menu right hide-on-mobile">
  					<ul>
              <li><a href="#">Regisztráció</a></li>
              <li><a href="#">Bejelentkezés</a></li>
            </ul>
  				</div>
  			</div>
  		</div>
    </div>
    <div class="topper">
  		<div class="grid-layout grid-np">
  			<div class="grid-row grid-row-10 center vra-middle">
  				<div class="logo"><a href="<?=$this->settings['page_url']?>"><img src="<? echo IMG.'foggi_logo_wtext_pink.svg'; ?>" alt="<?=$this->settings['page_title']?>"></a></div>
  			</div>
  			<div class="grid-row grid-row-60 left vra-middle"><? $this->render('templates/casada_places_inheader'); ?></div>
  			<div class="grid-row grid-row-30 center vra-top">
  				<br><br>
  				<div class="short-menu right hide-on-mobile">
  					<ul>

  				</div>
  			</div>
  		</div>
    </div>
	</div>
</header>
<? echo $this->templates->get('floating_contact_msg', array_merge((array)$this)); ?>
<!-- Content View -->
<div class="website">
		<?=$this->gmsg?>
		<div class="general-sidebar">

			<ul class="menu">
				<li class="menu-item show-on-mobile">
					<div class="mobile-sharer">
						<? echo $this->render('templates/sharer'); ?>
					</div>
				</li>
				<li class="menu-item show-on-mobile"><a href="/"><i class="fa fa-arrow-left"></i> Webshop</a></li>
				<? foreach ( $this->menu_header->tree as $menu ): ?>
					<li class="menu-item <?=(strpos($menu['css_class'],'icons') !== false || $menu['kep']) ? 'has-icon':''?> <?=(strlen($menu['nev']) > 20)?'two-row':''?> <?=$menu['css_class']?>">
					<? if( $menu['tipus'] == 'template' ): ?>
						<? echo $this->templates->get($menu['data_value'], array_merge((array)$this)); ?>
					<? else: ?>
						<a href="<?=($menu['link']?:'')?>" style="<?=$menu['css_styles']?>">
							<? if(strpos($menu['css_class'],'icons') !== false): ?><span class="ic"><i class="dashicons dashicons-<?=trim(str_replace('icons','',$menu['css_class']))?>"></i></span><? endif; ?>
							<? if($menu['kep']): ?><span class="ic"><img src="<?=\PortalManager\Formater::sourceImg($menu['kep'])?>" alt="<?=$menu['nev']?>"></span><? endif; ?>
							<span class="text"><?=$menu['nev']?></span>
						</a>
					<? endif; ?>
					</li>
				<? endforeach; ?>
			</ul>
		</div>
		<div class="site-container <?=($this->gets[0]=='termek' || $this->gets[0]=='kosar' )?'productview':''?>">
			<div class="cart-float" id="mb-cart">
				<div mb-event="true" data-mb='{ "event": "toggleOnClick", "target" : "#mb-cart" }'><a href="/kosar" title="Tovább a kosárhoz"><img src="<?=IMG?>shopcart_white_30pxh.png" alt="<?=__('Kosár')?>"></a> <span class="cart-item-num-v">0</span></div>
				<div class="floating mobile-max-width">
					<div id="cartContent" class="overflowed">
						<div class="noItem"><div class="inf">A kosár üres</div></div>
					</div>
					<div class="totals">
						<table width="100%">
							<tbody>
								<tr>
									<td class="left"><strong>Összesen: </strong></td>
									<td class="right"><span id="cart-item-prices"></span> Ft</td>
								</tr>
								<tr>
									<td colspan="2" class="right">
										<a href="/kosar">Megrendelés</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<? $this->render( 'templates/sharer' ); ?>
			<? //$this->render( 'templates/casada_places' ); ?>
			<div class="clr"></div>
			<div class="inside-content">
