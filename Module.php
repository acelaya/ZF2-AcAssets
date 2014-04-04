<?php
namespace AcAssets;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * 
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
        		__DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, "setAssets"));
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, "setAssets"));
    }
    
    /**
     * Reads assets from configuration and injects them into view by using view helpers
     */
    public function setAssets(MvcEvent $e) {
    	$headScript     = $e->getApplication()->getServiceManager()->get("viewhelpermanager")->get('headscript');
    	$inlineScript   = $e->getApplication()->getServiceManager()->get("viewhelpermanager")->get('inlinescript');
    	$headLink       = $e->getApplication()->getServiceManager()->get("viewhelpermanager")->get('headlink');
    	$config         = $e->getApplication()->getServiceManager()->get("Config");
    
    	if (!isset($config["assets"])) return;
    	$assets = $config["assets"];
    
    	// Set head links
    	if (isset($assets["css"]) && isset($assets["css"]["stylesheets"])) {
    		$cssPath = isset($assets["css"]["path"]) ? $assets["css"]["path"] : "";
    		foreach ($assets["css"]["stylesheets"] as $css) {
    			if (isset($css["media"]))
    				$headLink->appendStylesheet($cssPath . "/" . $css["name"], $css["media"]);
    			else
    				$headLink->appendStylesheet($cssPath . "/" . $css["name"]);
    		}
    	}
    
    	// Set scripts
    	if (isset($assets["js"])) {
    		$jsPath = isset($assets["js"]["path"]) ? $assets["js"]["path"] : "";
    		// Set head scripts
    		if (isset($assets["js"]["head"])) {
    			foreach ($assets["js"]["head"] as $js) {
    				if (isset($js["options"]))
    					$headScript->appendFile($jsPath . "/" . $js["name"], "text/javascript", $js["options"]);
    				else
    					$headScript->appendFile($jsPath . "/" . $js["name"]);
    			}
    		}
    		// Set inline scripts
    		if (isset($assets["js"]["inline"])) {
    			foreach ($assets["js"]["inline"] as $js) {
    				if (isset($js["options"]))
    					$inlineScript->appendFile($jsPath . "/" . $js["name"], "text/javascript", $js["options"]);
    				else
    					$inlineScript->appendFile($jsPath . "/" . $js["name"]);
    			}
    		}
    	}
    }
    
}
