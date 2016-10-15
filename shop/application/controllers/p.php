<?
use PortalManager\Pages;

class p extends Controller{
		function __construct(){
			parent::__construct();

			$page = new Pages( false, array( 'db' => $this->db ) );

			if ( $this->view->gets[1] != '' ) {
				$this->out( 'page', $page->get($this->view->gets[1]) );
				$parent = new Pages( false, array( 'db' => $this->db ) );
				$top_id = $page->getTopParentId( $this->view->page->getId() );
				$this->out( 'parent', $parent->get( $top_id ) );
				//$this->out( 'menu', $page->getTree( $this->view->page->getParentId() ) );
				$this->out( 'menu', $page->getTree( $top_id ) );
				$this->out( 'hassubmenuitems', $page->has_page());
			} else {
				Helper::reload('/');
			}

			// SEO Információk
			$this->out( 'bodyclass', 'pageview'. ( (!$this->view->hassubmenuitems) ? ' no-sidemenu' : '' ) );
			$SEO = null;
			// Site info
			$SEO .= $this->view->addMeta('description','');
			$SEO .= $this->view->addMeta('keywords','');
			$SEO .= $this->view->addMeta('revisit-after','3 days');

			// FB info
			$SEO .= $this->view->addOG('type','website');
			$SEO .= $this->view->addOG('url',DOMAIN);
			$SEO .= $this->view->addOG('image',DOMAIN.substr(IMG,1).'noimg.jpg');
			$SEO .= $this->view->addOG('site_name',TITLE);

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
