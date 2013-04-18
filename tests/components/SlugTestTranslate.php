<?php
/**
 * SlugTestTranslate class file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Class SlugTestTranslate
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class SlugTestTranslate extends CComponent
{
	protected static $dictionary = array(
		'Проснувшись однажды утром' => 'Waking up one morning',
	);

	public function translate($string)
	{
		return str_replace(array_keys(self::$dictionary), array_values(self::$dictionary), $string);
	}
}