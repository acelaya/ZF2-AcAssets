<?php
namespace AcAssets\Service;

use AcAssets\Options\AssetsOptions;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\HeadScript;
use Zend\View\Helper\InlineScript;

/**
 * Service class which injects configured assets into corresponding objects
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class AssetsService implements AssetsServiceInterface {

    /**
     * @var HeadScript
     */
    private $headScript;
    /**
     * @var HeadLink
     */
    private $headLink;
    /**
     * @var InlineScript
     */
    private $inlineScript;
    /**
     * @var AssetsOptions
     */
    private $options;

    public function __construct(HeadScript $headScript, InlineScript $inlineScript, HeadLink $headLink, AssetsOptions $options) {
        $this->headScript   = $headScript;
        $this->inlineScript = $inlineScript;
        $this->headLink     = $headLink;
        $this->options      = $options;
    }

    public function initHeadScript()
    {
        // TODO: Implement initHeadScript() method.
    }

    public function initInlineScript()
    {
        // TODO: Implement initInlineScript() method.
    }

    public function initHeadLink()
    {
        // TODO: Implement initHeadLink() method.
    }

}