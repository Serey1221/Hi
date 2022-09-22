<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

$base_url = Yii::getAlias('@web');
?>
<script src="https://www.paypal.com/sdk/js?client-id=AbRk2q_sjpztKSLPgjJpKZDC8eXmUzk5LM8Lv61_E2wkjtMFuxuUmiJW3mNmQULgQ-of3k4ZmafKQsBB"></script>
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-7 col-md-7 col-sm-12 pt-5">
            <div class="loader">
            </div>
            <div class="loading">
                <h2 class="font-family: 'Montserrat', sans-serif;" class=" mb-5">CheckOut</h2>
                <p>Billing Information</p>
                <select style="height:50px" class="form-control border-dark rounded-0 w-50" aria-label=".form-select-sm example">
                    <option selected>Select your country</option>
                    <option value="1">Cambodia</option>
                    <option value="2">United state</option>
                    <option value="3">China</option>
                </select>
                <div class="w-100 pt-5 paypal-btn">
                    <div id="smart-button-container">
                        <div>
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <script>
                        function initPayPalButton() {
                            paypal.Buttons({
                                style: {
                                    shape: 'rect',
                                    color: 'gold',
                                    layout: 'vertical',
                                    label: 'paypal',

                                },

                                createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: [{
                                            "amount": {
                                                "currency_code": "USD",
                                                // "value": <?= $totalPrice ?>,
                                                "value": 0.1
                                            }
                                        }]
                                    });
                                },

                                onApprove: function(data, actions) {
                                    return actions.order.capture().then(function(orderData) {
                                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                        var transaction = orderData.purchase_units[0].payments.captures[0];
                                        var status = transaction.status;
                                        var id = $('.sec-border').data("id");
                                        // console.log(status);
                                        $.ajax({
                                            url: '<?= Url::to('payment') ?>',
                                            method: 'POST',
                                            // data: {
                                            //     transaction: transaction,
                                            //     status: status,
                                            //     id: id,
                                            //     action: 'info_detail',
                                            // },
                                            success: function(res) {
                                                var data = JSON.parse(res);
                                                console.log([data]);
                                                // if (data['status'] == 'success') {
                                                //     $(".row_item_" + id).remove();
                                                //     $("#cart-quantity").text(data['totalCart']);
                                                // }
                                            },
                                            error: function(err) {
                                                console.log(err);
                                            }
                                        });
                                        // alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                                    });
                                },

                                onError: function(err) {
                                    console.log(err);
                                }
                            }).render('#paypal-button-container');
                        }
                        initPayPalButton();
                    </script>
                </div>
                <h2 class="fw-bold p-3">Order Details</h2>
                <div class="pb-5">
                    <?php foreach ($relatedProduct as $key => $product) { ?>
                        <div class="sec-border rounded-0 hover row_item_<?= $product['cart_id'] ?>" data-id=<?= $product['cart_id'] ?>>
                            <div class="row ">
                                <div class="col-4">
                                    <img src="<?= $base_url . '/' . $product['image_url'] ?>" style="width:100px">
                                </div>
                                <div class="col-4 text-left py-5">
                                    <span class="fw-bold"> <?= $product['status'] ?>
                                    </span>
                                    <div class="color">
                                        <?php if ($product['color'] == 'Blue') { ?>
                                            <div id="variant-color" class="swatch clearfix" data-option-index="1">
                                                <div data-value="1" class="swatch-element color blue available">
                                                    <div class="tooltip">Blue</div>
                                                    <input quickbeam="color" id="swatch-1-blue" name="option-1" value="1" checked />
                                                    <label for="swatch-1-blue" style="border-color: blue;">
                                                        <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                        <span style="background-color: blue;"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } else if ($product['color'] == 'Yellow') { ?>
                                            <div id="variant-color" class="swatch clearfix" data-option-index="1">
                                                <div data-value="3" class="swatch-element color yellow available">
                                                    <div class="tooltip">Yellow</div>
                                                    <input quickbeam="color" id="swatch-1-yellow" name="option-1" value="3" />
                                                    <label for="swatch-1-yellow" style="border-color: yellow;">
                                                        <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                        <span style="background-color: yellow;"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div id="variant-color" class="swatch clearfix" data-option-index="1">
                                                <div data-value="2" class="swatch-element color red available">
                                                    <div class="tooltip">Red</div>
                                                    <input quickbeam="color" id="swatch-1-red" name="option-1" value="2" />
                                                    <label for="swatch-1-red" style="border-color: red;">
                                                        <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                        <span style="background-color: red;"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="variant-size">
                                            <?php if ($product['size'] == 'M') { ?>
                                                <div id="variant-size" class="swatch clearfix" data-option-index="0">
                                                    <div data-value="1" class="swatch-element plain m available">
                                                        <input id="swatch-0-m" name="option-0" value="M" checked />
                                                        <label for="swatch-0-m">
                                                            M
                                                            <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } else if ($product['size'] == 'L') { ?>
                                                <div id="variant-size" class="swatch clearfix" data-option-index="0">
                                                    <div data-value="1" class="swatch-element plain m available">
                                                        <input id="swatch-0-m" name="option-0" value="L" checked />
                                                        <label for="swatch-0-m">
                                                            L
                                                            <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } else if ($product['size'] == 'XL') { ?>
                                                <div id="variant-size" class="swatch clearfix" data-option-index="0">
                                                    <div data-value="1" class="swatch-element plain m available">
                                                        <input id="swatch-0-m" name="option-0" value="XL" checked />
                                                        <label for="swatch-0-m">
                                                            XL
                                                            <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div id="variant-size" class="swatch clearfix" data-option-index="0">
                                                    <div data-value="1" class="swatch-element plain m available">
                                                        <input id="swatch-0-m" name="option-0" value="XXL" checked />
                                                        <label for="swatch-0-m">
                                                            XXL
                                                            <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 text-left py-5">
                                    <span class="fw-bold"> $<?php
                                                            if ($product['quantity'] == 1) {
                                                                echo $product['price'];
                                                            } else {
                                                                echo $product['price'] . "(x" . $product['quantity'] . ")";
                                                            }

                                                            ?></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="col-5">
            <div class="border-shadow p-3" style="position: -webkit-sticky;position: sticky;top: 150px;">
                <h3>Summary</h3>
                <div class="row border-bottom border-dark pt-3">
                    <div class="col-6">
                        <h6>Original Price (<?= $totalCart ?>)</h6>
                    </div>
                    <div class="col-6 text-right mb-0">
                        <h6><?php echo Yii::$app->formatter->asCurrency($totalPrice) ?></h6>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-6">
                        <h6 class="fw-bold">Total :</h6>
                    </div>
                    <div class="col-6 text-right">
                        <h6 class="fw-bold"><?php echo Yii::$app->formatter->asCurrency($totalPrice) ?></h5>
                    </div>
                </div>
                <span class=" text-right" style="font-size:13px; "> Zay is required by law to collect applicable transaction taxes for purchases made in certain tax jurisdictions.</span>
                <span class=" text-right" style="font-size:13px ;text-indent: 30%;">By completing your purchase you agree to these <a class=" text-right" style="font-size:13px;color:purple" href="#">Terms of Service.</a></span>

            </div>
        </div>
    </div>
</div>

<?php

$script = <<< JS
    setTimeout(function(){
                $('.loader').css('display','none');
                $('.paypal-btn').css('display','block');
            }, 3000);
    var loader = document.getElementById('preloader');
    var blockpayment = document.getElementById('loader-block');
    window.addEventListener('load', function(){
        blockpayment.style.display="block";
        // loader.style.display="none";
    })
    JS;
$this->registerJs($script);
?>