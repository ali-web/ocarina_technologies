<?php
    require dirname(__FILE__)."/../../core/auth.php";
    page_protect();
    $title = "یون مورد نظر شما غیرفعال شده است";
    require_once dirname(__FILE__).'/../../template/header.php';
?>

<style type="text/css">
    
    #main{
        text-align: justify;
    }
    
    #main h2{
        margin: 20px 0 10px;    
    }
    
    #main ul li{
        margin-right: 40px;
        margin-top: 15px;
    }
    
    .code_box{
        direction: ltr;
        background: #FFF7F2;
        border: solid 1px #FF9866;
        padding: 10px 20px;
        margin-bottom: 10px;
    }
    
    a{
        color: #66B3FF;
    }

    .not-found{
        color: maroon;
    }
</style>



<p class="not-found">
به علت دریافت شکایت از کاربران، یون مورد نظر شما تا اطلاع ثانوی غیرفعال شده است.
</p>


<?php require_once dirname(__FILE__).'/../../template/footer.php'; ?>