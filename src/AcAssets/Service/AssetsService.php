<?php
namespace AcAssets\Service;

use AcAssets\Options\AssetsOptions;
use Zend\Debug\Debug;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\HeadScript;
use Zend\View\Helper\InlineScript;

/**
 * Service class which injects configured assets into corresponding objects
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class AssetsService implements AssetsServiceInterface
{
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

    public function __construct(
        HeadScript $headScript,
        InlineScript $inlineScript,
        HeadLink $headLink,
        AssetsOptions $options
    ) {
        $this->headScript   = $headScript;
        $this->inlineScript = $inlineScript;
        $this->headLink     = $headLink;
        $this->options      = $options;
    }

    /**
     * Initializes the HeadScript element
     * @return $this
     */
    public function initHeadScript()
    {
        $javascripts = $this->orderByPriority($this->options->getJs()->getHead());
        foreach ($javascripts as $js) {
            $this->setJavascript($this->headScript, $js);
        }

        return $this;
    }
    /**
     * Initializes the InlineScript element
     * @return $this
     */
    public function initInlineScript()
    {
        $javascripts = $this->orderByPriority($this->options->getJs()->getInline());
        foreach ($javascripts as $js) {
            $this->setJavascript($this->inlineScript, $js);
        }

        return $this;
    }
    /**
     * Initializes the HeadLink element
     * @return $this
     */
    public function initHeadLink()
    {
        $cssPath = $this->options->getCss()->getPath();
        $stylesheets = $this->orderByPriority($this->options->getCss()->getStylesheets());
        foreach ($stylesheets as $css) {
            if (isset($css["media"])) {
                $this->headLink->appendStylesheet($cssPath . "/" . $css["name"], $css["media"], false, array());
            } else {
                $this->headLink->appendStylesheet($cssPath . "/" . $css["name"], 'screen', false, array());
            }
        }

        return $this;
    }

    /**
     * Sets a javascript asset into the HeadScript or InlineScript
     * @param HeadScript $element
     * @param array $js
     */
    private function setJavascript(HeadScript $element, array $js = array())
    {
        $jsPath = $this->options->getJs()->getPath();
        if (isset($js["options"])) {
            $element->appendFile($jsPath . "/" . $js["name"], "text/javascript", $js["options"]);
        } else {
            $element->appendFile($jsPath . "/" . $js["name"]);
        }
    }

    /**
     * Gets provided array and orders it by priority
     * @param array $elements
     * @return array
     */
    private function orderByPriority(array $elements)
    {
        // Drop keys from the elements array
        $elements = array_values($elements);
        $length = count($elements);
        for ($i = 0; $i < $length; $i++) {
            for ($j = $i; $j < $length; $j++) {
                $priorityFirst = isset($elements[$i]['priority']) ? (int) $elements[$i]['priority'] : 1;
                $prioritySecond = isset($elements[$j]['priority']) ? (int) $elements[$j]['priority'] : 1;

                if ($priorityFirst < $prioritySecond) {
                    $aux = $elements[$j];
                    $elements[$j] = $elements[$i];
                    $elements[$i] = $aux;
                }
            }
        }

        return $elements;
    }
}
