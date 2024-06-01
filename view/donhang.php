<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffe House</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <div class="containerfull">
        <div class="bgbanner">ĐƠN HÀNG</div>
    </div>

    <section class="containerfull">
        <div class="container">
            <form action="index.php?pg=donhang" method="post">
            <div class="col9 viewcart">
                <div class="ttdathang">
                    <h2>Thông tin người đặt hàng</h2>
                  
                      <label for="hoten"><b>Họ và tên</b></label>
                      <input style="width: 600px;" type="text" placeholder="Nhập họ tên đầy đủ" name="hoten" id="hoten" required>
                    <br>
                      <label for="diachi"><b>Địa chỉ</b></label>
                      <input style="width: 630px;" type="text" placeholder="Nhập địa chỉ" name="diachi" id="diachi" required>
                      <br>
                      <label for="email"><b>Email</b></label>
                      <input style="width: 640px;" type="text" placeholder="Nhập email" name="email" id="email" required>
                      <br>
                      <label for="dienthoai"><b>Điện thoại</b></label>
                      <input style="width: 600px;" type="text" placeholder="Nhập điện thoại" name="dienthoai" id="dienthoai" required>
                </div>
                <div class="ttdathang">
                    <a onclick="showttnhanhang()" style="cursor: pointer;">
                    &rArr; Thay đổi thông tin nhận hàng
                    </a>
                </div>
                <div class="ttdathang" id="ttnhanhang">
                    <h2>Thông tin người nhận hàng</h2>
                  
                      <label for="hoten"><b>Họ và tên</b></label>
                      <input style="width: 600px;" type="text" placeholder="Nhập họ tên đầy đủ" name="hoten_nguoinhan" id="hoten_nguoinhan" >
                      <br>
                      <label for="diachi"><b>Địa chỉ</b></label>
                      <input style="width: 600px;" type="text" placeholder="Nhập địa chỉ" name="diachi_nguoinhan" id="diachi_nguoinhan" >
                      <br>
                      <label for="dienthoai"><b>Điện thoại</b></label>
                      <input style="width: 600px;" type="text" placeholder="Nhập điện thoại" name="dienthoai_nguoinhan" id="dienthoai_nguoinhan" >
                </div>
                      
                  
                    
        </div>
        <div class="col3">
            <h2>ĐƠN HÀNG</h2>
            <div class="total">
                <div class="boxcart">
                <li>Sản phẩm 1 x 1</li>
                <li>Sản phẩm 2 x 0</li>
                <li>Sản phẩm 3 x 0</li>
                
                <h3>Tổng: 390</h3>
                </div>
            </div>
            
            <div class="coupon">
                <div class="boxcart">
                <h3>Voucher: </h3>
                </div>
            </div>
            <div class="pttt">
                <div class="boxcart">
                <h3>Phương thức thanh toán: </h3>
                <input type="radio" name="pttt" value="1" id="" checked> Tiền mặt<br>
                <input type="radio" name="pttt" value="2"> Ví điện tử<br>
                <input type="radio" name="pttt" value="3" id=""> Chuyển khoản<br>
                <input type="radio" name="pttt" value="4" id=""> Thanh toán online<br>
                </div>
            </div>
            <div class="total">
                <div class="boxcart bggray">
                    <h3>Tổng thanh toán: 1000000</h3>
                </div>
            </div>
            <button type="submit" name="donhang">Thanh toán</button>
        </div>

        </form>

        </div>
    </section>




    <footer class="containerfull padd50">
        Copyright&copy;2023. MSSV + Tên SV
    </footer>

    <script>
        var ttnhanhang=document.getElementById("ttnhanhang");
        ttnhanhang.style.display="none";
        function showttnhanhang(){
            if(ttnhanhang.style.display=="none"){
                ttnhanhang.style.display="block";
            }else{
                ttnhanhang.style.display="none";
            }
        }
        

    </script>

</body>

</html>