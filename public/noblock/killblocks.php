<?php
try{
    // $pdo = new PDO('mysql:host=127.0.0.1;dbname=lezunsys;port=3306','username','password');
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=lezun;port=3306','root','xya197a3321');
    $pdo->exec('set names utf8');
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $e){
    // echo '数据库连接失败'.$e->getMessage();
}

function dump($var, $echo = true, $label = null, $flags = ENT_SUBSTITUTE)
{

    $label = (null === $label) ? '' : rtrim($label) . ':';
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
    if (false) {
        $output = PHP_EOL . $label . $output . PHP_EOL;
    } else {
        if (!extension_loaded('xdebug')) {
            $output = htmlspecialchars($output, $flags);
        }
        $output = '<pre>' . $label . $output . '</pre>';
    }
    if ($echo) {
        echo($output);
        return null;
    } else {
        return $output;
    }
}

$sql = 'SELECT https_server FROM lz_setting limit 1';
$aa = $pdo->prepare($sql);
$aa->execute();
$res = $aa->fetchAll();

if(empty($res[0]['https_server'])){
    echo '无链接';
    exit;
}else{
    $server = $res[0]['https_server'];
}

$id="0";
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    if($id=='6776'||$id=='8012'||$id=='8417'||$id=='7135'||$id=='7337'||$id=='7679'||$id=='7908'||$id=='8715'||$id=='789'||$id=='10218'){
        $server = 'https://www.anlihuipt.com';
    }
    if($id=='7679'){
        echo "document.write('<script src=".$server."/img/cj".$id."><\/script>');";
    }else{
        echo "document.write('<script src=".$server."/img/".$id."><\/script>');";
    }
}
exit;	