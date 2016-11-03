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
<body class="<?=$this->bodyclass?>">
<div id="systemmsg"></div>
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
  <div class="pw show-on-mobile mobile-header">
    <div class="menu-switcher" mb-event="true" data-mb='{ "event": "toggleOnClick", "target" : ".general-sidebar" }'><i class="fa fa-bars"></i></div>
    <div class="logo">
      <a href="<?=$this->settings['page_url']?>"><img src="<? echo IMG.'foggi_logo_wfoggitext_white_wobg.svg'; ?>" alt="<?=$this->settings['page_title']?>"></a>
    </div>
		<div class="cart" mb-event="true" data-mb='{ "event": "toggleOnClick", "target" : "#mb-cart" }'>
			<a href="/kosar"><i class="fa fa-shopping-cart "></i> <span class="cart-item-num-v">0</span></a>
		</div>
		<div class="ct"><a title="Kapcsolat" href="/p/kapcsolat"><i class="fa fa-phone"></i></a></div>
		<div class="acv"><a title="Ügyfélkapu" href="/user"><i class="fa fa-user"></i></a></div>
		<div class="clr"></div>
  </div>
	<div class="pw hide-on-mobile">
    <div class="topper">
  		<div class="grid-layout grid-np">
  			<div class="grid-row grid-row-20 left vra-bottom"></div>
  			<div class="grid-row grid-row-80 center vra-top">
  				<div class="short-menu right hide-on-mobile">
  					<ul>
              <? if(!$this->user): ?>
              <li class="reg"><a href="/user/regisztracio">Regisztráció</a></li>
              <? endif; ?>
              <li class="login"><? if($this->user): ?><a href="/user/"><i class="fa fa-user"></i> Belépve, mint <strong><?=$this->user['data']['nev']?></strong>!</a><? else: ?><a href="/user/belepes"><i class="fa fa-user"></i> Bejelentkezés</a><? endif; ?></li>
              <? if($this->user): ?>
              <li class="logout"><a href="/user/logout">Kijelentkezés <i class="fa fa-sign-out"></i></a></li>
              <? endif; ?>
            </ul>
  				</div>
  			</div>
  		</div>
    </div>
    <div class="main-elements">
  		<div class="grid-layout grid-np">
  			<div class="grid-row grid-row-25 center vra-bottom">
  				<div class="logo"><a href="<?=$this->settings['page_url']?>"><img src="<? echo IMG.'foggi_logo_wtext_pink.svg'; ?>" alt="<?=$this->settings['page_title']?>"></a></div>
  			</div>
  			<div class="grid-row grid-row-50 left vra-bottom">
          <div class="header-top-center">
            <? $this->render('templates/header_contact'); ?>
            <? $this->render('templates/search'); ?>
          </div>
        </div>
  			<div class="grid-row grid-row-35 center vra-bottom">
          <? $this->render( 'templates/cart-top' ); ?>
  			</div>
  		</div>
    </div>
	</div>
</header>
<div class="pw hide-on-mobile">
  <nav>
      <ul class="menu">
        <? foreach ( $this->menu_header->tree as $menu ): ?>
          <li class="menu-item<?=(strpos($menu['css_class'],'icons') !== false || $menu['kep']) ? ' has-icon':''?><?=(strlen($menu['nev']) > 50)?' two-row':''?> <?=$menu['css_class']?>">
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
  </nav>
</div>

<!-- Content View -->
<div class="website">
		<?=$this->gmsg?>
		<div class="general-sidebar">
			<ul class="cat-menu">
        <? $this->render( 'templates/sidebar-categories' ); ?>
        <? $this->render( 'templates/product-history' ); ?>
			</ul>
		</div>
		<div class="site-container <?=($this->gets[0]=='termek' || $this->gets[0]=='kosar' )?'productview':''?>">
			<? $this->render( 'templates/sharer' ); ?>
			<div class="clr"></div>
			<div class="inside-content">
