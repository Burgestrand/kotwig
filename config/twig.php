<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    // This is passed to the twig environment call
    return array(
        'cache'   => APPPATH . 'cache/twig',
        'charset' => Kohana::$charset,
        'auto_reload' => TRUE,
    );
    
/* End of file twig.php */
/* Location: ./config/twig.php */ 