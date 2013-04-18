Slug Behavior
===

[![Build Status](https://secure.travis-ci.org/yiiext/slug-behavior.png?branch=master)](https://travis-ci.org/yiiext/slug-behavior)

Usage
-----

First, import class file, i.g in config

```php
return array(
	'name' => 'My Web Application',

	// ...

	'import' => array(
   		'ext.slug-behavior.SlugBehavior',
    ),
);
```

Next, attach behavior to model

```php
public function behaviors()
{
	return array(
		array(
			'class' => 'SlugBehavior',
		),
	);
}
```

Advanced slug, used translator closure, i.g. [Transliterator component](https://github.com/yiiext/transliterator-component):

```php
public function behaviors()
{
	return array(
		array(
			'class' => 'SlugBehavior',
			// @link https://github.com/yiiext/transliterator-component
			'translator' => array(Yii::app()->trasliterator, 'transliterate'),
		),
	);
}
```