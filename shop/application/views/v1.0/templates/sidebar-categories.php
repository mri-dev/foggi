<li class="title">Kategóriák</li>
<? while( $this->categories->walk() ): ?>
<? $cat = $this->categories->the_cat(); ?>
<li class="cat lvl-<?=$cat['deep']?>">
  <a href="<?=$cat['link']?>"><?=$cat['neve']?></a>
</li>
<? endwhile; ?>
