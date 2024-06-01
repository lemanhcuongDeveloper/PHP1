<?php
   // $html_dm="";
   // foreach ($dsdm as $item) {
   //    extract($item);
   //    $html_dm.='<option value="'.$id.'">'.$name.'</option>';
   // }
   if(is_array($sp)&&(count($sp)>0)){
      extract($sp);
      $idupdate=$id;
      $imgpath=IMG_PATH_ADMIN.$img;
      if(is_file($imgpath)){
         $img='<img src="'.$imgpath.'" width="80px"';
      }else{
         $img="";
      }
   }
   $html_dml=showdm_admin($dsdm,$iddm);
?>
<div class="main-content">
   <h3 class="title-page">
      Cập nhật sản phẩm
   </h3>
   <div class="box500">
      <form class="addPro" action="index.php?pg=products_update" method="POST" enctype="multipart/form-data">

         <div class="form-group">
            <label for="name">Danh mục:</label>
            <select name="iddm" id="iddm">
               <option value="0" selected>... Vui lòng chọn 1 danh mục ...</option>
               <?=$$html_dml;?>

            </select>
         </div>
         <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" class="form-control" name="name" value="<?=($name!="")?$name:"";?>" id="name" placeholder="Nhập tên sản phẩm">
         </div>
         <div class="form-group">
            <label for="name">Hình:<?=$img;?></label>
            <input type="file" name="img" id="img">
            
         </div>
         <div class="form-group">
            <label for="name">Giá:</label>
            <input type="text" class="form-control" name="price" value="<?=($price>0)?$price:0;?>" id="price" placeholder="Nhập giá">
         </div>
         <div class="form-group">
            <label for="name">Ẩn sản phẩm:</label>
            <input type="checkbox" name="hide" value="1" id="hide">
         </div>
         <div class="form-group">
            <label for="name">Sản phẩm đặc biệt:</label>
            <input type="checkbox" name="dacbiet" value="1" id="dacbiet">
         </div>


         <div class="form-group">
            <input type="hidden" name="id" value="<?=$idupdate?>">
            <button type="submit" onclick="return kiemtraform()" name="updatepro" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-secondary">Nhập lại</button>
         </div>
         <?php
            if(isset($tb)&&($tb!="")){ echo $tb;}
         ?>
      </form>
   </div>
</div>
<script>
   function kiemtraform(){
      var iddm=document.getElementById("iddm");
      if(iddm.value==0){
         alert("Bạn phải chọn danh mục");
         iddm.focus();
         return false;
      }
      var name=document.getElementById("name");
      if(name.value==""){
         alert("Bạn phải nhập tên");
         name.focus();
         return false;
      }
      var img=document.getElementById("img");
      if(img.value==""){
         alert("Bạn phải chọn hình ảnh");
         img.focus();
         return false;
      }
      var price=document.getElementById("price");
      if((price.value<=0)||(price.value=="")){
         alert("Bạn phải nhập giá là số nguyên dương!");
         price.focus();
         return false;
      }
      
      return true;
   }
</script>