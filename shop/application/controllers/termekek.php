<?
use ShopManager\Category;
use ShopManager\Categories;
use ProductManager\Products;
use PortalManager\Template;
use PortalManager\Pagination;

class termekek extends Controller {
		function __construct(){
			parent::__construct();
			$title = 'Termékek';

			// Template
			$temp = new Template( VIEW . 'templates/' );
			$this->out( 'template', $temp );

			// Kategória adatok
      $cat_id = Product::getTermekIDFromUrl();
			$cat = new Category($cat_id, array( 'db' => $this->db ));
      $this->out( 'top_category_id', $cat_id );
			$this->out( 'category', $cat );
      $this->out( 'current_cat_id', $cat_id );

			// Szülő kategória
			if($cat->getParentId())
			{
				$parent_cat = new Category($cat->getParentId(), array( 'db' => $this->db ));
				$this->out( 'parent_category', $parent_cat );
        $this->out( 'top_category_id', $cat->getParentId());
			}
			// Kategória szülő almenüi
			$categories = new Categories( array( 'db' => $this->db ) );

			$parent_id = $cat->getId();
			$parent_list = $categories->getChildCategories( $parent_id );
			$this->out( 'parent_menu', $parent_list );

			if ($parent_list) {
				$parent_row = array_reverse($categories->getCategoryParentRow( $cat->getId(), 'neve'));
				$this->out( 'parent_row', $parent_row );
			}

			// Szülők
			$parent_set = array_reverse( $categories->getCategoryParentRow( $cat->getId(), 'neve', 0 ) );

			$i = 0;
			foreach( $parent_set as $parent_i ) {
				$i++;

				$after = '';

				if( $i == 1 ) {
					$after = '';
				} else if( $i == 2 )  {
					$after = ' kategória';
				}

				$title = $parent_i.$after. ' | '.$title;
			}

			$cat_title = implode($parent_set, '<span class="sep">/</span>');

			// Termékek
			$filters = array();
			$order = array();

			if( $_GET['order']) {
				$xord = explode("_",$_GET['order']);
				$order['by'] 	= $xord[0];
				$order['how'] 	= $xord[1];
			}

			$arg = array(
				'filters' 	=> $filters,
				'in_cat' 	=> $cat->getId(),
				'meret' 	=> $_GET['meret'],
				'order' 	=> $order,
				'limit' 	=> 50,
				'page' 		=> Helper::currentPageNum()
			);
			$products = (new Products( array(
				'db' => $this->db,
				'user' => $this->User->get()
			) ))->prepareList( $arg );
			$this->out( 'products', $products );
			$this->out( 'product_list', $products->getList() );
			$this->out( 'category_title', $cat_title );


			$get = $_GET;
			unset($get['tag']);
			$get = http_build_query($get);
			$this->out( 'cget', $get );
			$this->out( 'navigator', (new Pagination(array(
				'class' => 'pagination pagination-sm center',
				'current' => $products->getCurrentPage(),
				'max' => $products->getMaxPage(),
				'root' => '/'.__CLASS__.'/'.$this->view->gets[1].($this->view->gets[2] ? '/'.$this->view->gets[2] : '/-'),
				'after' => ( $get ) ? '?'.$get : '',
				'item_limit' => 12
			)))->render() );

			$this->out( 'slideshow', 	$this->Portal->getSlideshow( $this->view->category->getName() ) );

			// Népszerű termékek
			$arg = array(
				'customorder' 	=> array(
					'by' 	=> 'popular',
					'how' 	=> 'DESC'
 				),
				'limit' 	=> 3
			);
			$related = (new Products( array(
				'db' => $this->db,
				'user' => $this->User->get()
			) ))->prepareList( $arg );
			$this->out( 'related', $related );
			$this->out( 'related_list', $related->getList() );


			// Log AV
			/* */
			$this->shop->logKategoriaView(
				Product::getTermekIDFromUrl()
			);
			/* */

			// SEO Információk
			$SEO = null;
			// Site info
			$SEO .= $this->view->addMeta('description', 'Minőségi '.strtolower($this->view->category->getName()) . ' a Casada Hungary Kft.-től. Őrizze meg egészségét!');
			$SEO .= $this->view->addMeta('keywords',$this->view->category->getName());
			$SEO .= $this->view->addMeta('revisit-after','3 days');

			// FB info
			$SEO .= $this->view->addOG('type','product.group');
			$SEO .= $this->view->addOG('url',substr(DOMAIN,0,-1).$_SERVER['REQUEST_URI']);
			$SEO .= $this->view->addOG('image',$this->view->settings['domain'].'/admin'.$this->view->category->getImage());
			$SEO .= $this->view->addOG('site_name', $this->view->settings['page_title']);

			$this->view->SEOSERVICE = $SEO;

			parent::$pageTitle = $title;
		}

		function __destruct(){
			// RENDER OUTPUT
				parent::bodyHead();					# HEADER
				$this->view->render(__CLASS__);		# CONTENT
				parent::__destruct();				# FOOTER
		}
	}

?>
