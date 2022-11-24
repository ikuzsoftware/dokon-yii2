<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\components\OurCustomBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class BaseModel extends ActiveRecord
{
    const FIRMA_NAME = "TURDUXON ONA";
    const FIRMA_TYPE = "MCHJ";

	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_SAVED = 3;
	const CODE_ERROR = 403;
	const CODE_SUCCESS = 200;

	const USER_ROLE_TYPE_ROLE = 1;
	const USER_ROLE_TYPE_PERMISSION = 2;
	const USER_ROLE_TYPE_RULE = 3;

	const ACTION_TYPE_CREATE = 'CREATE';
	const ACTION_TYPE_UPDATE = 'UPDATE';

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			[
				'class' => OurCustomBehavior::class,
			],
			[
				'class' => TimestampBehavior::class,
			],
		];
	}

	/**
	 * @param $key
	 * @param bool $isReact
	 * @return array|mixed
	 */
	public static function getStatusList($key = null, $isReact = false)
	{
		$result = [
			self::STATUS_DELETED => Yii::t('app', 'Deleted'),
			self::STATUS_ACTIVE => Yii::t('app', 'Active'),
			self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
			self::STATUS_SAVED => Yii::t('app', 'Saved'),
		];
		if (!is_null($key)) {
			$result = $result[$key];
		}
		if ($isReact) {
			$data = [];
			foreach ($result as $index => $item) {
				$data[] = [
					'value' => $index,
					'label' => $item
				];
			}
			return $data;
		}
		return $result;
	}

    public function deleteModel()
    {
        $saved = true;
        $errors = [];
        $message = Yii::t('app', 'Data not deleted');
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->status = self::STATUS_DELETED;
            if ($this->save() === false) {
                $saved = false;
                $errors = $this->errors;
            }
            if ($saved) {
                $message = Yii::t('app', 'Data deleted');
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            $errors = $e->getMessage();
        }
        return [
            'status' => $saved,
            'errors' => $errors,
            'message' => $saved ? null : Yii::t('app', "Not deleted"),
        ];
    }

    public static function getStatusName($status = null)
    {
        $list = ['Deleted', 'Active', 'Inactive', 'Saved'];
        if (!is_null($status)) {
            return $list[$status];
        }
        return 0;
    }
    // dateTime format: Y-m-d H:i:s
    public static function getDateTime($dateTime = null)
    {
        if (is_null($dateTime)) {
            return null;
        }
        return date('d.m.Y', $dateTime);
    }

}
