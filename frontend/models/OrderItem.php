<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property int|null $unit_type_id
 * @property int|null $qty
 * @property float|null $price
 * @property float|null $discount
 * @property float|null $total
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'unit_type_id', 'qty'], 'integer'],
            [['price', 'discount', 'total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'unit_type_id' => 'Unit Type ID',
            'qty' => 'Qty',
            'price' => 'Price',
            'discount' => 'Discount',
            'total' => 'Total',
        ];
    }
}
