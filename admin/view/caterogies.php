<?php
   $html_dsdm ="";
   foreach ($dsdm as $item) {
      extract($item);
      $html_dsdm .='<tr>
                     <td>'.$name.'</td>
                     <td>'.$Soluong.'</td>
                     <td>'.$ngay.'</td>
                     <td>
                        <a href="#" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
                     </td>
                  </tr>';
   }
?>
<div class="main-content">
   <h3 class="title-page">
      Danh mục
   </h3>
   <div class="d-flex justify-content-end">
      <a href="index.php?pg=caterogies_add" class="btn btn-primary mb-2">Thêm danh mục</a>
   </div>
   <table id="example" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>Name</th>
            <th>Số lượng</th>
            <th>Start date</th>
            <th>Thao tác</th>
         </tr>
      </thead>
      <tbody>
      <?=$html_dsdm;?>
         <!-- <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>2011-04-25</td>
            <td>
               <a href="#" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
               <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
            </td>
         </tr> -->
         
      </tbody>
      <tfoot>
         <tr>
            <th>Name</th>
            <th>Số lượng</th>
            <th>Start date</th>
            <th>Thao tác</th>
         </tr>
      </tfoot>
   </table>
</div>
</div>
</div>
<script src="assets/js/main.js"></script>
<script>
new DataTable('#example');
</script>