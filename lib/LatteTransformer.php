<?php

namespace PhpTransformers\Latte;

use Latte\Engine;
use Latte\Loaders\StringLoader;
use PhpTransformers\PhpTransformer\TransformerInterface;

/**
 * Class LatteTransformer.
 *
 * The PhpTransformer for Latte template engine.
 * {@link https://github.com/nette/latte/}
 *
 * @author  MacFJA
 * @package PhpTransformers\Latte
 * @license MIT
 */
class LatteTransformer implements TransformerInterface
{
    /** @var Engine */
    protected $latte;
    /** @var StringLoader */
    protected $stringLoader;

    /**
     * The transformer constructor.
     *
     * Options are:
     *   - "latte" a \Latte\Engine instance
     *   - "tmp-dir" the temporary directory where Latte will store compiled templates
     * if the option "latte" is provided, option "tmp-dir" is ignored.
     *
     * @param array $options The LatteTransformer options
     */
    public function __construct(array $options = array())
    {
        $this->stringLoader = new StringLoader();

        if (array_key_exists('latte', $options)) {
            $this->latte = $options['latte'];
        } else {
            $this->latte = new Engine();

            if (array_key_exists('temp-dir', $options)) {
                $this->latte->setTempDirectory($options['temp-dir']);
            }
        }
    }

    /**
     * Get the transformer name
     *
     * @return string
     */
    public function getName()
    {
        return 'latte';
    }

    /**
     * Render a file
     *
     * @param string $file The file to render
     * @param array $locals The variable to use in template
     * @return null|string
     */
    public function renderFile($file, array $locals = array())
    {
        return $this->latte->renderToString($file, $locals);
    }

    /**
     * Render a string
     *
     * @param string $template The template content to render
     * @param array $locals The variable to use in template
     * @return null|string
     */
    public function render($template, array $locals = array())
    {
        return $this->latte->setLoader($this->stringLoader)->renderToString($template, $locals);
    }
}
