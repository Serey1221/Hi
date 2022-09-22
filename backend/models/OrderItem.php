<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property int|null $color
 * @property int|null $qty
 * @property float|null $price
 * @property float|null $discount
 * @property float|null $total
 * @property int|null $size
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
            [['order_id', 'product_id', 'color', 'qty', 'size'], 'integer'],
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
            'color' => 'Color',
            'qty' => 'Qty',
            'price' => 'Price',
            'discount' => 'Discount',
            'total' => 'Total',
            'size' => 'Size',
        ];
    }

    public function getQty()
    {
        if ($this->qty > 1) {
            return 'X';
        } else {
            return '';
        }
    }

    public function getColor()
    {
        if ($this->color == 1) {
            return 'Blue';
        } else if ($this->color == 2) {
            return 'Red';
        } else if ($this->color == 3) {
            return 'Yellow';
        } else if ($this->color == 4) {
            return 'White';
        } else {
            return 'Black';
        }
    }
    public function getSize()
    {
        if ($this->size == 1) {
            return 'M';
        } else if ($this->size == 2) {
            return 'L';
        } else if ($this->size == 3) {
            return 'XL';
        } else {
            return 'XXL';
        }
    }
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
