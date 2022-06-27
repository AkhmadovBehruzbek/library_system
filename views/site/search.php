<?php
/**
 * @var $categories Category
 */

use app\models\Category;
use yii\widgets\LinkPager;

?>
<!-- Start Banner -->
<div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
    <div class="slide animation__style10 bg-image--6 fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <h2>Toshkent <span>Davlat </span></h2>
                            <h2>Texnika <span>Universiteti </span></h2>
                            <h2>On-Line <span>Kutubxonasi </span></h2>
                            <a class="shopbtn" href="http://tdtu.uz">TDTU saytiga o'tish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner -->
<!-- Start Shop Page -->
<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                <div class="shop__sidebar">
                    <aside class="wedget__categories poroduct--cat">
                        <h3 class="wedget__title">Kategoriya</h3>
                        <ul>
                            <?php
                            foreach ($categories as $category): ?>
                                <li><a href="#"><?= $category['title'] ?>
                                        <span>(<?= $category['book_count'] ?>)</span></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                    <aside class="wedget__categories poroduct--tag">
                        <h3 class="wedget__title">Mualliflar</h3>
                        <ul>
                            <?php foreach ($authors as $author): ?>
                                <li><a href="#"><?= $author ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9 col-12 order-1 order-lg-2 book-section">
                <!--                Sort start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                            <div class="error__inner text-center">
                                <div class="error__content">
                                    <div class="search_form_wrapper">
                                        <form action="<?= \yii\helpers\Url::to(['site/search']) ?>" method="get">
                                            <div class="form__box" style="margin: 0; max-width: 100%">
                                                <input type="text" name="q"
                                                       placeholder="Kitob yoki muallif nomi kiriting">
                                                <button><i class="fa fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab__container books">
                    <?php \yii\widgets\Pjax::begin(['id' => 'book-id-pjax']) ?>
                    <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                        <div class="row" id="book-search">
                            <?php if (!empty($books)): ?>
                                <!-- Start Single Product -->
                                <?php foreach ($books as $book): ?>
                                    <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="product__thumb">
                                            <a class="first__img" href="/web/book/<?= $book['id'] ?>"><img
                                                        src="/web/images/book/<?= $book['image'] ?>"
                                                        alt="product image"></a>
                                            <a class="second__img animation1" href="/web/book/<?= $book['id'] ?>"><img
                                                        src="/web/images/book/<?= $book['image'] ?>"
                                                        alt="product image"></a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SALLER</span>
                                            </div>
                                        </div>
                                        <div class="content--center">
                                            <h4><a href="/web/book/<?= $book['id'] ?>"><?= $book['name'] ?></a></h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="w3ls_w3l_banner_nav_right_grid">
                                    <h6>So'rov bo'yicha hech narsa topilmadi...</h6>
                                </div>
                            <?php endif; ?>
                            <!-- End Single Product -->
                        </div>
                        <!--  Pagination start -->
                        <?= LinkPager::widget([
                            'pagination' => $pages,
                        ])
                        ?>
                        <!--           Pagination end             -->
                    </div>
                    <?php \yii\widgets\Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page -->