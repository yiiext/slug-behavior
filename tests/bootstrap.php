<?php
/**
 * Test bootstrap file.
 *
 * Note: Add yii to include path before test
 * e.g. you can run with param: phpunit --include-path path/to/YiiBase.php
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
require_once 'yiit.php';

// make sure non existing PHPUnit classes do not break with Yii autoloader
$basePath = dirname(__FILE__);
Yii::$enableIncludePath = false;
Yii::createWebApplication(
	array(
		'basePath' => $basePath,
		'extensionPath' => dirname(dirname($basePath)),
		'import' => array(
			'application.components.*',
			'application.models.*',
			'ext.slug-behavior.SlugBehavior',
		),
		'components' => array(
			'fixture' => array(
				'class' => 'system.test.CDbFixtureManager',
				'basePath' => $basePath . '/fixtures',
			),
			'db' => array(
				'connectionString' => 'sqlite:' . $basePath . '/data/testdrive.db',
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
			),
		),
	)
);
