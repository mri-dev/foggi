<div class="history-view-list">
  <h3>Megtekintett termékek</h3>
  <div class="items">
    <? if(isset($this->history_product_list)){ foreach ( $this->history_product_list as $p ) {
        $p['itemhash'] = hash( 'crc32', microtime() );
        $p['sizefilter'] = ( count($this->history_products->getSelectedSizes()) > 0 ) ? true : false;
        $p = array_merge( $p, (array)$this );
        echo $this->templates->get( 'product-history-row', $p );
    } } ?>
  </div>
</div>
