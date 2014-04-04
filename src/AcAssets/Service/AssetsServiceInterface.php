<?php
namespace AcAssets\Service;

/**
 * Interface AssetsServiceInterface
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
interface AssetsServiceInterface {

    /**
     * Initializes the HeadScript element
     * @return $this
     */
    public function initHeadScript();

    /**
     * Initializes the InlineScript element
     * @return $this
     */
    public function initInlineScript();

    /**
     * Initializes the HeadLink element
     * @return $this
     */
    public function initHeadLink();

} 