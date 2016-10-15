<li class="title">Kategóriák</li>
<? while( $this->categories->walk() ): ?>
<? $cat = $this->categories->the_cat(); ?>
<li class="cat lvl-<?=$cat['deep']?><?=($this->current_cat_id == $cat['ID'])?' current':''?><?=($this->top_category_id && ($this->top_category_id == $cat['ID'] || $this->top_category_id == $cat['szulo_id']))?' active':''?>">
  <a href="<?=$cat['link']?>"><?=$cat['neve']?><?=$cat['parent_id']?></a>
</li>
<? endwhile; ?>
