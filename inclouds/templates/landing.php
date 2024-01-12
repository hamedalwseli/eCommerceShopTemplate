
   <!-- CDN IMPORT  -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />


<section class="landing">
            <div class="swiper container container-swiper">
                <div class="swiper-wrapper">
                    <div class=" swiper-slide slide">
                        <div class="info">
                            <span>order-online</span>
                            <h3>fashion & youth</h3>
                            <a href="categories.php?pageid=9&catName=fashion" class="main-title" style="margin-bottom: 25px;">see more</a>

                        </div>
                        <div class="image">
                            <img src="desgin/img/fashion/landing/fas.png" alt="">
                        </div>
                    </div>

                    
                    <div class="swiper-slide  slide">
                        <div class="info">
                            <span>order-online</span>
                            <h3>labtops & accessories</h3>
                            <a href="menu.html" class="main-title">see more</a>
                            
                        </div>
                        <div class="image">
                            <img src="desgin/img/fashion/landing/landing-labtop.png" alt="">
                        </div>
                    </div>

                    <div class=" swiper-slide  slide">
                        <div class="info">
                            <span>order-online</span>
                            <h3>make-up & beauty</h3>
                            <a href="menu.html" class="main-title">see more</a>
                            
                        </div>
                        <div class="image">
                            <img src="desgin/img/fashion/landing/make-up.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
            <!-- start display-categories name  -->
            <section class='cat-names'> 
                <div class="heading m-0" style="min-height: 5rem;">
                    <h3>#categories</h3>    
                </div>
                    <div class="row">
                        <div class="col-md-6 electronic box-lan">
                            <div class="info">
                                    <h3><?php echo getCatInfo('name','electronics'); ?></h3>
                                    <h6><?php echo getCatInfo('decription','electronics','decription')?></h6>
                                    <a href="categories.php?lang=<?php echo $lang?>&pageid=<?php echo getCatInfo('id','electronics','id')?>&catName=<?php echo getCatInfo('name','electronics'); ?>">see more</a>
                            </div>
                        </div>
                        <div class="col-md-6 games box-lan">
                            <div class="info">
                                    <h3><?php echo getCatInfo('name','games')?></h3>
                                    <h6><?php echo getCatInfo('decription','games','decription')?> </h6>
                                    <a href="categories.php?lang=<?php echo $lang?>&pageid=<?php echo getCatInfo('id','games','id')?>&catName=<?php echo getCatInfo('name','games'); ?>">see more</a>
                                 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 fashion box-lan">
                            <div class="info">
                                    <h3><?php echo getCatInfo('name','fashion')?></h3>
                                    <h6><?php echo getCatInfo('decription','fashion','decription')?></h6>
                                    <a href="categories.php?lang=<?php echo $lang?>&pageid=<?php echo getCatInfo('id','fashion','id')?>&catName=<?php echo getCatInfo('name','fashion'); ?>">see more</a>
                            </div>
                        </div>
                        <div class="col-md-4 labtops box-lan">
                            <div class="info">
                                    <h3><?php echo getCatInfo('name','labtops')?></h3>
                                    <h6><?php echo getCatInfo('decription','labtops','decription')?></h6>
                                    <a href="categories.php?lang=<?php echo $lang?>&pageid=<?php echo getCatInfo('id','labtops','id')?>&catName=<?php echo getCatInfo('name','labtops'); ?>">see more</a>
                            </div>
                        </div>
                        <div class="col-md-4 fur box-lan">
                            <div class="info">
                                    <h3><?php echo getCatInfo('name','furnitures')?></h3>
                                    <h6><?php echo getCatInfo('decription','furnitures','decription')?></h6>
                                    <a href="categories.php?lang=<?php echo $lang?>&pageid=<?php echo getCatInfo('id','furnitures','id')?>&catName=<?php echo getCatInfo('name','furnitures'); ?>">see more</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 make-up box-lan">
                            <div class="info">
                                    <h6>crazy deals!</h6>
                                    <h3><?php echo getCatInfo('name','make up')?></h3>
                                    <h6><?php echo getCatInfo('decription','make up','decription')?></h6>
                                    <a href="categories.php?lang=<?php echo $lang?>&pageid=<?php echo getCatInfo('id','make up','id')?>&catName=<?php echo getCatInfo('name','make up'); ?>">see more</a>
                            </div>
                        </div>
                        <div class="col-md-6 cell-phones box-lan">
                            <div class="info">
                                    <h3><?php echo getCatInfo('name','cell phones')?></h3>
                                    <h6><?php echo getCatInfo('decription','cell phones','decription')?> </h6>
                                    <a href="categories.php?lang=<?php echo $lang?>&pageid=<?php echo getCatInfo('id','cell phones','id')?>&catName=<?php echo getCatInfo('name','cell phones'); ?>">see more</a>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- end display-categories name  -->
            <!-- start  dispaly items  -->

        
<div class="categories-m">
    <div class="heading "  style="min-height: 5rem;margin-top: var(--section-padding); margin-bottom:0;">
    <h3>#itmes</h2>
    </div>
    <div class="container">
        <div class="row gap-top-items-categories-page">
        <?php
        $allItems= getAll('items','item_id');
        foreach($allItems as $item){
        echo "<div class=' col-sm-4 col-md-3 product'>";
            echo "<div class ='box'>";
            echo "<a href='item.php?itemID=".$item['item_id']."'><button type='submit' class='fas fa-eye' name='quick_view'></button></a>";
            echo '<button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>';
                echo "<div class='img-box'>";
                    echo ' <img src="desgin/img/feature01.jpg" alt="">';
                echo  "</div>";
                echo "<div class='info'>";
                     echo "<h3 class='cat-name'>".$item['name']."</h3>";
                     echo "<p class='price'>".$item['price']."$</p>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        }
        ?>
        </div>
    </div>
    </div
    ?>
     <!-- end  dispaly items  -->
        <!-- CDN import   -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".container-swiper", {
        loop: true,
        grabCursor: true,
        effect: "flip",
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
    });
</script>