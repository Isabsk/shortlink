<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safflower Infotech Short Link</title>
    <style>
        *{font-family: Verdana; font-weight: bold; font-size: 12px; }
    </style>
</head>
<body style="background-color:powderblue;">
    <center>
        <h2><strong>Enter url here</strong></h2>
        <form action="index.php" method="POST">  
            <input type="text" name="url" id="url">
            <input type="submit" name="submit">
        </form>
    </center>
  
<?php
if(isset($_POST['submit'])){
    $url = $_POST['url'];

$inp = '<style>*{font-family: Verdana; font-weight: bold; font-size: 12px;background-color:powderblue;}</style><meta http-equiv="refresh" content="0;url='.$url.'" /><br><h2><strong>You Will Be Redirected in 3 Seconds</strong></h2>
<?php 
$ipadd = $_SERVER["REMOTE_ADDR"];

$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ipadd));

$countryname = $ipdat->geoplugin_countryName;
$state = $ipdat->geoplugin_regionName;
$lat = $ipdat->geoplugin_latitude;
$long = $ipdat->geoplugin_longitude;

$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$origionalurl = "'.$url.'";

$user_agent = $_SERVER["HTTP_USER_AGENT"];

    $os_platform    = "Unknown OS Platform";
    $os_array       = array("/windows phone 10/i"    =>  "Windows Phone 10",
    						"/windows phone 8/i"    =>  "Windows Phone 8",
                            "/windows phone os 7/i" =>  "Windows Phone 7",
                            "/windows nt 10.0/i"     =>  "Windows 10",
                            "/windows nt 6.3/i"     =>  "Windows 8.1",
                            "/windows nt 6.2/i"     =>  "Windows 8",
                            "/windows nt 6.1/i"     =>  "Windows 7",
                            "/windows nt 6.0/i"     =>  "Windows Vista",
                            "/windows nt 5.2/i"     =>  "Windows Server 2003/XP x64",
                            "/windows nt 5.1/i"     =>  "Windows XP",
                            "/windows xp/i"         =>  "Windows XP",
                            "/windows nt 5.0/i"     =>  "Windows 2000",
                            "/windows me/i"         =>  "Windows ME",
                            "/win98/i"              =>  "Windows 98",
                            "/win95/i"              =>  "Windows 95",
                            "/win16/i"              =>  "Windows 3.11",
                            "/macintosh|mac os x/i" =>  "Mac OS X",
                            "/mac_powerpc/i"        =>  "Mac OS 9",
                            "/linux/i"              =>  "Linux",
                            "/ubuntu/i"             =>  "Ubuntu",
                            "/iphone/i"             =>  "iPhone",
                            "/ipod/i"               =>  "iPod",
                            "/ipad/i"               =>  "iPad",
                            "/android/i"            =>  "Android",
                            "/blackberry/i"         =>  "BlackBerry",
                            "/webos/i"              =>  "Mobile");
        $found = false; 
        $device = "";   

            foreach ($os_array as $regex => $value)
            {
                if($found)
                 break;
                else if (preg_match($regex, $user_agent))
                {
                    $os_platform    =   $value;
                    $device = !preg_match("/(windows|mac|linux|ubuntu)/i",$os_platform)
                              ?"MOBILE":(preg_match("/phone/i", $os_platform)?"MOBILE":"PC");
                }
            }  

            $device = !$device? "SYSTEM":$device;

        $browser = "Unknown Browser"; 
        $browser_array  = array("/msie/i"       =>  "Internet Explorer",
                            "/firefox/i"    =>  "Firefox",
                            "/safari/i"     =>  "Safari",
                            "/chrome/i"     =>  "Chrome",
                            "/opera/i"      =>  "Opera",
                            "/netscape/i"   =>  "Netscape",
                            "/maxthon/i"    =>  "Maxthon",
                            "/konqueror/i"  =>  "Konqueror",
                            "/mobile/i"     =>  "Handheld Browser");  

            foreach ($browser_array as $regex => $value)
            {
                if($found)
                 break;
                else if (preg_match($regex, $user_agent,$result))
                {
                    $browser    =   $value;
                }
            } 

$inp = "Short Link: ".$url." , \n Origional Url: ".$origionalurl." , \n IP Address: ".$ipadd." ,\n Country: ".$countryname." ,\n State: ".$state." ,\n Device: ".$device." ,\n OS: ".$os_platform." ,\n Browser: ".$browser." ,\n Lattitude: ".$lat." ,\n Longitude: ".$long."\n ---------------------------------------------------------------------";  

$fp =   fopen("../log.txt", "a");
        fwrite($fp, $inp."\n");
        fclose($fp);                              

?>';


    function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $rann = generateRandomString(2);
    
    if (!file_exists($rann)) {
        mkdir($rann, 0777, true);
        
        $fp = fopen($rann."/index.php", "a");
        fwrite($fp, $inp);
        fclose($fp);
    }

    echo '
    <a href="https://'.$_SERVER['HTTP_HOST'].'/short-url/'.$rann.'">This is your shorten url </a><br />
    <textarea height="25" width="100">https://'.$_SERVER['HTTP_HOST'].'/short-url/'.$rann.'</textarea>';
    }
?>

</body>
</html>