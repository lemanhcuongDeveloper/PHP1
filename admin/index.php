<?php
   include "../dao/global.php";
   include "../dao/pdo.php";
   include "../dao/danhmuc.php";
   include "../dao/sanpham.php";
   include "../dao/thongke.php";
   include "../dao/user.php";

   include "view/header.php";

   // Thống kê
   $tk_sp = thongke_sp();
   $tk_tv = thongke_tv();
   $tk_dm = thongke_dm();
   // 
   // SHOW DASHBOARDS
   $ds_users = user_select_all();
   // 
   if(isset($_GET['pg'])){
      switch ($_GET['pg']) {
         case 'orders':
            include "view/orders.php";
            break;
         case 'caterogies':
            $dsdm = danhmuc_all();
            include "view/caterogies.php";
            break;
         case 'caterogies_add':
            if(isset($_POST['btnadd'])){
               $name=$_POST['name'];
               danhmuc_insert($name);
               $tb="Bạn đã thêm thành công!";
            }
            include "view/caterogies_add.php";
            break;
         case 'update_products':
            // Kiểm tra và lấy dữ liệu
            if(isset($_POST['updatepro'])){
               $iddm=$_POST['iddm'];
               $id=$_POST['id'];
               $name=$_POST['name'];
               $price=$_POST['price'];
               // lấy tên file
               $img=basename($_FILES['img']['name']);
               if($img!=""){
               // upload file hình
               $target_file=IMG_PATH_ADMIN.$img;
               move_uploaded_file($_FILES['img']['tmp_name'],$target_file );
               }else{
                  $img = "";
               }
               // insert to database
               sanpham_update($iddm,$name, $img, $price,$id);
            }
            // 
            include "view/banners.php";
            break;
         case 'products_update':
            if(isset($_GET['id'])&&($_GET['id']>0)){
               $id = $_GET['id'];
               $sp=get_sanphamchitiet($id);
                  
            }
            $dsdm=danhmuc_all();
            include "view/products_update.php";
            break;
         case 'products':
            if(isset($_GET['del'])&&($_GET['del']>0)){
               $id = $_GET['del'];
               $ctsp=get_sanphamchitiet($id);
               if(is_array($ctsp)){
                  // lấy hình ảnh
                     extract($ctsp);
                     $img_path=IMG_PATH_ADMIN.$img;
                     if(is_file($img_path)){
                        unlink($img_path);
                     }
                  // xoá record dtb
                  sanpham_delete($id);
               }
            }
            //load và show
            if(isset($_POST['timkiem'])){
               $kyw=$_POST['kyw'];
            }else{
               $kyw="";
            }
            if(!isset($_GET['page'])){
               $page=1;
            }else{
               $page=$_GET['page'];
            }
            $soluongsp=6;
            $dssp=get_dssp_admin($kyw,$page,$soluongsp);
            $tongsosp=get_dssp_all();
            $hienthisotrang=hien_thi_so_trang($tongsosp,$soluongsp);
            include "view/products.php";
            break;
         case 'products_add':
            if(isset($_POST['btnadd'])){
               $iddm=$_POST['iddm'];
               $name=$_POST['name'];
               $price=$_POST['price'];
// xử lý checkbox
               if(isset($_POST['hide'])){
                  $hide=$_POST['hide'];
                  if($hide) $hide=1; else $hide=0;
               }else{
                  $hide=0;
               }
               if(isset($_POST['dacbiet'])){
                  $dacbiet=$_POST['dacbiet'];
                  if($dacbiet) $dacbiet=1; else $dacbiet=0;
               }else{
                  $dacbiet=0;
               }
               // lấy tên file
               $img=basename($_FILES['img']['name']);
               // upload file hình
               $target_file=IMG_PATH_ADMIN.$img;
               move_uploaded_file($_FILES['img']['tmp_name'],$target_file );
               // insert to database
               sanpham_insert($iddm,$name, $img, $price,$hide,$dacbiet);
               $tb="Bạn đã thêm thành công!";
            }
            $dsdm=danhmuc_all();
            include "view/products_add.php";
            break; 
         case 'users':
            $ds_users = user_select_all();
            include "view/users.php";
            break;
         case 'banners':
            include "view/banners.php";
            break;
         case 'binhluan':
            include "view/binhluan.php";
            break;
         
         default:
            include "view/home.php";
            break;
      }
   }else{
      include "view/home.php";
   }

   include "view/footer.php";
?>