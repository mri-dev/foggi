<? foreach ( $this->menu_header->tree as $menu ): ?>
  <li class="show-on-mobile menu-li menu-item<?=(strpos($menu['css_class'],'icons') !== false || $menu['kep']) ? ' has-icon':''?><?=(strlen($menu['nev']) > 50)?' two-row':''?> <?=$menu['css_class']?>">
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
<li class="title">Kategóriák</li>
<? while( $this->categories->walk() ): ?>
<? $cat = $this->categories->the_cat(); ?>
<li class="cat lvl-<?=$cat['deep']?><?=($this->current_cat_id == $cat['ID'])?' current':''?><?=($this->top_category_id && ($this->top_category_id == $cat['ID'] || $this->top_category_id == $cat['szulo_id']))?' active':''?>">
  <a href="<?=$cat['link']?>"><?=$cat['neve']?><?=$cat['parent_id']?></a>
</li>
<? endwhile; ?>
