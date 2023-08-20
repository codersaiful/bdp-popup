<?php 
namespace BDP_Popup\Admin;


use BDP_Popup\Core\Base;
use BDP_Popup\Admin\Page_Loader;
use BDP_Popup\Admin\Tracker;

class Admin_Loader extends Base{

    public static $inistance;
    public static function init()
    {
        if( is_null(self::$inistance) ){
            self::$inistance = new self;
        }
        
        return self::$inistance;
    }

    public function __construct(){
        Page_Loader::init();
        Tracker::init();
        // add_action('admin_init', [$this, 'admin_init']);
    }


    public function admin_init(){

        Tracker::init();
        
    }
}