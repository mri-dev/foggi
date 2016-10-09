<?
use ShopManager\Categories;
use ProductManager\Products;
use PortalManager\Template;

class home extends Controller{
		function __construct(){
			parent::__construct();
			parent::$pageTitle = '';

			$temp 			= new Template( VIEW . 'templates/' );
			$categories 	= new Categories( array( 'db' => $this->db ));

			$order = array(
				'by' => 'sorrend',
				'how' => 'ASC'
			);

			// Segítségnyújtás
			if (Post::on('side_contact_msg'))
			{
				try {
					$hashid = $_POST['side_contact_msg'];
					unset($_POST['side_contact_msg']);

					$this->Portal->sendMessageToDistributor( $hashid, $_POST);
					Helper::reload('/?m=Üzenetét sikeresen elküldtük a címzettnek.');

				} catch (Exception $e) {
					$this->view->gmsg = Helper::makeAlertMsg('pError', $e->getMessage());
				}
			}

			$arg = array(
				'filters' 	=> $filters,
				'meret' 	=> $_GET['meret'],
				'order' 	=> $order,
				'limit' 	=> 40,
				'kiemelt' 	=> true,
				'page' 		=> Helper::currentPageNum()
			);
			$products = (new Products( array(
				'db' => $this->db,
				'user' => $this->User->get()
			) ))->prepareList( $arg );

			$this->out( 'template', 	$temp );
			$this->out( 'products', 	$products );
			$this->out( 'product_list', $products->getList() );
			$this->out( 'slideshow', 	$this->Portal->getSlideshow( 'Home' ) );
			$this->out( 'categories', 	$categories->getTree( false, array( 'id_set' => array( 1, 5, 6, 7 ) ) ) );
			if(isset($_GET['m'])) {
				$this->out( 'gmsg', 		Helper::makeAlertMsg('pSuccess', $_GET['m']));
			}

			// SEO Információk
			$SEO = null;
			// Site info
			$this->out( 'bodyclass', 'homepage' );	
			$SEO .= $this->view->addMeta('description', $this->view->settings['page_description']);
			$SEO .= $this->view->addMeta('keywords','ajánló rendszer kód kedvezmény vásárlás ingyen');
			$SEO .= $this->view->addMeta('revisit-after','3 days');

			// FB info
			$SEO .= $this->view->addOG('type','website');
			$SEO .= $this->view->addOG('url', CURRENT_URI );
			$SEO .= $this->view->addOG('image', $this->view->settings['domain'].'/admin'.$this->view->settings['logo']);
			$SEO .= $this->view->addOG('site_name', $this->view->settings['page_title']);
			$this->view->SEOSERVICE = $SEO;
		}

		function __destruct(){
			// RENDER OUTPUT
				parent::bodyHead();					# HEADER
				$this->view->render(__CLASS__);		# CONTENT
				parent::__destruct();				# FOOTER
		}
	}

?>
