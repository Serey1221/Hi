<?php

use backend\models\Order;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-index">
    <div class="table-me mr-5 ml-5">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="card">
            <div class="card-body">

                <!-- <p>
            <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
        </p> -->
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
                        [
                            'attribute' => 'customer_id',
                            'value' => 'order.name'
                        ],
                        [
                            'attribute' => 'sub_total',
                            'format' => ['currency'],
                            'contentOptions' => [
                                'style' => 'width:100px;'
                            ]
                        ],
                        //'discount',
                        // 'grand_total',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getTypeTemp();
                            }
                        ],
                        [
                            'attribute' => 'created_date',
                            'value' => function ($model) {
                                return Yii::$app->formater->timeAgoKH($model->created_date);
                            }
                        ],
                        //'created_by',
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Order $model, $key, $index, $column) {
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