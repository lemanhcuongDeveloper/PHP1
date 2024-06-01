<?php
$html_dssp="";
foreach ($dssp as $item) {
    extract($item);
    $hinhanh=IMG_PATH_ADMIN.$img;
    $imgtag="<img src='".$hinhanh."' width='80px'>";
    if($hide==1){
        $hide="<input type='checkbox' checked>";
    }else{
        $hide="<input type='checkbox'>";
    }
    if($dacbiet==1){
        $dacbiet="<input type='checkbox' checked>";
    }else{
        $dacbiet="<input type='checkbox'>";
    }
    $linkedit = 'index.php?pg=products_update&id='.$id;
    $linkdel = 'index.php?pg=products&del='.$id;
    $html_dssp.='<tr>
            <td>'.$imgtag.'</td>
            <td>'.$name.'</td>
            <td>'.number_format($price,0,",",".").' VNĐ</td>
            <td>'.$hide.'</td>
            <td>'.$dacbiet.'</td>
            <td>
                <a href="'.$linkedit.'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                <a href="'.$linkdel.'" onclick="return confirm(\'Bạn chắc chắn muốn xóa sản phẩm này?\')" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
            </td>
            </tr>';
    }
?>
<div class="main-content">
    <h3 class="title-page">
        Sản phẩm
    </h3>
    <div class="d-flex justify-content-end">
        <a href="index.php?pg=products_add" class="btn btn-primary mb-2">Thêm sản phẩm</a>
    </div>
    <div class="d-flex justify-content-start">
        <form action="index.php?pg=products" method="post">
            <input type="text" name="kyw" id="">
            <button type="submit" name="timkiem" class="btn btn-secondary mb-2">Tìm kiếm</button>
        </form>
    </div>
    <div class="phanpage">
        <?php
        echo $hienthisotrang;
    ?>

    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Hình</th>
                <th>Tên sản phẩm</th>
                <th>Price</th>
                <th>Hide</th>
                <th>Đặc biệt</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?=$html_dssp;?>


        </tbody>
        <tfoot>
            <tr>
                <th>Hình</th>
                <th>Tên sản phẩm</th>
                <th>Price</th>
                <th>Hide</th>
                <th>Đặc biệt</th>
                <th>Thao tác</th>
            </tr>

        </tfoot>
    </table>
    <div class="phanpage">
        <?php
         echo $hienthisotrang;
      ?>
    </div>
</div>
</div>
</div>
<script src="assets/js/main.js"></script>
<script>
new DataTable('#example');
</script>