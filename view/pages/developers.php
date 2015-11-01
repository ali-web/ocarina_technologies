<?php
    require dirname(__FILE__)."/../../core/auth.php";
    page_protect();
    $title = "مستندات لازم برای توسعه دهندگان";
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
</style>

<p>
این بخش برای توسعه دهندگان و وب مسترهایی تهیه شده است که تمایل دارند از api کوتاه کننده لینک دو و دو در وبسایت یا وبلاگ خود استفاده کنند و بدین وسیله به کاربران و بازدیدکنندگان وبسایت خود این امکان را بدهند تا بدون نیاز به مراجعه به سایت دو و دو ، لینک های خود را کوتاه کنند. <br /><br />
اگر به دنبال ابزارهای کوتاه کننده لینک نظیر افزونه های کروم و فایرفاکس هستید ، به صفحه <a href="#">ابزارها</a> مراجعه نمایید. <br />

</p>


<p style="direction: rtl; ">کلیه درخواست ها باید به آدرس <strong>/http://api.st_.ir&nbsp;</strong>ارسال شوند. ارسال درخواست از طریق هر دو متد <strong>POST&nbsp;</strong>و <b>GET</b>&nbsp;امکان پذیر می باشد ، هر چند که استفاده از متد POST به توسعه دهندگان توصیه می گردد.<br />
به عنوان مثال درخواست زیر با استفاده از متد GET انجام می پذیرد :</p>

<p>&nbsp;</p>

<div class="code_box">​http://api.st_.ir/?url=http%3A%2F%2Fgoogle.com%2Fhelp&amp;wish=google</div>

<p style="direction: rtl;">در درخواست فوق ، آدرس http://google.com به عنوان لینک بلند و رشته google به عنوان آدرس custom ارسال شده است.</p>
<br /><br />
<p style="direction: rtl; ">در هر درخواست شما باید پارامترهای ورودی را همراه با درخواست ارسال کنید و پس از پردازش درخواست ، خروجی را مطابق با فرمتی که درخواست نموده اید ، دریافت خواهید کرد.<br />
ورودی هر درخواست شامل یک پارامتر اجباری و تعدادی پارامتر اختیاری خواهد بود که در زیر به بررسی آن ها خواهیم پرداخت.</p>

<h2 style="direction: rtl;">پارامترهای ورودی :</h2>

<ul dir="rtl">
	<li><strong>url ( اجباری&nbsp;) :</strong> تنها پارامتر اجباری برای ارسال یک درخواست است که باید حاوی URL مورد نظر شما جهت کوتاه شدن باشد. در صورتی که مقدار ارسال شده یک آدرس معتبر اینترنتی نباشد ، سرویس ما یک پیغام خطا تولید خواهد کرد و آدرس وارد شده کوتاه نخواهد شد.<br />
	<strong>نکته مهم :</strong> تمامی URL هایی که ارسال می شوند باید <strong>encode&nbsp;</strong>شده باشند. اکثر زبان های برنامه نویسی برای encode کردن آدرس های اینترنتی ، توابعی را در نظر گرفته اند . مثلا در جاوااسکرپیت می توانید از تابع encodeURIComponent برای این موضوع استفاده کنید. در زبان های سمت سرور مثل PHP نیز توابعی نظیر rawurlencode برای این موضوع تدارک دیده شده اند. برای اطلاعات بیشتر به&nbsp;<a href="http://www.w3schools.com/tags/ref_urlencode.asp" target="_blank">http://www.w3schools.com/tags/ref_urlencode.asp</a><span>&nbsp;مراجعه نمایید.</span></li>
	<li><span style="line-height: 18px;"><strong>wish ( اختیاری ) :</strong> پارامتری اختیاری است که امکان انتخاب آدرس کوتاه شده را به کاربر می دهد . آدرس انتخابی باید بین 4 تا 10 کاراکتر بوده و شامل کاراکترهای غیر مجازی نباشد ( کاراکترهای مجاز شامل حروف کوچک و بزرگ الفبای انگلیسی و ارقام 0 تا 9 هستند&nbsp;). همچنین آدرس انتخابی نباید قبلا استفاده شده باشد. در صورتی که آدرس انتخابی تکراری باشد ، سیستم ایجاد پیغام خطا خواهد کرد و کاربر می تواند آدرس دیگری را انتخاب نماید.</span></li>
	<li><span style="line-height: 18px;"><strong>language ( اختیاری ) :</strong> مقدار این پارامتر به صورت پیش فرض <strong>fa&nbsp;</strong>است که نشان دهنده زبان فارسی سیستم است. در صورتی که تمایل دارید زبان سیستم انگلیسی باشد ، می تواند مقدار <strong>en&nbsp;</strong>برای این پارامتر ارسال نمایید.</span></li>
	<li><span style="line-height: 18px;"><strong>format ( اختیاری ) :</strong> فرمت خروجی ارسالی به وسیله سیستم را تعیین می کند. این پارامتر می تواند مقادیر json , xml , text را به خود بگیرد. مقداری پیش فرض این پارامتر json می باشد که باعث می شود سیستم در هر درخواست به صورت پیش فرض ، خروجی خود را با این فرمت تولید کند. برای پردازش خروجی تولید شده با این فرمت نیز امکاناتی در زبان های مختلف تدارک دیده شده است. اگر از فریم ورک JQuery برای ارسال درخواست ajax استفاده می کنید ، می توانید با دادن مقدار json به پارامتر dataType در درخواست ایجاد شده ، امکان پردازش خودکار json به وسیله JQuery را فراهم سازید. در زبان PHP نیز می توانید از توابعی مثل json_decode استفاده نمایید.</span></li>
</ul>

<h2 dir="rtl"><span style="line-height: 18px;">​پارامترهای خروجی :</span></h2>

<ul dir="rtl">
	<li><span style="line-height: 18px;"><strong>status :</strong> اگر فرآیند کوتاه کردن لینک با موفقیت انجام شود ، مقدار این متغیر true و اگر سیستم ایجاد خطا کند مقدار آن false خواهد بود.</span></li>
	<li><span style="line-height: 18px;"><strong>output :</strong> در صورت موفقیت آمیز بودن فرآیند کوتاه کردن لینک ، این متغیر حاوی آدرس کوتاه شده لینک ورودی است . اما اگر سیستم ایجاد خطا کند ، مقدار این پارامتر پیغام خطای مربوط به خطای ایجاد شده خواهد بود . در واقع شما باید با چک کردن مقدار status در یک عبارت شرطی ، از نوع اطلاعات موجود در این پارامتر باخبر شوید.</span></li>
	<li><span style="line-height: 18px;"><strong>clicks :</strong> شامل تعداد کلیک هایی است که تا کنون بر روی لینک کوتاه شده جاری صورت گرفته است. اگر سیستم ایجاد خطا کرده باشد ، مقدار آن برابر NULL خواهد بود.<br />
	<strong>نکته :</strong> در صورتی که لینک بلند ارسالی قبلا توسط کاربر دیگری کوتاه شده باشد ، و همچنین آدرس custom به وسیله کاربر جدید انتخاب نشود ، سیستم آدرس کوتاه جدید تولید نخواهد کرد و همان آدرس کوتاه قبلی را بر میگرداند. در نتیجه پارامتر clicks نشان دهنده تعداد کلیک هایی است که قبلا بر روی این آدرس کوتاه شده صورت گرفته است. اما اگر کاربر آدرس custom انتخاب کند ، طبیعی است که مقدار پارمتر clicks برابر عدد 0 خواهد بود.</span></li>
</ul>
<br /><br />
<p dir="rtl"><span style="line-height: 18px;">​در ادامه ، کد مربوط به ارسال یک درخواست نمونه را می آوریم که از فریم ورک JQuery استفاده می کند :</span></p>

<p dir="rtl" style="direction: ltr; "><span style="line-height: 18px;">​</span></p>

<div class="code_box" style="">
<p><code>var params = {<br />
&nbsp; &nbsp; &#39;url&#39; : &#39;http://google.com&#39;,<br />
&nbsp; &nbsp; &#39;wish&#39; : &#39;google&#39;,<br />
&nbsp; &nbsp; &#39;language&#39; : &#39;en&#39;<br />
}</code></p>

<p><code>$.ajax{<br />
&nbsp; &nbsp; type : &#39;POST&#39;,<br />
&nbsp; &nbsp; url &nbsp;: &#39;http://api.st_.ir/&#39;,<br />
&nbsp; &nbsp; data : params,<br />
&nbsp; &nbsp; dataType : &#39;json&#39;,<br />
&nbsp; &nbsp; cache : false,<br />
&nbsp; &nbsp; success : function(value){<br />
&nbsp; &nbsp; &nbsp; &nbsp; // do something with value.status , value.output , value.clicks<br />
&nbsp; &nbsp; }<br />
&nbsp; &nbsp; error : function(){<br />
&nbsp; &nbsp; &nbsp; &nbsp; // show some error<br />
&nbsp; &nbsp; }<br />
}</code></p>
</div>









<?php require_once dirname(__FILE__).'/../../template/footer.php'; ?>