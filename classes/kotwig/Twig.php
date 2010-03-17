<?php defined('SYSPATH') OR die('No direct access allowed.');
    /**
     * Twig interface modeling View API
     *
     * @see         http://www.twig-project.org/
     * @package     Kotwig
     * @author      Kim Burgestrand
     * @license     
     */
    class Kotwig_Twig extends Kohana_View
    {
        protected $_twig;
        
        /**
         * Loads the View environment
         */
        public function __construct($file = NULL, array $data = NULL)
        {
            parent::__construct($file, $data);
            $this->_twig = new Twig_Environment(new Kotwig_Loader_View, Kohana::config('twig')->as_array());
        }
        
        /**
         * Extend to use my own class instead of View
         */
        public static function factory($file = NULL, array $data = NULL)
        {
            return new Twig($file, $data);
        }

        // This is such a hack
        public function set_filename($file)
        {
            parent::set_filename($file);
            $this->_file = $file;
            return $this;
        }
        
        public function render($file = NULL)
        {
            if ($file !== NULL)
            {
                $this->set_filename($file);
            }
            
            // Combine local and global data
            return $this->_twig
                        ->loadTemplate($this->_file)
                        ->render($this->_data + Kotwig_Twig::$_global_data);
        }
    }
    
/* End of file Twig.php */
/* Location: ./classes/kotwig/Twig.php */ 