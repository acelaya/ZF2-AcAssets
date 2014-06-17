<?php
namespace AcAssetsTest\Options;

use AcAssets\Options\AssetsOptions;

/**
 * Class AssetsOptionsTest
 * @author Alejandro Celaya Alastrué
 * @see http://www.alejandrocelaya.com
 */
class AssetsOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $config;
    /**
     * @var AssetsOptions
     */
    private $options;

    public function setUp()
    {
        $this->config = include __DIR__ . '/../../assets.test.php';
        $this->options = new AssetsOptions($this->config);
    }

    public function testPaths()
    {
        $this->assertEquals($this->config['js']['path'], $this->options->getJs()->getPath());
        $this->assertEquals($this->config['css']['path'], $this->options->getCss()->getPath());
    }

    public function testInnerOptionsAreParsed()
    {
        $this->assertInstanceOf('AcAssets\Options\CssOptions', $this->options->getCss());
        $this->assertInstanceOf('AcAssets\Options\JsOptions', $this->options->getJs());
    }

    public function testAssetsCount()
    {
        $this->assertCount(4, $this->options->getCss()->getStylesheets());
        $this->assertCount(3, $this->options->getJs()->getInline());
        $this->assertCount(2, $this->options->getJs()->getHead());
    }

    public function testAssetsArraysAreUnchanged()
    {
        $this->assertEquals($this->config['css']['stylesheets'], $this->options->getCss()->getStylesheets());
        $this->assertEquals($this->config['js']['inline'], $this->options->getJs()->getInline());
        $this->assertEquals($this->config['js']['head'], $this->options->getJs()->getHead());
    }
}
