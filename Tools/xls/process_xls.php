<?php
//禁用错误报告
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
require_once('./lib/PHPExcel.php'); 
$PHPExcel = new PHPExcel();
  /**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/ 
$php_reader = new PHPExcel_Reader_Excel2007();  

$filePath ="D:/post_data.xls";

if(!$php_reader->canRead($filePath))  
{
        $php_reader= new PHPExcel_Reader_Excel5();
        if(!$php_reader->canRead($filePath))
        {  
                echo'NO Excel!';
                return;
        }
}

$PHPExcel = $php_reader->load($filePath);  
  
$current_sheet =$PHPExcel->getSheet(0);  
$highestRow =$current_sheet->getHighestRow();//获取行数
$highestColumm =$current_sheet->getHighestColumn();//获取列数
//字母列转换为数字列 如:AA变为27


?>
<html>
  <head>
    <title>查看上传数据</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="images/x-icon"/>
  </head>
  <body>
  <?php
  /** 循环读取每个单元格的数据 */
for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
	if($row<=20){
		for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以第0列开始
			$val = $current_sheet->getCellByColumnAndRow(ord($column) - 65,$row)->getValue();/**ord()将字符转为十进制数*/ 
					echo $val." \t|\t ";
                /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/ 
                //echo iconv('utf-8','gb2312', $val)."\t"; 
		}
			echo "<br/>";
	}else{
		break;
	}
}
  ?>
  </body>
</html>
