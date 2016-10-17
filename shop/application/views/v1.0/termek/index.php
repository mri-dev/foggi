<?
    $ar = $this->product['brutto_ar'];

    if( $this->product['akcios'] == '1' && $this->product['akcios_fogy_ar'] > 0)
    {
       $ar = $this->product['akcios_fogy_ar'];
    }
?>
<div class="product-view page-width">
    <? if($this->msg): ?>
    <br>
    <?=$this->msg?>
    <? endif; ?>
    <div class="main-view">
        <div class="images">

            <div class="main-img">
                <? if( $ar >= $this->settings['cetelem_min_product_price'] && $ar <= $this->settings['cetelem_max_product_price'] ): ?>
                    <img class="cetelem" src="<?=IMG?>cetelem_badge.png" alt="Cetelem Online Hitel">
                <? endif; ?>
                <div class="img-thb">
                    <span class="helper"></span>
                    <a href="<?=$this->product['profil_kep']?>" class="zoom"><img di="<?=$this->product['profil_kep']?>" src="<?=$this->product['profil_kep']?>" alt="<?=$this->product['nev']?>"></a>
                </div>
            </div>
            <div class="all">
                <?  foreach ( $this->product['images'] as $img ) { ?>
                <div class="img-auto-cuberatio__">
                    <img class="aw" i="<?=\PortalManager\Formater::productImage($img)?>" src="<?=\PortalManager\Formater::productImage($img, 150)?>" alt="<?=$this->product['nev']?>">
                </div>
                <? } ?>
            </div>
            <? if($this->product['links']): ?>
            <div class="links">
                <div class="divider"></div>
                <ul>
                    <? foreach( $this->product['links'] as $link ) : ?>
                    <li><a target="_blank" href="<?=$link['link']?>"><?=$link['title']?> <i class="fa fa-chevron-circle-right"></i></a></li>
                    <? endforeach; ?>
                </ul>
                <div class="clr"></div>
            </div>
         <? endif; ?>
        </div>
        <div class="data-view">
            <div class="cimkek">
            <? if($this->product['ujdonsag'] == '1'): ?>
                <img src="<?=IMG?>new_icon.png" title="Újdonság!" alt="Újdonság">
            <? endif; ?>
            </div>
            <h1><?=$this->product['nev']?></h1>
            <div class="cat"><?=$this->product['in_cat_names'][0]?></div>
            <div class="rack">
                <div class="grid-layout kpm">
                    <div class="grid-row grid-row-100">
                        <? if($this->product['garancia_honap']): ?>
                        <div class="garancia">
                            <img src="<?=IMG?>hu_gar.png" alt="<?=__('Garanciális idő')?>">
                            <div class="title"><?=__('Garanciális idő')?></div>
                            <div class="gar"><span class="year"><? $gh = $this->product['garancia_honap'] / 12;  ?>
                            <? if($gh < 1 ): ?>
                                <?=$this->product['garancia_honap']?> <?=__('hónap')?>
                            <? else: ?>
                                <?=$gh?> <?=__('év')?>
                            <? endif; ?></span> <?=__('EU garancia')?></div>
                        </div>
                    <? endif; ?>
                    </div>
                </div>
            </div>
            <div class="action-bar">
                <!--<a href="javascript:void(0);" jOpen="recall" jWidth="750" tid="<?=$this->product['ID']?>"><?=__('Telefonos szaktanácsadást kérek')?></a>-->
            </div>
            <?
            if( count($this->product['hasonlo_termek_ids']['colors']) > 1 ):
                $colorset = $this->product['hasonlo_termek_ids']['colors'];
                unset($colorset[$this->product['szin']]);
            ?>
            <div class="color-variants">
              <div class="clabel"><?=__('Színvariációk:')?></div>
              <? foreach ($colorset as $szin => $adat ) : ?>
              <div class="c">
                <div class="cwrap">
                  <a href="<?=$adat['link']?>">
                  <div class="img"><img src="<?=$adat['img']?>" alt=""></div>
                  <div class="text"><?=$szin?></div>
                  </a>
                </div>
              </div>
              <? endforeach; ?>
            </div>
            <? endif; ?>

            <div class="grid-layout kpm grid-np">
                <div class="grid-row grid-row-50">
                  <?
                  if( (int)$this->product['hasonlo_termek_ids']['colors'][$this->product['szin']]['sizes'] > 1 ):
                      $sizeset = $this->product['hasonlo_termek_ids']['colors'][$this->product['szin']]['size_set'];
                  ?>
                    <div class="size-selector dropdown-list-container">
                        <div class="dropdown-list-title"><span id="">Méret : <strong><?=$this->product['meret']?></strong></span> <i class="fa fa-angle-down"></i></div>
                        <div class="number-select dropdown-list-selecting overflowed">
                        <?
                        foreach ( $sizeset as $sizes ) { ?>
                        <div link="<?=$sizes['link']?>"><?=$sizes['size']?></div>
                        <? } ?>
                        </div>
                    </div>
                  <? endif; ?>
                </div>
                <div class="grid-row grid-row-50">
                  <div class="status">
                      <strong><?=$this->product['keszlet_info']?></strong>
                      <? if($this->product['show_stock'] == 1): ?><div class="in_stock">(<?=$this->product['raktar_keszlet']?> db készleten)</div><? endif; ?>
                  </div>
                </div>
            </div>
            <div id="cart-msg"></div>
            <div class="grid-layout">
                <div class="grid-row grid-row-50">
                    <div class="prices">
                        <div class="base">
                            <div class="price-head"><?=__('Ár')?>:</div>
                            <?  if( $this->product['akcios'] == '1' && $this->product['akcios_fogy_ar'] > 0):
                                $ar = $this->product['akcios_fogy_ar'];
                            ?>
                            <div class="old">
                                <div class="discount_percent">-<? echo 100-round($this->product['akcios_fogy_ar'] / ($this->product['brutto_ar'] / 100)); ?>%</div>
                                <div class="price"><strike><?=\PortalManager\Formater::cashFormat($this->product['ar'])?> <?=$this->valuta?></strike></div>
                            </div>
                            <? endif; ?>
                            <div class="current">
                                <?=\PortalManager\Formater::cashFormat($ar)?> <?=$this->valuta?>
                            </div>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="grid-row grid-row-50">
                    <div class="cart">
                        <div class="grid-layout">
                          <div class="current-variation grid-row grid-row-100">
                              <div class="title"><?=__('Szín')?>:</div>
                              <strong><?=$this->product['szin']?></strong>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-to-card">
                <input type="text" id="add_cart_num" style="display:none;" value="0" cart-count="<?=$this->product['ID']?>" />
                <div class="grid-layout grid-np">
                  <div class="grid-row grid-row-40">
                    <div class="item-count cart-btn dropdown-list-container">
                        <div class="dropdown-list-title"><span id="item-count-num">Mennyiség</span> <i class="fa fa-angle-down"></i></div>
                        <div class="number-select dropdown-list-selecting overflowed">
                            <?
                            $maxi = 10;
                            if( $this->product[raktar_keszlet] < $maxi ) $maxi = (int)$this->product[raktar_keszlet];

                            for ( $n = 1; $n <= $maxi; $n++ ) { if($n > 10) break; ?>
                            <div num="<?=$n?>"><?=$n?></div>
                            <? } ?>
                        </div>
                    </div>
                  </div>
                  <div class="grid-row grid-row-60">
                    <? if( $this->product['keszletID'] != $this->settings['flagkey_itemstatus_outofstock'] ): ?>
                    <button id="addtocart" cart-data="<?=$this->product['ID']?>" cart-remsg="cart-msg" title="Kosárba" class="tocart cart-btn"><?=__('kosárba teszem')?> <i class="fa fa-shopping-basket"></i></button>
                    <? endif; ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <div class="info">
      <div class="grid-layout">
        <div class="grid-row grid-row-40">
          <? if($this->product['parameters']): ?>
            <h3>Paraméterek</h3>
            <div class="parameters">
              <? foreach($this->product['parameters'] as $param): ?>
              <div class="grid-layout">
                <div class="grid-row grid-row-50"><?=$param['neve']?></div>
                <div class="grid-row grid-row-50 param-var"><?=$param['ertek']?> <?=$param['me']?></div>
              </div>
              <? endforeach; ?>
            </div>
          <? endif; ?>
        </div>
        <div class="grid-row grid-row-60">
          <h2>Termékleírás</h2>
          <div class="product-desc">
            <?=Product::rewriteImageTinyMCE($this->product['rovid_leiras'])?>
          </div>
        </div>
      </div>
    </div>

    <? if( $this->related && $this->related->hasItems() ): ?>
    <div class="related-products">
        <h3>Ajánlott termékeink</h3>
        <div class="items">
            <? foreach ( $this->related_list as $p ) {
                $p['itemhash'] = hash( 'crc32', microtime() );
                $p['sizefilter'] = ( count($this->related->getSelectedSizes()) > 0 ) ? true : false;
                $p = array_merge( $p, (array)$this);
                echo $this->template->get( 'product_list_ajanlott', $p );
            } ?>
            <div class="clr"></div>
        </div>
    </div>
    <? endif; ?>
</div>

<script type="text/javascript">
    $(function(){

        $('.cetelem-calc').cetelemCalculator();

        <? if( $_GET['buy'] == 'now'): ?>
        $('#add_cart_num').val(1);
        $('#addtocart').trigger('click');
        setTimeout( function(){ document.location.href='/kosar' }, 1000);
        <? endif; ?>
        $('.number-select > div[num]').click( function (){
            $('#add_cart_num').val($(this).attr('num'));
            $('#item-count-num').text($(this).attr('num')+' db');
        });
        $('.size-selector > .number-select > div[link]').click( function (){
            document.location.href = $(this).attr('link');
        });

        $('.product-view .images .all img').hover(function(){
            changeProfilImg( $(this).attr('i') );
        });

        $('.product-view .images .all img').bind("mouseleave",function(){
            //changeProfilImg($('.product-view .main-view a.zoom img').attr('di'));
        });

        $('.products > .grid-container > .item .colors-va li')
        .bind( 'mouseover', function(){
            var hash    = $(this).attr('hashkey');
            var mlink   = $('.products > .grid-container > .item').find('.item_'+hash+'_link');
            var mimg    = $('.products > .grid-container > .item').find('.item_'+hash+'_img');

            var url = $(this).find('a').attr('href');
            var img = $(this).find('img').attr('data-img');

            mimg.attr( 'src', img );
            mlink.attr( 'href', url );
        });

        $('.viewSwitcher > div').click(function(){
            var view = $(this).attr('view');

            $('.viewSwitcher > div').removeClass('active');
            $('.switcherView').removeClass('switch-view-active');

            $(this).addClass('active');
            $('.switcherView.view-'+view).addClass('switch-view-active');

        });

        $('.images .all').slick({
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 3
        });
    })

    function changeProfilImg(i){
        $('.product-view .main-img a.zoom img').attr('src',i);
        $('.product-view .main-img a.zoom').attr('href',i);
    }
</script>
