<?php
namespace AcAssets;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use AcAssets\Service\AssetsServiceInterface;

/**
 * 
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
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
        /* @var AssetsServiceInterface $assetsService */
        $assetsService = $e->getApplication()->getServiceManager()->get('AcAssets\Service\AssetsService');
        $assetsService->initHeadLink()
                      ->initHeadScript()
                      ->initInlineScript();
    }
    
}
