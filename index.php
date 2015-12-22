<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo  $text =$_REQUEST['txt']; ?>天气情况</title>
    <style>
    *{pading:0;margin: 0;}
    .waterbox{width: 100%;}
    .citybox{margin: 50px auto;width: 60%;}
    .city{color: red}
    .city span{font-weight: bold;}
    </style>
</head>
<body>
    <?php 
header("content-type:text/html;charset=utf-8");
include_once  "./weather.class.php";
 $text =$_REQUEST['location_c'];
echo '<div class="waterbox">';
echo '<div class="citybox">';
 echo '<p class="city">你查询的城市是:<span>&nbsp;&nbsp;'.$text.'</span></p>';
 echo '<br/>';
 
$appkey = '902b689cae6ccba5d0a659a50a980688'; //您申请的天气查询appkey
$weather = new weather($appkey);
$cityWeatherResult = $weather->getWeather($text);
if($cityWeatherResult['error_code'] == 0){    //以下可根据实际业务需求，自行改写
    //////////////////////////////////////////////////////////////////////
    $data = $cityWeatherResult['result'];
    echo "=======当前天气实况=======<br/>";
    echo "温度：".$data['sk']['temp']."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "风向：".$data['sk']['wind_direction']."&nbsp;&nbsp;&nbsp;&nbsp;（".$data['sk']['wind_strength']."）";
    echo "湿度：".$data['sk']['humidity']."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<br/><br/>";
 
    echo "=======未来几天天气预报=======<br/>";
    foreach($data['future'] as $wkey =>$f){
        echo "日期:".$f['date']." ".$f['week']." ".$f['weather']." ".$f['temperature']."<br/>";
    }
    echo "<br/><br/>";
 
    echo "=======相关天气指数=======<br/>";
    echo "穿衣指数：".$data['today']['dressing_index']." , ".$data['today']['dressing_advice']."<br/>";
    echo "紫外线强度：".$data['today']['uv_index']."<br/>";
    echo "舒适指数：".$data['today']['comfort_index']."<br/>";
    echo "洗车指数：".$data['today']['wash_index'];
    echo "<br/><br/>";
 
}else{
    echo $cityWeatherResult['error_code'].":".$cityWeatherResult['reason'];
}

if (error_code==203901) {
    # code...
    echo "查询城市不能为空";
}
echo '</div>';
echo '</div>';
 ?>
</body>
</html>