<?php
namespace AcAssets\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Handles CSS assets options
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class CssOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $path = '';
    /**
     * @var array
     */
    protected $stylesheets = array();

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param array $stylesheets
     */
    public function setStylesheets($stylesheets)
    {
        $this->stylesheets = $stylesheets;
    }
    /**
     * @return array
     */
    public function getStylesheets()
    {
        return $this->stylesheets;
    }
}
