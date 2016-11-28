<?
use ProductManager\Products;
use PortalManager\Template;

class home extends Controller{
		function __construct(){
			parent::__construct();
			parent::$pageTitle = '';

			$temp 			= new Template( VIEW . 'templates/' );

			$order = array(
				'by' => 'rand()',
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

			// Kiemelt termékek
			$arg = array(
				'order' 	=> $order,
				'limit' 	=> 6,
				'kiemelt' => true,
				'page' 		=> 1
			);
			$products = (new Products( array(
				'db' => $this->db,
				'user' => $this->User->get()
			) ))->prepareList( $arg );
			$this->out( 'products', 	$products );
			$this->out( 'product_list', $products->getList() );

			// Akciós termékek
			$arg = array(
				'order' 	=> $order,
				'limit' 	=> 3,
				'akcios' 	=> true,
				'page' 		=> 1
			);
			$discounted_products = (new Products( array(
				'db' => $this->db,
				'user' => $this->User->get()
			) ))->prepareList( $arg );
			$this->out( 'product_discount', $discounted_products );
			$this->out( 'product_discount_list', $discounted_products->getList() );

			$this->out( 'template', 	$temp );
			$this->out( 'slideshow', 	$this->Portal->getSlideshow( 'Home' ) );

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
