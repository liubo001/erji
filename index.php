<?php
// $cookie_jar = dirname(__FILE__)."./cookie/123.cookie";
$cookie_jar = tempnam('./cookie','123');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://search.neea.edu.cn/Imgs.do?act=verify&t=0.8841180045674784");
curl_setopt($ch, CURLOPT_REFERER, "http://search.neea.edu.cn/QueryMarkUpAction.do?act=doQueryCond&sid=300&pram=results");
//设置头文件的信息作为数据流输出
curl_setopt($ch, CURLOPT_HEADER, 0);
//设置获取的信息以文件流的形式返回，而不是直接输出。
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
//执行命令
$img = curl_exec($ch);
curl_close($ch);
$img1 = base64_encode($img);
$img2 = base64_decode($img1);
file_put_contents('./img.png', $img2);
echo "<input type=\"hidden\" id=\"cookie\" value=\"".$cookie_jar."\">";//发送cookie文件地址
?>
<!DOCTYPE html>
<html>
<head>
	<title>二级查询</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <style type="text/css">
    *{
        padding: 0;
        margin: 0;
    }
    li{
        list-style: none;
    }
    .body{
        width: 100%;
        margin: 50px auto;
    }
    h2,h3{
        text-align: center;
    }
    .input{
        width: 100%;
        margin: 0 auto;
    }
    .km,.zjhm,.name,.button{
        margin: 20px auto;
    }
    #submitBtn {
        color: #fff;
        border: 1px solid #007aff;
        background-color: #007aff;
        font-size: 18px;
        display: block;
        width: 100%;
        margin-bottom: 10px;
        padding: 8px 0px;
        font-weight: 400;
        line-height: 1.42;
        cursor: pointer;
        transition-duration: .2s;
        text-align: center;
        vertical-align: top;
        white-space: nowrap;
        transition: all;
        border-radius: 3px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        text-transform: none;
        -webkit-tap-highlight-color: transparent;
        background-clip: padding-box;
    }
    input{
        height: 50px;
        line-height: 30px;
        width: 100%;
        border-radius: 5px;
        border: solid 1px #a9a9a9;
        padding: 0 10px;
        font-size: 16px;
    }
    #bkjb{
        width: 100%;
        height: 30px;
        font-size: 120%;
    }
    img{
        width: 30%;
        /*height: 100px;*/
    }
    .row{
        overflow: hidden;
        font-size: 16px;
        background-color: #fff;
        padding: 10px;
    }
    .row label{
        width: 104px;
        float: left;
        font-weight: bold;
        margin-left: 20px;
        text-align: right;
    }
    .row p{
        float: left;
    }
    .back{
        display:block;
        position:fixed;
        top:0px;
        left:6px;
        text-decoration: none;
        font-size:16px;
        color:#fff;
        float:left;
    }
    .d-back{
        width:100%;
        height:40px;
        background:#F5F5F9;
        border-top:1px solid #ccc;
        border-bottom:1px solid #ccc;
        box-sizing: content-box;
        font-size:12px;
        line-height:40px;
        position: fixed;
        top:0px;
    }
    </style>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="2.js"></script>
</head>
<body>
    <div class="body">
    	<div class="input">
            <h2>计算机二级成绩查询</h2>
    		<ol>
    			<li class="km">
    				<select id="bkjb"></select>
    			</li>
    			<li class="zjhm">
    				<input type="text" id="zjhm" placeholder="请输入证件号码">
    			</li>
    			<li class="name">
    				<input type="text" id="name" placeholder="请输入姓名">
    			</li>
                <img id="img">
                <li>
                    <input type="text" id="verify" placeholder="请填写验证码">
                </li>
    			<li class="button">
                    <button id="submitBtn">查询</button>
    			</li>
    		</ol>
    	</div>
        <div style="display: none;" class="result">
            <div class="d-back" style="background-color:#000;text-align:center;">
                <a href="javascript:location.reload();" class="back">&#60;&nbsp;返回</a>
                <span style="color:#fff;font-weight:800;font-size:18px">查询结果</span>
            </div>
            <div class="row">
                <label>姓名：</label>
                <p id="rname"></p>
            </div>
            <div class="row">
                <label>身份证号：</label>
                <p id="rsfzh"></p>
            </div>
            <div class="row">
                <label>准考证号：</label>
                <p id="rzkzh"></p>
            </div>
            <div class="row">
                <label>考试级别：</label>
                <p id="dj"></p>
            </div>
            <div class="row">
                <label>总分：</label>
                <p id="cj"></p>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('$(\'#8\').A(\'M\',\'8.Q?r= \'+11.y()+\'\');1 v=$(\'#8\').P();$(\'#8\').j(\'R\',v*0.T);$(\'#V\').10(i(){1 c=$(\'#s\').6();1 d=$(\'#n\').6();1 e=$(\'#h\').6();1 f=$(\'#t\').6();1 g=$(\'#Z\').6();2(!d.7){5(\'请输入证件号码！\');l}2(!e.7){5(\'请输入姓名！\');l}2(!f.7){5(\'请输入验证码！\');l}$.z({14:"./k.C",D:"E",F:G,H:{s:c,n:d,h:e,t:f,I:g},J:"K",L:i(a){2(a.h==\'\'){5(\'输入内容有错误,请重新输入！\');N.O()}o{$(\'.p\').q();$(\'.k\').m();$(\'#S\').9(a.h);$(\'#U\').u(a.W);$(\'#X\').9(a.Y);$(\'#4\').9(a.4);$(\'#w\').9(a.w);1 b=$(\'#4\').u().7;2(b==3){$(\'#4\').j(\'x\',\'12\')}o{$(\'#4\').j(\'x\',\'#13\')}}},B:i(){5(\'无法连接服务器！\');$(\'.p\').m();$(\'.k\').q()},})})',62,67,'|var|if||dj|alert|val|length|img|html||||||||name|function|css|result|return|show|zjhm|else|input|hide||bkjb|verify|text|wh|cj|color|random|ajax|attr|error|php|type|POST|async|true|data|cookie_jar|dataType|json|success|src|location|reload|width|png|height|rname|618|rsfzh|submitBtn|sfzh|rzkzh|zkzh|cookie|click|Math|red|f97f02|url'.split('|'),0,{}))
</script>
</html>
