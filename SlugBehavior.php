<?php
/**
 * SlugBehavior class file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Class SlugBehavior
 *
 * @method CActiveRecord getOwner()
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 * @package yiiext/slug-behavior
 */
class SlugBehavior extends CBehavior
{
	/** @var string */
	public $sourceAttribute = 'title';
	/** @var string */
	public $slugAttribute = 'slug';
	/** @var bool */
	public $lowercase = true;
	/** @var string */
	public $delimiter = '-';
	/** @var int */
	public $length;
	/** @var array */
	public $replacements = array();
	/** @var callable */
	public $translator;
	/** @var array */
	public $scenarios = array('insert', 'update');

	public function events()
	{
		return array(
			'onBeforeValidate' => 'addSlugValidators',
		);
	}

	public function addSlugValidators()
	{
		$owner = $this->getOwner();

		if (in_array($owner->getScenario(), $this->scenarios)) {
			$list = $owner->getValidatorList();
			$list->add(CValidator::createValidator(
					'validateExistsSlug',
					$this,
					$this->slugAttribute
				));
		}
	}

	public function validateExistsSlug()
	{
		$owner = $this->getOwner();
		$title = $owner->getAttribute($this->sourceAttribute);
		$slug  = $owner->getAttribute($this->slugAttribute);
		$i = 1;

		if (!empty($title) && empty($slug))
		{
			$slug = $this->generateSlug($title);
			
			while ($this->filterBySlug($slug)->count()>0)
				$slug = $this->generateSlug($title) . '_' . $i++;

			$owner->setAttribute($this->slugAttribute, $slug);
		}
	}

	public function findBySlug($slug, $condition = '', array $params = array())
	{
		return $this->filterBySlug($slug)->find($condition, $params);
	}

	public function filterBySlug($slug, $operator = 'AND')
	{
		$owner = $this->getOwner();
		$column = $owner->getDbConnection()
			->quoteColumnName($owner->getTableAlias() . '.' . $this->slugAttribute);
		$owner->getDbCriteria()
			->addCondition($column . ' = :slug', $operator)
			->addCondition($owner->tableSchema->primaryKey . ' <> ' . $owner->primaryKey)
			->params[':slug'] = $slug;

		return $this->getOwner();
	}

	protected function generateSlug($string)
	{
		// Make sure string is in UTF-8 and strip invalid UTF-8 characters
		$string = mb_convert_encoding((string) $string, 'UTF-8', mb_list_encodings());

		// Make custom replacements
		$string = preg_replace(array_keys($this->replacements), $this->replacements, $string);

		if (is_callable($this->translator)) {
			$string = call_user_func($this->translator, $string);
		}

		// Replace non-alphanumeric characters with our delimiter
		$string = preg_replace('/[^\p{L}\p{Nd}]+/u', $this->delimiter, $string);

		// Remove duplicate delimiters
		$string = preg_replace('/(' . preg_quote($this->delimiter, '/') . '){2,}/', '$1', $string);

		if ((int) $this->length > 0) {
			$string = mb_substr($string, 0, $this->length, 'UTF-8');
		}

		// Remove delimiter from ends
		$string = trim($string, $this->delimiter);

		// Transform in lower-case
		if ($this->lowercase) {
			$string = mb_strtolower($string, 'UTF-8');
		}

		return $string;
	}
}
