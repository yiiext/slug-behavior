<?php
/**
 * \Slugable\Test\Components\Translit class file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Slugable\Test\Components;

use CComponent as Component;

/**
 * Class Translit
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class Translit extends Component
{
	public function translit($string)
	{
		return $string;
	}
}