<?php
require_once 'PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();


//Parametros configuracion bbdd
include("config.php");

 $cadena="SELECT * FROM coche WHERE 1";
 $resultado=mysql_query($cadena, $conexio);

 $registros = mysql_num_rows($resultado);

if ($registros > 0) {
	
$objPHPExcel->
	getProperties()
		->setCreator("talleres_agrim")
		->setLastModifiedBy("talleres_agrim")
		->setTitle("Datos de coches")
		->setSubject("datos de coches")
		->setDescription("todos los datos de vehiculos para reparacion")
		->setKeywords("coche excel datos")
		->setCategory("reportes");
//---------------------CABEZERA--------------------------//
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "cliente")
            ->setCellValue('B1', "marca")
            ->setCellValue('C1', "matricula")
            ->setCellValue('D1', "matriculacion")
            ->setCellValue('E1', "distrib_KMS")
            ->setCellValue('F1', "bastidor")
            ->setCellValue('G1', "f_revision")
            ->setCellValue('H1', "revision_KMS")
            ->setCellValue('I1', "ITV")
            ->setCellValue('J1', "next_ITV")
            ->setCellValue('K1', "filtro_aire")
            ->setCellValue('L1', "filtro_aceite")
            ->setCellValue('M1', "filtro_combustible")
            ->setCellValue('N1', "aceite_motor");
//---------------------RESTO DE DATOS-----------------------//
$i= 2;
while($registro = mysql_fetch_array($resultado)){

	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $registro['cliente'])
            ->setCellValue('B'.$i, $registro['marca'])
            ->setCellValue('C'.$i, $registro['matricula'])
            ->setCellValue('D'.$i, $registro['matriculacion'])
            ->setCellValue('E'.$i, $registro['distrib_KMS'])
            ->setCellValue('F'.$i, $registro['bastidor'])
            ->setCellValue('G'.$i, $registro['f_revision'])
            ->setCellValue('H'.$i, $registro['revision_KMS'])
            ->setCellValue('I'.$i, $registro['ITV'])
            ->setCellValue('J'.$i, $registro['next_ITV'])
            ->setCellValue('K'.$i, $registro['filtro_aire'])
            ->setCellValue('L'.$i, $registro['filtro_aceite'])
            ->setCellValue('M'.$i, $registro['filtro_combustible'])
            ->setCellValue('N'.$i, $registro['aceite_motor']);

	$i++;

}

}

$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Fichas_clientes.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

mysql_close();
exit;

?>