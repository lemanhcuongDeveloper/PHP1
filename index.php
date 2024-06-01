<?php
    session_start();
    ob_start();
    if(!isset($_SESSION["giohang"])){
        $_SESSION["giohang"]=[];
    }
    // nhúng kết nối csdl
    include "dao/pdo.php";
    include "dao/user.php";
    include "dao/danhmuc.php";
    include "dao/sanpham.php";
    include "dao/giohang.php";
    include "dao/donhang.php";
    include "dao/global.php";
 
    include "view/header.php";

    //data dành cho trang chủ
    $dssp_new=get_dssp_new(4);
    $dssp_best=get_dssp_best(2);
    $dssp_view=get_dssp_view(4);


    if(!isset($_GET['pg'])){

        include "view/home.php";
    }else{
        switch ($_GET['pg']) {
            case 'sanpham':
                $dsdm=danhmuc_all();

                $kyw="";
                $titlepage="";

                if(!isset($_GET['iddm'])){
                    $iddm=0;
                }else{
                    $iddm=$_GET['iddm'];
                    $titlepage=get_name_dm($iddm);
                }

                // kiểm tra có phải form search không?
                if(isset($_POST["timkiem"])&&($_POST["timkiem"])){
                    $kyw=$_POST["kyw"];
                    $titlepage="Kết quả tìm kiếm với từ khóa: <span>".$kyw."</span>";
                }

                $dssp=get_dssp($kyw,$iddm,12);

                include "view/sanpham.php";
                break;
            case 'sanphamchitiet':
                $dsdm=danhmuc_all();
                if(isset($_GET["id"])&&($_GET["id"]>0)){
                    $id=$_GET["id"];
                    $iddm=get_iddm($id);
                    $dssp_lienquan=get_dssp_lienquan($iddm,$id,4);
                    $spchitiet=get_sanphamchitiet($id);
                    include "view/sanphamchitiet.php";
                }else{
                    include "view/home.php";
                }


                
                break;
            case 'addcart':
                if(isset($_POST["addcart"])){
                    $idpro=$_POST["idpro"];
                    $name=$_POST["name"];
                    $img=$_POST["img"];
                    $price=$_POST["price"];
                    $soluong=$_POST["soluong"];
                    $thanhtien=(int)$soluong * (int)$price;
                    $sp=array("idpro"=>$idpro,"name"=>$name,"img"=>$img,"price"=>$price,"soluong"=>$soluong,"thanhtien"=>$thanhtien);
                    array_push($_SESSION["giohang"],$sp);
                    // echo var_dump($_SESSION["giohang"]);
                    header('location: index.php?pg=viewcart');
                }

                // include "view/gioithieu.php";
                break;
            case 'viewcart':
                if(isset($_GET['del'])&&($_GET['del']==1)){
                    unset($_SESSION["giohang"]);
                    // $_SESSION["giohang"]=[];
                    header('location: index.php');
                }else{
                    if(isset($_SESSION["giohang"])){
                        $tongdonhang=get_tongdonhang();
                    }
                        $giatrivoucher=0;
                    if(isset($_GET['voucher'])&&($_GET['voucher']==1)){
                        $tongdonhang=$_POST['tongdonhang'];
                        $mavoucher=$_POST['mavoucher'];
                        // so sanh với db để lấy giá trị về
                        $giatrivoucher=10;
                        
                    }
                    $thanhtoan=$tongdonhang - $giatrivoucher;
                    include "view/viewcart.php";
                }
                break;
            case 'login':
                if (isset($_POST["dangnhap"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    
                    $user = checkuser($username, $password);
                    
                    if (isset($user) && is_array($user) && count($user) > 0) {
                        extract($user);
                        $_SESSION['s_user'] = $user;
                        
                        if ($rol == 1) { // click đăng nhập từ giỏ hàng và cho role == 1 để đến trang admin
                            header('location: admin/index.php?pg=bill');
                        } else if($_SESSION['trang']=="sanphamchitiet") {// click đăng nhập từ bình luận
                            header('location: admin/index.php?pg=sanphamchitiet&idpro='.$_SESSION['idpro'].'#binhluan');
                        }else{//mặc định
                            header('location: index.php'); 
                        }if($rol == 0){ // cho role == 0 để đăng nhập user trở về trang chủ 
                            header('location: index.php');
                        }
                    } else {
                        $_SESSION['tb_dangnhap'] = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                        header('location: index.php');
                    }
                }
                break;
            case 'donhang':
                    if(isset($_POST['donhang'])){
                        $hoten=$_POST['hoten'];
                        $diachi=$_POST['diachi'];
                        $email=$_POST['email'];
                        $dienthoai=$_POST['dienthoai'];
                        $nguoinhan_ten=$_POST['hoten_nguoinhan'];
                        $nguoinhan_diachi=$_POST['hoten_nguoinhan'];
                        $nguoinhan_tel=$_POST['diachi_nguoinhan'];
                        $nguoinhan_dienthoai=$_POST['dienthoai_nguoinhan'];
                        $pttt=$_POST['pttt'];
                        // insert user mới
                        $username="guest".rand(1,999);
                        $password="123456";
                        $iduser=user_insert_id($username,$password,$hoten,$diachi,$email,$dienthoai);

                        // tạo đơn hàng
                        $madh="zhope".$iduser."-".date("His-dmY");
                        $total=get_tongdonhang();
                        $ship=0;
                        if(isset($_SESSION['giatrivoucher'])){
                            $voucher = $_SESSION['giatrivoucher'];
                        }else{
                            $voucher= 0;
                        }
                        
                        $tongthanhtoan=($total - $voucher) + $ship ;
                        $idbill=bill_insert_id($madh,$iduser,$hoten, $email, $dienthoai, $diachi, $nguoinhan_ten, $nguoinhan_diachi,$nguoinhan_tel, $total,$ship,$voucher, $tongthanhtoan, $pttt );
                        // insert giỏ hàng từ session và table cart
                        foreach($_SESSION['giohang'] as $sp){
                            extract($sp);
                            cart_insert($idpro, $price, $name, $img, $soluong, $thanhtien, $idbill);
                        }
                        include "view/donhang_configm.php";
                    }
                    include "view/donhang.php";
                    break;
            case 'dangnhap':
                
                include "view/dangnhap.php";
                break;
            case 'myaccount':
                if(isset($_SESSION['s_user'])&&(count($_SESSION['s_user'])>0)){
                    
                    include "view/myaccount.php";
                }
                
                break;
            case 'logout':
                if(isset($_SESSION['s_user'])&&(count($_SESSION['s_user'])>0)){
                    unset($_SESSION['s_user']);
                }
                header('location: index.php');
                break;
            case 'adduser':
                // xác định giá trị input
                if(isset($_POST["dangky"])&&($_POST["dangky"])){
                    $username=$_POST["username"];
                    $password=$_POST["password"];
                    $email=$_POST["email"];
                    // xử lý
                    user_insert($username, $password, $email);
                }

                // 
                include "view/dangnhap.php";
                break;
            case 'updateuser':
                // xác định giá trị input
                if(isset($_POST["capnhat"])&&($_POST["capnhat"])){
                    $username=$_POST["username"];
                    $password=$_POST["password"];
                    $email=$_POST["email"];
                    $diachi=$_POST["diachi"];
                    $dienthoai=$_POST["dienthoai"];
                    $id=$_POST["id"];
                    $role=0;
                    // xử lý
                    user_update($username,$password,$email,$diachi,$dienthoai,$role,$id);
                    include "view/myaccount_confirm.php";
                }

                // 
                
                break;
            case 'dangky':
                include "view/dangky.php";
                break;
            case 'gioithieu':
                include "view/gioithieu.php";
                break;
            
            default:
                
                include "view/home.php";
                break;
        }
    }
    

    include "view/footer.php";

?>
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger intent="WELCOME" chat-title="Freshly_Chatbox" agent-id="27c650d9-1d94-4902-aded-ae3430e85202"
    language-code="en"></df-messenger>