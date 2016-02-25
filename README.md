# Latte for PHPTransformers

[Latte](https://github.com/nette/latte) support for [PHPTransformers](http://github.com/phptransformers/phptransformer).

## Install

Via Composer

``` bash
$ composer require phptransformers/latte
```

## Usage

``` php
$engine = new LatteTransformer();
echo $engine->render('Hello, {$name}!', array('name' => 'phptransformers'));
```

## Testing

``` bash
$ phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.