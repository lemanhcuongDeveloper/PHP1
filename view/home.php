<?php
    $html_dssp_new=showsp($dssp_new);
    $html_dssp_best=showsp($dssp_best);
    $html_dssp_view=showsp($dssp_view);
?>
<div  class="containerfull">
    <img src="layout/images/banne.jpg" alt="">
</div>

<section class="containerfull">
    <div class="container">
        <h1>SẢN PHẨM HOT</h1><br>
        <div class="containerfull">
            <div class="box50 mr15">
                
            </div>
            <?=$html_dssp_new?>
        </div>

        <div class="containerfull mr30">
            <h1>SẢN PHẨM MỚI</h1><br>
            <?=$html_dssp_new;?>
        </div>

        <div class="containerfull mr30">
            <h1>SẢN PHẨM NHIỀU NGƯỜI XEM</h1><br>
            <?=$html_dssp_view?>
        </div>

    </div>
</section>


<section class="containerfull bg1 padd50">
    <div class="container">
        <h1>DANH MỤC SẢN PHẨM HOT</h1>
        <div class="row">
            <h2>Bút</h2>
        </div>
        <div class="row">
            <?=$html_dssp_best?>
        </div>
        <div class="row">
            <h2>Sách</h2>
        </div>
        <div class="row">
            <?=$html_dssp_best?>
        </div>

    </div>
</section>