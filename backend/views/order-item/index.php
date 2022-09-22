<?php

use backend\models\OrderItem;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-me mr-5 ml-5">
    <div class="order-item-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <!-- <p>
            <?= Html::a('Create Order Item', ['create'], ['class' => 'btn btn-success']) ?>
        </p> -->
        <div class="card">
            <div class="card-body">
                <?php echo $this->render('_search', ['model' => $searchModel, 'class' => 'form-control inp rounded-0']); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => [
                        'class' => 'table table-hover text-dark',
                        'cellspacing' => '0',
                        'width' => '100%',
                    ],
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last',
                        'class' => LinkPager::class,
                    ],
                    'layout' => "
                    <div class='table-responsive'>
                        {items}
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-md-6'>
                            {summary}
                        </div>
                        <div class='col-md-6'>
                            {pager}
                        </div>
                    </div>
                ",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'order_id',
                        [
                            'attribute' => 'product_id',
                            'value' => 'product.status'
                        ],
                        [
                            'attribute' => 'color',
                            'value' => function ($model) {
                                return $model->getColor();
                            }
                        ],
                        [
                            'attribute' => 'size',
                            'value' => function ($model) {
                                return $model->getSize();
                            }
                        ],
                        [
                            'attribute' => 'qty',
                            'value' => function ($model) {
                                if ($model->qty > 1) {
                                    return 'x' . $model->qty;
                                } else {
                                    return $model->qty;
                                }
                            }
                        ],
                        [
                            'attribute' => 'price',
                            'format' => ['currency'],
                            'contentOptions' => [
                                'style' => 'width:100px;'
                            ]
                        ],
                        [
                            'attribute' => 'total',
                            'format' => ['currency'],
                            'contentOptions' => [
                                'style' => 'width:100px;'
                            ]
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, OrderItem $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            },
                            'header' => 'action',
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>