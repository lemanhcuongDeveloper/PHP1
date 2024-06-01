<?php
require_once 'pdo.php';

function sanpham_insert($iddm,$name,$img,$price,$hide,$dacbiet){
    $sql = "INSERT INTO sanpham(iddm,name,img,price,hide,dacbiet) VALUES (?,?,?,?,?,?)";
    pdo_execute($sql, $iddm,$name,$img,$price,$hide,$dacbiet);    
}

// function hang_hoa_insert($ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet, $so_luot_xem, $ngay_nhap, $mo_ta){
//     $sql = "INSERT INTO hang_hoa(ten_hh, don_gia, giam_gia, hinh, ma_loai, dac_biet, so_luot_xem, ngay_nhap, mo_ta) VALUES (?,?,?,?,?,?,?,?,?)";
//     pdo_execute($sql, $ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet==1, $so_luot_xem, $ngay_nhap, $mo_ta);
// }

function sanpham_update($iddm,$name, $img, $price,$id){
    if($img!=""){
        $sql = "UPDATE sanpham SET iddm=?,name=?,img=?,price=? WHERE id=?";
        pdo_execute($sql,$iddm,$name, $img, $price,$id);
    }else{
        $sql = "UPDATE sanpham SET iddm=?,name=?,price=? WHERE id=?";
        pdo_execute($sql,$iddm,$name, $price,$id);
    }
}

function sanpham_delete($id){
    $sql = "DELETE FROM sanpham WHERE  id=?";
    // if(is_array($id)){
    //     foreach ($ma_hh as $ma) {
    //         pdo_execute($sql, $ma);
    //     }
    // }
    // else{
        pdo_execute($sql, $id);
    //}
}

function hien_thi_so_trang($dssp,$soluongsp){
    $tongsanpham=count($dssp);
    $sotrang=ceil($tongsanpham/$soluongsp);
    $html_sotrang="";
    for ($i=1; $i <=$sotrang ; $i++) { 
        $html_sotrang.='<a href="index.php?pg=products&page='.$i.'">'.$i.'</a> ';
    }
    return $html_sotrang;
}
function get_dssp_all(){
    $sql = "SELECT * FROM sanpham ORDER BY id DESC";
    return pdo_query($sql);
}
function get_dssp_admin($kyw,$page,$soluongsp){

    // kiểm tra đang ở trang nào? tạo limit
    // if(($page="")||($page=0)) $page=1;
    
    $batdau=($page-1)*$soluongsp;
     

    $sql = "SELECT * FROM sanpham WHERE 1";
    if($kyw!=""){
        $sql .= " AND name like ?";
        $sql .= " ORDER BY id DESC";
        $sql .= " LIMIT ".$batdau.",".$soluongsp;
        return pdo_query($sql,"%".$kyw."%");
    }else{
        $sql .= " ORDER BY id DESC";
        $sql .= " LIMIT ".$batdau.",".$soluongsp;
        return pdo_query($sql);
    }

    
}
function get_dssp_new($limi){
    $sql = "SELECT * FROM sanpham ORDER BY id DESC limit ".$limi;
    return pdo_query($sql);
}
function get_dssp_best($limi){
    $sql = "SELECT * FROM sanpham WHERE bestseller=1 ORDER BY id DESC limit ".$limi;
    return pdo_query($sql);
}
function get_dssp_view($limi){
    $sql = "SELECT * FROM sanpham ORDER BY view DESC limit ".$limi;
    return pdo_query($sql);
}

function get_dssp($kyw,$iddm,$limi){
    $sql = "SELECT * FROM sanpham WHERE 1";
    if($iddm>0){
        $sql .=" AND iddm=".$iddm;
    }
    if($kyw!=""){
        $sql .=" AND name like '%".$kyw."%'";
    }

    $sql .= " ORDER BY id DESC limit ".$limi;
    return pdo_query($sql);
}

function get_sanphamchitiet($id){
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query_one($sql,$id);
}

function get_dssp_lienquan($iddm,$id,$limi){
    $sql = "SELECT * FROM sanpham WHERE iddm=? AND id<>? ORDER BY id DESC limit ".$limi;
    return pdo_query($sql,$iddm,$id);
}

function get_iddm($id){
    $sql = "SELECT iddm FROM sanpham WHERE id=?";
    return pdo_query_value($sql,$id);
}

function showsp($dssp){
    $html_dssp='';
    foreach ($dssp as $sp) {
        extract($sp);
        if($bestseller==1){
            $best='<div class="best"></div>';
        }else{
            $best='';
        }
        $html_dssp.='<div class="box25 mr15">
                            '.$best.'
                            <a href="index.php?pg=sanphamchitiet&id='.$id.'">
                                <img src="uploads/'.$img.'" alt="">
                            </a>
                            <span class="price">'.$price.' đ</span>
                            <form action="index.php?pg=addcart" method="post">
                                <input type="hidden" name="idpro" value="'.$id.'">
                                <input type="hidden" name="name" value="'.$name.'">
                                <input type="hidden" name="img" value="'.$img.'">
                                <input type="hidden" name="price" value="'.$price.'">
                                <input type="hidden" name="soluong" value="1">
                                <button type="submit" name="addcart">Đặt hàng</button>
                            </form>
                            
                        </div>';
    }
    return $html_dssp;
}

// function hang_hoa_select_by_id($ma_hh){
//     $sql = "SELECT * FROM hang_hoa WHERE ma_hh=?";
//     return pdo_query_one($sql, $ma_hh);
// }

// function hang_hoa_exist($ma_hh){
//     $sql = "SELECT count(*) FROM hang_hoa WHERE ma_hh=?";
//     return pdo_query_value($sql, $ma_hh) > 0;
// }

// function hang_hoa_tang_so_luot_xem($ma_hh){
//     $sql = "UPDATE hang_hoa SET so_luot_xem = so_luot_xem + 1 WHERE ma_hh=?";
//     pdo_execute($sql, $ma_hh);
// }

// function hang_hoa_select_top10(){
//     $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
//     return pdo_query($sql);
// }

// function hang_hoa_select_dac_biet(){
//     $sql = "SELECT * FROM hang_hoa WHERE dac_biet=1";
//     return pdo_query($sql);
// }

// function hang_hoa_select_by_loai($ma_loai){
//     $sql = "SELECT * FROM hang_hoa WHERE ma_loai=?";
//     return pdo_query($sql, $ma_loai);
// }

// function hang_hoa_select_keyword($keyword){
//     $sql = "SELECT * FROM hang_hoa hh "
//             . " JOIN loai lo ON lo.ma_loai=hh.ma_loai "
//             . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
//     return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%');
// }

// function hang_hoa_select_page(){
//     if(!isset($_SESSION['page_no'])){
//         $_SESSION['page_no'] = 0;
//     }
//     if(!isset($_SESSION['page_count'])){
//         $row_count = pdo_query_value("SELECT count(*) FROM hang_hoa");
//         $_SESSION['page_count'] = ceil($row_count/10.0);
//     }
//     if(exist_param("page_no")){
//         $_SESSION['page_no'] = $_REQUEST['page_no'];
//     }
//     if($_SESSION['page_no'] < 0){
//         $_SESSION['page_no'] = $_SESSION['page_count'] - 1;
//     }
//     if($_SESSION['page_no'] >= $_SESSION['page_count']){
//         $_SESSION['page_no'] = 0;
//     }
//     $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh LIMIT ".$_SESSION['page_no'].", 10";
//     return pdo_query($sql);
// }