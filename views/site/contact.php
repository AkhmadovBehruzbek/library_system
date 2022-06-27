<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

?>
<!-- Start Contact Area -->
<section class="wn_contact_area bg--white pt--80 pb--80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="contact-form-wrap">
                    <h2 class="contact__title">Biz bilan aloqa</h2>
                    <form id="contact-form" action="#" method="post">
                        <div class="single-contact-form space-between">
                            <input type="text" name="firstname" placeholder="Ism Familiya*">
                        </div>
                        <div class="single-contact-form space-between">
                            <input type="email" name="email" placeholder="Email*">
                        </div>
                        <div class="single-contact-form message">
                            <textarea name="message" placeholder="Xabar.."></textarea>
                        </div>
                        <div class="contact-btn">
                            <button type="submit">Yuborish</button>
                        </div>
                    </form>
                </div>
                <div class="form-output">
                    <p class="form-messege">
                </div>
            </div>
            <div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
                <div class="wn__address">
                    <h2 class="contact__title">Aloqa uchun.</h2>
                    <div class="wn__addres__wreapper">

                        <div class="single__address">
                            <i class="icon-location-pin icons"></i>
                            <div class="content">
                                <span>manzil:</span>
                                <p>Toshkent shahri, universitet ko'chasi №2</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-phone icons"></i>
                            <div class="content">
                                <span>Telefon raqam:</span>
                                <p> +998 71 246-46-00</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-envelope icons"></i>
                            <div class="content">
                                <span>Email address:</span>
                                <p>tstu_info@tdtu.uz</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-globe icons"></i>
                            <div class="content">
                                <span>website address:</span>
                                <p>tdtu.uz</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->
