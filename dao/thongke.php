<?php

    function thongke_sp(){
        return pdo_query_value("SELECT COUNT(*) FROM sanpham");
    }

    function thongke_tv(){
        return pdo_query_value("SELECT COUNT(*) FROM user");
    }

    function thongke_dm(){
        return pdo_query_value("SELECT COUNT(*) FROM danhmuc");
    }
?>