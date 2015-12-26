<?php

namespace MacFJA\PhpTransformer\Test\Latte;


use Latte\Engine;
use Latte\Loaders\FileLoader;
use \MacFJA\PhpTransformer\Latte\LatteTransformer;

class LatteTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $engine = new LatteTransformer();
        $this->assertEquals('latte', $engine->getName());
    }

    public function testRenderFile()
    {
        $engine = new LatteTransformer();

        $actual = $engine->renderFile('tests/Fixtures/template.latte', array('name' => 'Linus'));

        $this->assertEquals('Hello, Linus!', $actual);
    }

    public function testRender()
    {
        $engine = new LatteTransformer();

        $actual = $engine->render(
            file_get_contents('tests/Fixtures/template.latte'),
            array('name' => 'Linus')
        );

        $this->assertEquals('Hello, Linus!', $actual);
    }

    public function testConstructor()
    {
        $loader = new FileLoader();
        $latte = new Engine();
        $latte->setLoader($loader);

        $engine = new LatteTransformer(array('latte' => $latte));

        $actual = $engine->renderFile('tests/Fixtures/template.latte', array('name' => 'Linus'));

        $this->assertEquals('Hello, Linus!', $actual);
    }

    public function testTempDir()
    {
        $engine = new LatteTransformer(array('temp-dir' => sys_get_temp_dir()));

        $actual = $engine->renderFile('tests/Fixtures/template.latte', array('name' => 'Linus'));

        $this->assertEquals('Hello, Linus!', $actual);
    }
}
