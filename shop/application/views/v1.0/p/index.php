<? if( $this->page->getId() ): ?>
<? if($this->page->getCoverImg() ): ?>
<div class="cover-img" style="background-image: url('<?=\PortalManager\Formater::sourceImg($this->page->getCoverImg())?>');"></div>
<? endif; ?>
<div class="page page-width <?=($this->page->getCoverImg()) ? 'covered-page':'' ?>">
    <? if($this->parent->getId() && $this->hassubmenuitems): ?>
    <div class="side-menu side-left">
        <ul>
            <li class="head"><?=$this->parent->getTitle()?> <i class="fa fa-angle-down"></i></li>
            <? while( $this->menu->walk() ): $menu = $this->menu->the_page(); ?>
            <li class="<?=($menu['eleres'] == $this->gets[1])?'active':''?> <?=($menu['menu_fej'] == 1)?'head':''?> deep<?=$menu['deep']?> <?=($menu['gyujto'] == '1') ? 'textonly':''?>">
                <? if($menu['gyujto'] == '0'): ?><a href="/p/<?=$menu['eleres']?>"><? endif; ?>
                    <?=$menu['cim']?>  <?=($menu['gyujto'] == '1') ? '<i class="fa fa-angle-down"></i>':''?>
                 <? if($menu['gyujto'] == '0'): ?></a><? endif; ?>
            </li>
            <? endwhile; ?>
        </ul>
    </div>
    <? endif; ?>
    <div class="responsive-view <?=(!$this->parent->getId())?'full-width':''?>">
        <div class="page-view">
            <?=$this->page_msg?>
            <? if( count($this->page->getImageSet()) > 0 ): ?>
            <div class="image-set">
                <? $s = 0; foreach( $this->page->getImageSet() as $img ): $s++; if ( $s == 1 ) { $ws = 650; } else { $ws = 250; } ?>
                <div class="img"><span class="helper"></span><a href="<?=\PortalManager\Formater::productImage($img)?>" rel="page-images" class="zoom"><img src="/render/thumbnail/?i=admin<?=$img?>&w=<?=$ws?>" alt=""></a></div>
                <? endforeach;?>
            </div>
            <? endif; ?>
            <div class="title"><h1><?=$this->page->getTitle()?></h1></div>
            <div class="content">
                <?=$this->page->textRewrites($this->page->getHtmlContent())?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var url_anchor = window.location.hash.substring( 1 );

        if( url_anchor != '' && typeof url_anchor !== 'undefined' ) {
            $('.product-feature-table .feature').addClass( 'bind-overlay' );

            $('.product-feature-table .feature.'+url_anchor).removeClass( 'bind-overlay' );
        }

    })
</script>
<? else: ?>
    <? $this->render( 'PageNotFound'); ?>
<? endif; ?>
