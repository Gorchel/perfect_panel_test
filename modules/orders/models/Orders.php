<?php

namespace orders\models;

use orders\classes\getters\ModeGetter;
use orders\classes\getters\StatusGetter;
use yii\db\ActiveRecord;
use Carbon\Carbon;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property string $link
 * @property int $quantity
 * @property int $service_id
 * @property int $status 0 - Pending, 1 - In progress, 2 - Completed, 3 - Canceled, 4 - Fail
 * @property int $created_at
 * @property int $mode 0 - Manual, 1 - Auto
 */
class Orders extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'link', 'quantity', 'service_id', 'status', 'created_at', 'mode'], 'required'],
            [['user_id', 'quantity', 'service_id', 'status', 'created_at', 'mode'], 'integer'],
            [['link'], 'string', 'max' => 300],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasOne(Services::class, ['id' => 'service_id']);
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return StatusGetter::getValue($this->status);
    }

    /**
     * @return string|null
     */
    public function getModeName()
    {
        $modes = ModeGetter::getModes();
        return isset($modes[$this->mode]) ? $modes[$this->mode]['key'] : null;
    }

    /**
     * @return string
     */
    public function getHumanCreatedAt()
    {
        return Carbon::createFromTimestamp($this->created_at)->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed|string
     */
    public function getUserFullName()
    {
        return !empty($this->users) ? $this->users->fullName : '';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'link' => 'Link',
            'quantity' => 'Quantity',
            'service_id' => 'Service ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'mode' => 'Mode',
        ];
    }
}
