<?php
/**
 * SlugTestController class file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

use CDbTestCase as TestCase;

/**
 * Class DefaultController
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class SlugTestController extends TestCase
{
	public $fixtures = array(
		':post',
	);

	public function testSave()
	{
		$post = new SlugTestPost();
		$post->attributes = array(
			'title' => 'Lorem ipsum',
		);

		$this->assertTrue($post->save(), 'Assert model successeful saves.');
		$this->assertEquals($post->slug, 'lorem-ipsum', 'Check generating the default slug.');
	}

	public function testFind()
	{
		for ($i = 0; $i < 5; $i++) {
			$post = new SlugTestPost();
			$post->attributes = array(
				'title' => 'Post #' . $i,
			);
			$post->save();
		}
		$this->assertCount(5, SlugTestPost::model()->findAll(), 'Find all 5 models in DB.');

		$post = SlugTestPost::model()->findBySlug('post-2');
		$this->assertNotNull($post, 'Find model by slug.');
	}
}