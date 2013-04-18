<?php
/**
 * Test bootstrap file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

$basePath = dirname(__FILE__);

/** @todo change the following paths if necessary */
if (file_exists($basePath . '/../yii/framework/yiit.php')) {
	require($basePath . '/../yii/framework/yiit.php');
} else {
	require($basePath . '/../../../../../frameworks/yii/framework/yiit.php');
}

// make sure non existing PHPUnit classes do not break with Yii autoloader
Yii::$enableIncludePath = false;
Yii::createWebApplication(
	array(
		'basePath' => $basePath,
		'extensionPath' => $basePath . '/../..',
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