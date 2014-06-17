<?php
namespace AcAssets\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class JsOptions
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class JsOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $path = '';
    /**
     * @var array
     */
    protected $head = array();
    /**
     * @var array
     */
    protected $inline = array();

    /**
     * @param array $head
     */
    public function setHead($head)
    {
        $this->head = $head;
    }
    /**
     * @return array
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @param array $inline
     */
    public function setInline($inline)
    {
        $this->inline = $inline;
    }
    /**
     * @return array
     */
    public function getInline()
    {
        return $this->inline;
    }

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
}
