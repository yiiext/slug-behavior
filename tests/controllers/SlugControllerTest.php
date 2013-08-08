<?php
/**
 * SlugControllerTest class file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

Yii::import('system.test.CTestCase');
Yii::import('system.test.CDbTestCase');
Yii::import('system.test.CWebTestCase');

/**
 * Class SlugControllerTest
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class SlugControllerTest extends CDbTestCase
{
	public $fixtures = array(
		':post',
	);

	public function testSave()
	{
		$post = new SlugTestPost();
		$post->attributes = array(
			'title' => 'Lorem ipsum dolor?',
		);

		$this->assertTrue($post->save(), 'Assert model successeful saves.');
		$this->assertEquals($post->slug, 'lorem-ipsum-dolor', 'Check generating the default slug.');

		$post = new SlugTestPost();
		$post->title = 'Guidé Bail Coaliseront';
		$post->save();
		$this->assertEquals($post->slug, 'guidé-bail-coaliseront', 'Check generating the French slug.');

		$post = new SlugTestPost();
		$post->title = 'Υσυ αδ δισερε0.';
		$post->save();
		$this->assertEquals($post->slug, 'υσυ-αδ-δισερε0', 'Check generating the Greek slug.');

		$post = new SlugTestPost();
		$post->title = 'Проснувшись однажды утром';
		$post->save();
		$this->assertEquals($post->slug, 'проснувшись-однажды-утром', 'Check generating the Russian slug.');

		$post = new SlugTestPost();
		$post->slugable->replacements = array(
			'# (и|не|под|над) #i' => ' ',
			'# (однажды) #i' => ' ',
		);
		$post->title = 'Проснувшись однажды утром';
		$post->save();
		$this->assertEquals($post->slug, 'проснувшись-утром', 'Check replacing excess words in the slug.');

		$post = new SlugTestPost();
		$post->slugable->translator = array(new SlugTestTranslit(), 'translit');
		$post->title = 'Проснувшись однажды утром';
		$post->save();
		$this->assertEquals($post->slug, 'prosnuvshis-odnazhdy-utrom', 'Check transliting the slug.');

		$post = new SlugTestPost();
		$post->slugable->translator = array(new SlugTestTranslate(), 'translate');
		$post->title = 'Проснувшись однажды утром';
		$post->save();
		$this->assertEquals($post->slug, 'waking-up-one-morning', 'Check translating the slug.');
	}

	public function testFind()
	{
		foreach (array(
					'Lorem ipsum dolor.',
					'Проснувшись однажды утром',
					'Guidé Bail Coaliseront',
					'Υσυ αδ δισερε0.',
				 ) as $title) {
			$post = new SlugTestPost();
			$post->attributes = array(
				'title' => $title,
			);
			$post->save();

		}
		$this->assertCount(4, SlugTestPost::model()->findAll(), 'Find all 4 models in DB.');

		$post = SlugTestPost::model()->findBySlug('проснувшись-однажды-утром');
		$this->assertNotNull($post, 'Find model by slug.');
	}
}
