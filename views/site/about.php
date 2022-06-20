<style>
    .modal-body {
        padding: 0 !important;
    }

    .btn {
        background-color: DodgerBlue;
        border: none;
        color: white;
        padding: 7px 30px;
        cursor: pointer;
        font-size: 20px;
    }

    /* Darker background on mouse-over */
    .btn:hover {
        background-color: RoyalBlue;
    }
</style>
<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $book app\models\Book
 * @var $book_file app\models\BookFile
 * @var $book_author app\models\BookAuthor
 */

Modal::begin([
    'title' => $book['name'],
    'size' => 'modal-lg'
]);

echo \yii2assets\pdfjs\PdfJs::widget([
    'url' => Url::base() . '/' . $book_file['file_path'] . $book_file['file_name']
]);
Modal::end();
?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title"><?= $book['name'] ?></h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="/">Bosh sahifa</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active"><?= $book['name'] ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start main Content -->
<div class="maincontent bg--white pt--80 pb--55">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="wn__single__product">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="wn__fotorama__wrapper">
                                <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                    <a href="/web/images/book/<?= $book['image'] ?>"><img
                                                src="/web/images/book/<?= $book['image'] ?>" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product__info__main">
                                <h1><?= $book['name'] ?></h1>
                                <div class="product__overview">
                                    <ul>
                                        <li>• Kitob nomi: <?= $book['name'] ?></li>
                                        <li>• Kitob Muallifi: <?= $book_author['full_name'] ?> </li>
                                        <li>• Kitob nashr qilingan yil: <?= $book['published_date'] ?> - yil</li>
                                        <li>• Fayl xajmi: <?= $book_file['file_size'] ?></li>

                                    </ul>
                                </div>
                                <div class="box-tocart d-flex">
                                    <div class="addtocart__actions">
                                        <button class="tocart read_book_button" id="read_book_button"
                                                data-toggle="modal"
                                                data-target="#w0" type="button"
                                                title="Add to Cart"><i class="fa icon-book-open"></i> Kitobni o'qish
                                        </button>
                                        <small class="product-add-to-cart">
                                            <?= Html::a('<i class="fa fa-download"></i> Ko\'chirib olish', ['download', 'id' => $book['id']], ['class' => '']) ?>

                                        </small>
                                    </div>
                                    <div class="product-addto-links clearfix">
                                        <a class="wishlist" href="#"></a>
                                    </div>
                                </div>
                                <div class="product_meta">
											<span class="posted_in">Kategoriyalar:
												<a href="#">Badiiy</a>,
											</span>
                                </div>
                                <div class="product-share">
                                    <ul>
                                        <li class="categories-title">Ulashish :</li>
                                        <li>
                                            <a href="https://t.me/share/url?url={url}&text=http://library-system.local/book/<?= $book['id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                                     stroke-width="2" stroke="#000000" fill="none"
                                                     class="duration-300 transform transition-all"
                                                     style="width: 19px; height: 19px; margin-bottom: 6px; margin-right: 2px">
                                                    <path d="M26.67 38.57l-.82 11.54A2.88 2.88 0 0028.14 49l5.5-5.26 11.42 8.35c2.08 1.17 3.55.56 4.12-1.92l7.49-35.12h0c.66-3.09-1.08-4.33-3.16-3.55l-44 16.85C6.47 29.55 6.54 31.23 9 32l11.26 3.5 25.33-14.79c1.23-.83 2.36-.37 1.44.44z"
                                                          stroke-linecap="round"></path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="http://www.facebook.com/sharer.php?u=http://library-system.local/book/<?= $book['id'] ?>">
                                                <i class="icon-social-facebook icons"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product__info__detailed">
                    <div class="pro_details_nav nav justify-content-start" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Kitob
                            haqida</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Fikr
                            mulohazalar</a>
                    </div>
                    <div class="tab__container">
                        <!-- Start Single Tab Content -->
                        <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                            <div class="description__attribute">
                                <p><?= $book['description'] ?></p>
                            </div>
                        </div>
                        <!-- End Single Tab Content -->
                        <!-- Start Single Tab Content -->
                        <div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
                            <div class="review-fieldset" style=" padding-top: 0px; border-top: 0">
                                <h3>Fikr qoldiring</h3>
                                <div class="review_form_field">
                                    <div class="input__box">
                                        <span>Ismingiz</span>
                                        <input id="nickname_field" type="text" name="nickname">
                                    </div>
                                    <div class="input__box">
                                        <span>Elektron pochta</span>
                                        <input id="summery_field" type="email" name="summery">
                                    </div>
                                    <div class="input__box">
                                        <span>Kitob haqida fikringiz</span>
                                        <textarea name="review"></textarea>
                                    </div>
                                    <div class="review-form-actions">
                                        <button>Yuborish</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Tab Content -->
                    </div>
                </div>
                <div class="wn__related__product pt--80 pb--50">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">Muallifning boshqa kitoblari</h2>
                    </div>
                    <div class="row mt--60">
                        <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/1.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/2.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">BEST SALLER</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">robin parrish</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/3.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/4.jpg" alt="product image"></a>
                                    <div class="hot__box color--2">
                                        <span class="hot-label">HOT</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">The Remainng</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/7.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/8.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">HOT</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">Lando</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$50.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/9.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/10.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">HOT</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">Doctor Wldo</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/11.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/2.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">BEST SALER</span>
                                    </div>
                                </div>
                                <div class="product__content content--center content--center">
                                    <h4><a href="single-product.html">Animals Life</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$50.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/1.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/6.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">BEST SALER</span>
                                    </div>
                                </div>
                                <div class="product__content content--center content--center">
                                    <h4><a href="single-product.html">Olio Madu</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$50.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                        </div>
                    </div>
                </div>
                <div class="wn__related__product">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">O'xshash kitoblar</h2>
                    </div>
                    <div class="row mt--60">
                        <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/1.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/2.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">BEST SALLER</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">robin parrish</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/3.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/4.jpg" alt="product image"></a>
                                    <div class="hot__box color--2">
                                        <span class="hot-label">HOT</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">The Remainng</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/7.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/8.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">HOT</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">Lando</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$50.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/9.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/10.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">HOT</span>
                                    </div>
                                </div>
                                <div class="product__content content--center">
                                    <h4><a href="single-product.html">Doctor Wldo</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$35.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/11.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/2.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">BEST SALER</span>
                                    </div>
                                </div>
                                <div class="product__content content--center content--center">
                                    <h4><a href="single-product.html">Animals Life</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$50.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                            <!-- Start Single Product -->
                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="product__thumb">
                                    <a class="first__img" href="single-product.html"><img src="images/books/1.jpg"
                                                                                          alt="product image"></a>
                                    <a class="second__img animation1" href="single-product.html"><img
                                                src="images/books/6.jpg" alt="product image"></a>
                                    <div class="hot__box">
                                        <span class="hot-label">BEST SALER</span>
                                    </div>
                                </div>
                                <div class="product__content content--center content--center">
                                    <h4><a href="single-product.html">Olio Madu</a></h4>
                                    <ul class="prize d-flex">
                                        <li>$50.00</li>
                                        <li class="old_prize">$35.00</li>
                                    </ul>
                                    <div class="action">
                                        <div class="actions_inner">
                                            <ul class="add_to_links">
                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                </li>
                                                <li><a class="wishlist" href="wishlist.html"><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a>
                                                </li>
                                                <li><a data-toggle="modal" title="Quick View"
                                                       class="quickview modal-view detail-link" href="#productmodal"><i
                                                                class="bi bi-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__hover--content">
                                        <ul class="rating d-flex">
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End main Content -->

