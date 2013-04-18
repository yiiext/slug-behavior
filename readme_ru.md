Slug Behavior
===

[![Build Status](https://travis-ci.org/yiiext/slug-behavior.png?branch=master)](https://travis-ci.org/yiiext/slug-behavior)

Usage
-----

Импортируем класс, например, в config

```php
return array(
	'name' => 'My Web Application',

	// ...

	'import' => array(
   		'ext.slug-behavior.SlugBehavior',
    ),
);
```

Добавляем поведние нашей модели

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

Использование стороннего компонента для изменние slug, например, [Transliterator component](https://github.com/yiiext/transliterator-component):

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