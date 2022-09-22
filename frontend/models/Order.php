<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $customer_id
 * @property string|null $note
 * @property float|null $sub_total
 * @property float|null $discount
 * @property float|null $grand_total
 * @property int|null $status
 * @property string|null $created_date
 * @property int|null $created_by
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'status', 'created_by'], 'integer'],
            [['sub_total', 'discount', 'grand_total'], 'number'],
            [['created_date'], 'safe'],
            [['code'], 'string', 'max' => 25],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'customer_id' => 'Customer ID',
            'note' => 'Note',
            'sub_total' => 'Sub Total',
            'discount' => 'Discount',
            'grand_total' => 'Grand Total',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        ];
    }
}
