Slug Behavior
===

Usage
-----

First, add namespace to Yii loader

```php
return array(
	'name' => 'My Web Application',

	// ...

	'aliases' => array(
   		'Slugable' => 'ext.slug-behavior',
    ),
);
```

Next, attach behavior to model

```php
public function behaviors()
{
	return array(
		array(
			'class' => '\Slugable\Slug',
		),
	);
}
```

Advanced slug, used translator closure, i.g. Transliterator component:

```php
public function behaviors()
{
	return array(
		array(
			'class' => '\Slugable\Slug',
			// @link https://github.com/yiiext/transliterator-component
			'translator' => array(Yii::app()->trasliterator, 'transliterate'),
		),
	);
}
```