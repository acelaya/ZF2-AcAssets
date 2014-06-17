<?php
namespace AcAssets\Service\Factory;

use AcAssets\Options\AssetsOptions;
use AcAssets\Service\AssetsService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AssetsServiceFactory
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class AssetsServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var AssetsOptions $options */
        $options        = $serviceLocator->get('AcAssets\Options\AssetsOptions');
        $headScript     = $serviceLocator->get("viewhelpermanager")->get('headscript');
        $inlineScript   = $serviceLocator->get("viewhelpermanager")->get('inlinescript');
        $headLink       = $serviceLocator->get("viewhelpermanager")->get('headlink');

        return new AssetsService($headScript, $inlineScript, $headLink, $options);
    }
}
