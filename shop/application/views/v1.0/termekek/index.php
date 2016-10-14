<? if( $this->category->getName() ): ?>
    <div class="category-listing page-width">
        <? $this->render('templates/slideshow'); ?>
        <div class="divider"></div>
        <div class="list-view webshop-product-top">
            <? if($this->parent_menu&& count($this->parent_menu) > 0): ?>
            <div class="sub-categories">
                <div class="title">
                    <h3><? $subk = ''; foreach($this->parent_row as $sc) { $subk .= $sc.' / '; } echo rtrim($subk,' / '); ?> alkategóriái</h3>
                    <? if($this->parent_category): ?>
                    <a class="back" href="<?=$this->parent_category->getURL()?>"><i class="fa fa-arrow-left"></i> vissza: <?=$this->parent_category->getName()?></a>
                     <? endif; ?>
                </div>
                <?
                    foreach( $this->parent_menu as $cat ):
                ?><div class="item">
                    <div class="img"><a href="<?=$cat['link']?>"><img src="<?=rtrim(IMGDOMAIN,"/").$cat['kep']?>" alt="<?=$cat['neve']?>"></a></div>
                    <div class="title"><a href="<?=$cat['link']?>"><?=$cat['neve']?></a></div>
                </div><? endforeach; ?>
                <div class="divider"></div>
            </div>
            <? endif; ?>

            <div class="category-title head">
                 <div class="filters">
                    <form action="/<?=$this->gets[0]?>/<?=$this->gets[1]?>/-/1<?=( $this->cget != '' ) ? '?'.$this->cget : ''?>" method="get">
                    <ul>
                        <li><button class="btn btn-default btn-sm">szűrés <i class="fa fa-refresh"></i></button></li><li>
                            <select name="order" class="form-control">
                                <option value="nev_asc"     <?=($_GET['order'] == 'nev_asc')?'selected="selected"':''?>>Név: A-Z</option>
                                <option value="nev_desc"    <?=($_GET['order'] == 'nev_desc')?'selected="selected"':''?>>Név: Z-A</option>
                                <option value="ar_asc"      <?=($_GET['order'] == 'ar_asc')?'selected="selected"':''?>>Ár: növekvő</option>
                                <option value="ar_desc"     <?=($_GET['order'] == 'ar_desc')?'selected="selected"':''?>>Ár: csökkenő</option>
                            </select>
                        </li><li><?=__('Rendezés')?></li>
                    </ul>
                    </form>
                    <div class="clr"></div>
                </div>
                <h1><?=$this->category->getName()?></h1>
            </div>
            <div class="products">
                <? if( !$this->products->hasItems()): ?>
                <div class="no-product-items">
                    <div class="icon"><i class="fa fa-frown-o"></i></div>
                    <strong>Nincsenek termékek ebben a kategóriában!</strong><br>
                    Böngésszen további termékeink között.
                </div>
                <? else: ?>
                    <div class="grid-container">

                    <? /* foreach ( $this->product_list as $p ) {
                        $p['itemhash'] = hash( 'crc32', microtime() );
                        $p['sizefilter'] = ( count($this->products->getSelectedSizes()) > 0 ) ? true : false;
                        echo $this->template->get( 'product_list_item', $p );
                    }*/ ?>
                        <div class="items">
                            <? foreach ( $this->product_list as $p ) {
                                $p['itemhash'] = hash( 'crc32', microtime() );
                                $p['sizefilter'] = ( count($this->products->getSelectedSizes()) > 0 ) ? true : false;
                                $p = array_merge( $p, (array)$this );
                                echo $this->template->get( 'product_item', $p );
                            } ?>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <? /*$this->navigator*/ ?>
                <br>
                <? endif; ?>
            </div>
            <div class="divider"></div>

            <? if( $this->related && $this->related->hasItems() ): ?>
            <div class="related-products">
                <h3>A legnépszerűbb termékek</h3>
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

    </div>

    <script>
        $(function(){
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
        })
    </script>

<? else: ?>
    <?=$this->render('home')?>
<? endif; ?>
