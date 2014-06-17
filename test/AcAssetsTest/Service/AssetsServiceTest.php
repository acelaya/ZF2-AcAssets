<?php
namespace AcAssetsTest\Service;

use AcAssets\Options\AssetsOptions;
use AcAssets\Service\AssetsService;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\HeadScript;
use Zend\View\Helper\InlineScript;

/**
 * Class AssetsServiceTest
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class AssetsServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AssetsService
     */
    private $assetsService;
    /**
     * @var AssetsOptions
     */
    private $options;
    /**
     * @var HeadScript
     */
    private $headScript;
    /**
     * @var InlineScript
     */
    private $inlineScript;
    /**
     * @var HeadLink
     */
    private $headLink;

    public function setUp()
    {
        $this->headScript       = new HeadScript();
        $this->inlineScript     = new InlineScript();
        $this->headLink         = new HeadLink();
        $this->options          = new AssetsOptions(include __DIR__ . '/../../assets.test.php');
        $this->assetsService    = new AssetsService(
            $this->headScript,
            $this->inlineScript,
            $this->headLink,
            $this->options
        );
    }

    public function testEmptyAssetsBeforInitialization()
    {
        $this->assertCount(0, $this->headScript);
        $this->assertCount(0, $this->inlineScript);
        $this->assertCount(0, $this->headLink);
    }

    public function testNumberOfAssetsAfterInitialization()
    {
        $this->init();
        $this->assertCount(4, $this->headLink);
        $this->assertCount(3, $this->inlineScript);
        $this->assertCount(2, $this->headScript);
    }

    private function init()
    {
        $this->assetsService->initInlineScript()
                            ->initHeadScript()
                            ->initHeadLink();
    }
}
