<?php

namespace app\modules\orders\models;

use app\modules\orders\classes\statuses\StatusGetter;
use Carbon\Carbon;
use Yii;

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
class Orders extends \yii\db\ActiveRecord
{   
    protected $modes = [
        0 => 'Manual',
        1 => 'Auto',
    ];

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

    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getServices()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }

    public function getStatusName()
    {   
        $statusGetter = new StatusGetter;
        return $statusGetter->getList()[$this->status];
    }

    public function getModeName()
    {   
        return $this->modes[$this->mode];
    }

    public function getHumanCreatedAt()
    {   
        return Carbon::createFromTimestamp($this->created_at)->format('Y-m-d H:i:s');
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