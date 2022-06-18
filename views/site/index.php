<?php
/**
 * @var $categories Category
 */

use app\models\Category;
use yii\widgets\LinkPager;

?>

<!-- Start Banner -->
<div class="ht__bradcaump__area bg-image--6">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Shop Grid</h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="index.html">Home</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active">Shop Grid</span>
                    </nav>
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
                        <h3 class="wedget__title">Product Categories</h3>
                        <ul>
                            <?php
                            foreach ($categories as $category): ?>
                                <li><a href="#"><?= $category['title'] ?> <span>(3)</span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                    <aside class="wedget__categories poroduct--tag">
                        <h3 class="wedget__title">Product Tags</h3>
                        <ul>
                            <li><a href="#">Biography</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Cookbooks</a></li>
                            <li><a href="#">Health & Fitness</a></li>
                            <li><a href="#">History</a></li>
                            <li><a href="#">Mystery</a></li>
                            <li><a href="#">Inspiration</a></li>
                            <li><a href="#">Religion</a></li>
                            <li><a href="#">Fiction</a></li>
                            <li><a href="#">Fantasy</a></li>
                            <li><a href="#">Music</a></li>
                            <li><a href="#">Toys</a></li>
                            <li><a href="#">Hoodies</a></li>
                        </ul>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                <!--                Sort start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                            <div class="error__inner text-center">
                                <div class="error__content">
                                    <div class="search_form_wrapper">
                                        <form action="#">
                                            <div class="form__box" style="margin: 0; max-width: 100%">
                                                <input type="text" placeholder="Search...">
                                                <button><i class="fa fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="orderby__wrapper">
                                <span>Sort By</span>
                                <select class="shot__byselect">
                                    <option>Default sorting</option>
                                    <option>HeadPhone</option>
                                    <option>Furniture</option>
                                    <option>Jewellery</option>
                                    <option>Handmade</option>
                                    <option>Kids</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab__container">
                    <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                        <div class="row">
                            <!-- Start Single Product -->
                            <?php foreach ($books as $book): ?>
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="/web/about/<?= $book['id'] ?>"><img
                                                    src="/web/images/book/<?= $book['image'] ?>"
                                                    alt="product image"></a>
                                        <a class="second__img animation1" href="/web/about/<?= $book['id'] ?>"><img
                                                    src="/web/images/book/<?= $book['image'] ?>"
                                                    alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">BEST SALLER</span>
                                        </div>
                                    </div>
                                    <div class="content--center">
                                        <h4><a href="/web/about/<?= $book['id'] ?>"><?= $book['name'] ?></a></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- End Single Product -->
                        </div>
                        <!--  Pagination start -->
                        <?= LinkPager::widget([
                            'pagination' => $pages,
                        ])
                        ?>
                        <!--           Pagination end             -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page -->