<?
  	////////////////////////////////////////
	// Domain név
	define('DM', 'foggi.mri-dev.com');
	define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/');
	define('MDOMAIN',$_SERVER['HTTP_HOST']);
	define('CLR_DOMAIN',str_replace(array("http://","www."),"",substr('www.'.DOMAIN,0,-1)));
	define('HOMEDOMAIN','http://'.DM.'/');
	// AJAX PATH's
	define('AJAX_GET','/ajax/get/');
	define('AJAX_POST','/ajax/post/');
	define('AJAX_BOX','/ajax/box/');

	////////////////////////////////////////
	// Ne módosítsa innen a beállításokat //
	date_default_timezone_set('Europe/Berlin');
	// PATH //
		define('FREE_SHIPPING_PRICE', 15000);

		define('TEMP','v1.0');

		define('PATH', realpath($_SERVER['HTTP_HOST']));

		define('APP_PATH','application/');

		define('LIBS',APP_PATH . 'libs/');

		define('MODEL',APP_PATH . 'models/');

		define('VIEW',APP_PATH . 'views/'.TEMP.'/');

		define('CONTROL',APP_PATH . 'controllers/');

		define('STYLE','/src/css/');
		define('SSTYLE','/public/'.TEMP.'/styles/');

		define('JS','/src/js/');
		define('SJS','/public/'.TEMP.'/js/');

		define('IMG','http://cp.'.DM.'/src/images/');

		define( 'FILE_BROWSER_IMAGE', JS.'tinymce/plugins/filemanager/dialog.php?type=1&lang=hu_HU');

	// Környezeti beállítások //

		define('SKEY','sdfew86f789w748rh4z8t48v97r4ft8drsx4');

		define('NOW',date('Y-m-d H:i:s'));

		define('PREV_PAGE',$_SERVER['HTTP_REFERER']);

		define('UPLOADS', 'src/uploads/');

		//define('RPDOCUMENTROOT', '/var/userdata/web/casada.hu/website/cp/src/uploaded_files');


	// Adminisztráció
		define('ADMROOT','http://www.cp.'.DM.'/');
		define('SOURCE', 'http://www.cp.'.DM.'/src/' );

	require "data.php";
?>
