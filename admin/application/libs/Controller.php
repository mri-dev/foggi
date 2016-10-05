<?	
use DatabaseManager\Database;

use PortalManager\AdminUser;
use PortalManager\Menus;
use PortalManager\Template;
use PortalManager\Users;
use ShopManager\Shop;
use PortalManager\News;
use PortalManager\Portal;
use PortalManager\CasadaShops;
use Applications\Captcha;
use FileManager\FileLister;
use ProductManager\Products;
use Wordpress\WPMigrator;
use Wordpress\GalleryHelper;


class Controller {
    public $db = null;
    public $hidePatern 	= true;
    private $theme_wire 	= '';
    private $theme_folder 	= '';
    private $start_time     = 0;
    private $finish_time    = 0;
    private $is_admin       = false;

    public static $pageTitle;
    public $fnTemp          = array();
    public static $user_opt = array();

    function __construct($arg = array()){
        $this->start_time = microtime(true);
        $this->is_admin = $arg[admin];
        Session::init();
        Helper::setMashineID();
        $this->gets 		= Helper::GET();

        //$this->memory_usage();

        // CORE
       // $this->model 		= new Model();
        $this->view 		= new View();
        $this->db           = new Database();
        //////////////////////////////////////////////////////
        $this->view->settings = $this->getAllValtozo();
        $this->gets 		= Helper::GET();
        $this->view->gets 	= $this->gets;

        $this->AdminUser    = new AdminUser( array( 'db' => $this->db, 'view' => $this->view, 'settings' => $this->view->settings )  );
        $this->wp           = new WPMigrator( array( 'db' => $this->db) );
        $this->User         = new Users(array( 
                                            'db' => $this->db, 
                                            'view' => $this->view, 
                                            'admin' => $this->is_admin
                                        ));
        $this->shop         = new Shop(array( 
                                        'db' => $this->db, 
                                        'view' => $this->view,
                                        'user' => $this->User->get()
                                    ));
		
        $this->Portal       = new Portal( array( 'db' => $this->db, 'view' => $this->view )  );
        $this->captcha      = (new Captcha)
                                ->init( 
                                    $this->view->settings['recaptcha_public_key'], 
                                    $this->view->settings['recaptcha_private_key'] 
                                );       

        $this->casadashops  = new CasadaShops( array( 'db' => $this->db ) );
        if( isset($_COOKIE['geo_latlng']) )
        {
            if($_GET['xx'] == 1)
            setcookie('geo_latlng','45.999136,18.642936',time()+3600,'/');

            $myPos = explode(",",$_COOKIE['geo_latlng']);
            $this->casadashops->setMyPosition($myPos);
        }
        
        $this->out( 'db',   $this->db );
        $this->out( 'casadashops', $this->casadashops );    
        $this->out( 'casadapillanatok', (new GalleryHelper('casadapillanatok', 'slug', array('db'=>$this->db, 'settings' => $this->view->settings))) );   
        $this->out( 'casadapartnerek',  (new GalleryHelper('partnerek', 'slug', array('db'=>$this->db, 'settings' => $this->view->settings))) );                                         
        $this->out( 'user', $this->User->get( self::$user_opt ) );
        $this->out( 'wp',   $this->wp );


        $templates          = new Template( VIEW . 'templates/' );     
        $this->out( 'templates', $templates );  

        $this->out( 'highlight_text', $this->Portal->getHighlightItems() ); 

        $lastnews_arg = array();
        $lastnews_arg['limit'] = 5;
        $this->out( 'last_news', (new News( false, array( 'db' => $this->db )  ))->getTree( $lastnews_arg ) );

        // Casada pillanatok
        if (file_exists('admin/src/uploads/esemenyek')) 
        {
            $pillanatok = new FileLister( 'admin/src/uploads/esemenyek' );
            $this->out( 'pillanatok', $pillanatok->getFolderItems( array( 'allowedExtension' => 'gif|png|jpg|jpeg|JPG' ) ) );
        }

        // Teljes termék
        $footer_products = new Products(array( 
            'db'    => $this->db,
            'user'  => $this->view->user
        ));
        $footer_products->prepareList(array(
            'filters' => array(
                'footer_listing' => array(1)
            )
        ));
        $this->out( 'footer_products', $footer_products->getList() );

        // Menük
        $tree = null;
        $menu_header  = new Menus( false, array( 'db' => $this->db ) );
        // Header menü
        $menu_header->addFilter( 'menu_type', 'header' );
        $menu_header->isFinal(true);
        $tree   = $menu_header->getTree();
        $this->out( 'menu_header',  $tree );

        // Footer menü
        $tree = null;
        $menu_footer  = new Menus( false, array( 'db' => $this->db ) );
        $menu_footer->addFilter( 'menu_type', 'footer' );
        $menu_footer->isFinal(true);
        $tree   = $menu_footer->getTree();
        $this->out( 'menu_footer',  $tree );

        unset($tree);

        // Kapcsolat menü üzenet
        if ( Post::on('contact_form') ) {
              try {
                $this->Portal->sendContactMsg();
                Helper::reload('?msgkey=page_msg&page_msg=Üzenetét sikeresen elküldte. Hamarosan válaszolni fogunk rá!');
              } catch (Exception $e) {
                $this->out( 'page_msg', Helper::makeAlertMsg('pError', $e->getMessage()) );
              }
        }

        if ( $_GET['msgkey'] ) {            
            $this->out( $_GET['msgkey'], Helper::makeAlertMsg('pSuccess', $_GET[$_GET['msgkey']]) );
        }

        $this->out( 'states', array(              
            0=>"Bács-Kiskun",
            1=>"Baranya",
            2=>"Békés",
            3=>"Borsod-Abaúj-Zemplén",
            4=>"Budapest",
            5=>"Csongrád",
            6=>"Fejér",
            7=>"Győr-Moson-Sopron",
            8=>"Hajdú-Bihar",
            9=>"Heves",
            10=>"Jász-Nagykun-Szolnok",
            11=>"Komárom-Esztergom",
            12=>"Nógrád",
            13=>"Pest",
            14=>"Somogy",
            15=>"Szabolcs-Szatmár-Bereg",
            16=>"Tolna",
            17=>"Vas",
            18=>"Veszprém",
            19=>"Zala",
        ) );
			
        if(!$arg[hidePatern]){ $this->hidePatern = false; }

         $this->view->valuta  = 'Ft';
    }

    function out( $viewKey, $output ){
        $this->view->$viewKey = $output;
    }

    function bodyHead($key = ''){
        $mode       = false;
        $subfolder  = '';

        $this->theme_wire   = ($key != '') ? $key : '';

        if($this->getThemeFolder() != ''){
            $mode       = true;
            $subfolder  = $this->getThemeFolder().'/';
        }

        # Oldal címe
        if(self::$pageTitle != null){
            $this->view->title = self::$pageTitle . ' | ' . $this->view->settings['page_title'];
        } else {
            $this->view->title = $this->view->settings['page_title'] . " &mdash; ".$this->view->settings['page_description'];
        }

        # Render HEADER
        if(!$this->hidePatern){
            $this->view->render($subfolder.$this->theme_wire.'header'.( (isset($_GET['header'])) ? '-'.$_GET['header'] : '' ),$mode);
        }

        # Aloldal átadása a VIEW-nek
        $this->view->called = $this->fnTemp;
    }

    

    function setTitle($title){
        $this->view->title = $title;
    }

    function valtozok($key){
        $d = $this->db->query("SELECT bErtek FROM beallitasok WHERE bKulcs = '$key'");
        $dt = $d->fetch(PDO::FETCH_ASSOC);

        return $dt[bErtek];
    }

    function getAllValtozo(){
        $v = array();
        $d = $this->db->query("SELECT bErtek, bKulcs FROM beallitasok");
        $dt = $d->fetchAll(PDO::FETCH_ASSOC);

        foreach($dt as $d){
            $v[$d[bKulcs]] = $d[bErtek];
        }

        $v['domain'] = 'http://'.str_replace( array('www.', 'http://'), '', $v['page_url']);

        if (strpos($v['alert_email'],",") !== false) 
        {
          $v['alert_email'] = explode(",",$v['alert_email']);
        }

        return $v;
    }
    
    function setValtozok($key,$val){
        $iq = "UPDATE beallitasok SET bErtek = '$val' WHERE bKulcs = '$key'";
        $this->db->query($iq);
    }

    protected function setThemeFolder($folder = ''){
        $this->theme_folder = $folder;
    }

    protected function getThemeFolder(){
        return $this->theme_folder;
    }

    public function memory_usage()
    {
       echo '-Memory: ',round(memory_get_usage()/1048576,2),' MB used-';
    }
    public function get_speed()
    {
       echo "-Operation Speed:", (number_format($this->finish_time - $this->start_time, 4))," sec-";
    }

    function __destruct(){
        $mode       = false;
        $subfolder  = '';

        if($this->getThemeFolder() != ''){
            $mode       = true;
            $subfolder  = $this->getThemeFolder().'/';
        }

        if(!$this->hidePatern){
            # Render FOOTER
            $this->view->render($subfolder.$this->theme_wire.'footer',$mode);
        }
        $this->db = null;         
       // $this->memory_usage();

        $this->finish_time = microtime(true);
        //$this->get_speed();
    }
}

?>