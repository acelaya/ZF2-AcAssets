<?php
namespace AcAssets\Options\Factory;

use AcAssets\Options\AssetsOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AssetsOptionsFactory
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class AssetsOptionsFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return new AssetsOptions(isset($config['assets']) ? $config['assets'] : array());
    }
}
