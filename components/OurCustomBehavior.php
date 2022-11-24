<?php

namespace app\components;

use Yii;
use yii\base\InvalidCallException;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

class OurCustomBehavior extends AttributeBehavior
{
	public string $createdByAttribute = 'created_by';
	public string $updatedByAttribute = 'updated_by';

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		parent::init();

		if (empty($this->attributes)) {
			$this->attributes = [
				BaseActiveRecord::EVENT_BEFORE_INSERT => $this->createdByAttribute,
				BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedByAttribute,
			];
		}
	}

	protected function getValue($event)
	{
		if ($this->value === null) {
			return Yii::$app->user->id;
		}

		return parent::getValue($event);
	}

	/* @var $owner BaseActiveRecord */
	public function touch($attribute)
	{
		$owner = $this->owner;
		if ($owner->getIsNewRecord()) {
			throw new InvalidCallException('Updating the timestamp is not possible on a new record.');
		}
		$owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
	}
}
