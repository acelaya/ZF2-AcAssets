<?php
namespace AcAssets\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Handles assets options
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class AssetsOptions extends AbstractOptions {

    protected $css  = array();
    protected $js   = array();

    /**
     * @param array $css
     */
    public function setCss($css)
    {
        $this->css = $css;
    }
    /**
     * @return CssOptions
     */
    public function getCss()
    {
        if (is_array($this->css))
            $this->css = new CssOptions($this->css);

        return $this->css;
    }

    /**
     * @param array $js
     */
    public function setJs($js)
    {
        $this->js = $js;
    }
    /**
     * @return JsOptions
     */
    public function getJs()
    {
        if (is_array($this->js))
            $this->js = new JsOptions($this->js);

        return $this->js;
    }

} 