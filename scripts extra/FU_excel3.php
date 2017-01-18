<?php
require_once 'PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();


//Parametros configuracion bbdd
include("config.php");

 $cadena="SELECT cliente,nevera FROM coche WHERE nevera > 0";
 $resultado=mysql_query($cadena, $conexio);

 $registros = mysql_num_rows($resultado);

if ($registros > 0) {
	
$objPHPExcel->
	getProperties()
		->setCreator("talleres_agrim")
		->setLastModifiedBy("talleres_agrim")
		->setTitle("NEVERA DE HORAS")
		->setSubject("datos de coches")
		->setDescription("todos los datos de vehiculos para reparacion")
		->setKeywords("coche excel datos")
		->setCategory("reportes");
//---------------------CABEZERA--------------------------//
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "cliente")
            ->setCellValue('B1', "HORAS");
//---------------------RESTO DE DATOS-----------------------//
$i= 2;
while($registro = mysql_fetch_array($resultado)){

	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $registro['cliente'])
            ->setCellValue('B'.$i, $registro['nevera']);

	$i++;

}

}

$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="nevera.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

mysql_close();
exit;

?>