<?php defined('SYSPATH') OR die('No direct access allowed.');
    /**
     * Twig filesystem loader following the View file structure
     *
     * @package     Kotwig
     * @author      Kim Burgestrand
     * @license     
     */
    class Kotwig_Loader_View implements Twig_LoaderInterface
    {
        protected $_cache = array();
        
        /**
         * Given a name, get the source of the template
         * 
         * @param string The name of the template to load
         * @return string Template source code
         */
        public function getSource($name)
        {
            return file_get_contents($this->find($name));
        }
        
        /**
         * Gets the cache key to use for the cache for a given template name
         * 
         * @param string Name of template to load
         * @return string Cache key
         */
        public function getCacheKey($name)
        {
            return sha1($name);
        }
        
        /**
         * Returns true if the template is still fresh
         * 
         * @param string Template name
         * @param int Last modification time to compare against
         */
        public function isFresh($name, $time)
        {
            return filemtime($this->find($name)) < $time;
        }
        
        /**
         * Find a template file given a name
         * 
         * @param string
         * @return string
         */
        protected function find($name)
        {
            if (isset($this->_cache[$name]))
            {
                return $this->_cache[$name];
            }
            
            if (($file = Kohana::find_file('views', $name)) === FALSE)
            {
                throw new Kohana_View_Exception('Unable to find View :view', array(':view' => $name));
            }
            
            return $this->_cache[$name] = $file;
        }
    }
    
/* End of file view.php */
/* Location: ./classes/kotwig/twig/loader/view.php */ 