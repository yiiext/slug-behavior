<?php
/**
 * SlugTestPost class file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Class SlugTestPost
 *
 * Attributes:
 * @property int $id
 * @property string $title
 * @property string $slug
 *
 * Core
 * @method SlugTestPost with()
 * @method SlugTestPost find()
 * @method SlugTestPost findByPk($pk)
 * @method SlugTestPost findBySlug($slug)
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class SlugTestPost extends CActiveRecord
{
	/**
	 * @param string $className
	 * @return SlugTestPost
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'post';
	}

	public function behaviors()
	{
		return array(
			'slugable' => array(
				'class' => 'SlugBehavior',
			),
		);
	}

	public function rules()
	{
		return array(
			array('title', 'required'),
		);
	}
}