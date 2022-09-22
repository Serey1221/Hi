<?php

use backend\models\Cart;
use yii\base\Model;
use frontend\models\User;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

$model = User::findOne(Yii::$app->user->id);

$base_url = Yii::getAlias("@web");


if (\Yii::$app->user->isGuest) {
  $totalCart = 0;
  // $totalCart = $totalCart->quantity;
} else {
  $userId = Yii::$app->user->id;
  $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
  $totalCart = $totalCart->quantity;
}
?>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
  <div class="container d-flex justify-content-between align-items-center">

    <a class="navbar-brand text-success logo h1 align-self-center" href="<?= Url::to(['/site']) ?>">
      Zay
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="templatemo_main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="align-self-center collapse navbar-collapse justify-content-lg-between" id="templatemo_main_nav">
      <div class="flex-fill">
        <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['/site']) ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['site/about']) ?>">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['site/add-cart']) ?>">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['site/contact']) ?>">Contact</a>
          </li>
        </ul>
      </div>
      <div class="navbar align-self-center d-flex">
        <a class="nav-icon d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
          <i class="fa fa-fw fa-search text-dark mr-2"></i>
        </a>
        <?php
        if (Yii::$app->user->isGuest) {
        ?>
          <a class="nav-icon position-relative text-decoration-none trigggerModal" value="<?= Url::to(['/site/login']) ?>" href="#">
            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
            <span id="cart-quantity" class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $totalCart ?></span>
          </a>
        <?php
        } else {
        ?>
          <a class="nav-icon position-relative text-decoration-none" href="<?= Url::to(['site/cart']) ?>">
            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
            <span id="cart-quantity" class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $totalCart ?></span>
          </a>
        <?php
        }
        ?>
        <?php
        if (Yii::$app->user->isGuest) {
        ?>
          <a style="cursor:poiter" value="<?= Url::to(['/site/login']) ?>" class="pl-3 trigggerModal">Login <i class="fas fa-sign-in-alt"></i></a>
          <span class="text-dark p-3 fw-bold">|</span>
          <a style="cursor:poiter" value="<?= Url::to(['/site/sign']) ?>" class="trigggerModal">SignUp<i class="fas fa-sign-up-alt"></i></a>

        <?php
        } else {
        ?>
          <?php $menuItems[] = ['label' => '',]; ?>
          <div class="btn-group pl-3">
            <div class="dropdown">
              <a class="dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle" src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>" style="width:40px;height:40px" alt="profile">
              </a>
              <div class=" dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item d-flex justify-content-between" href="<?= Url::to(['site/profile']) ?>">
                  <img class="rounded-circle mr-3" src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>" style="width:60px;height:60px;object-fit: cover;" alt="profile">
                  <div>
                    <span style="font-size:1.3rem" class="fw-bold"><?= Yii::$app->user->identity->username ?></span><br>
                    <span style="font-size:0.8rem" class="fw-bold"><?= Yii::$app->user->identity->email ?></span>
                  </div>
                </a>
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Cart</a>
                <a class="dropdown-item" href="#">New Order</a>
                <a class="dropdown-item" href="#">Payment</a>
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="<?php Url::to(['site/help']) ?>">Help</a>
                <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'dropdown-item']) ?>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>

  </div>
</nav>
<!-- Close Header -->