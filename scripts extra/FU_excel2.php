<?php
require_once 'PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

//Parametros configuracion bbdd
include("config.php");

    $string = "SELECT cliente, matricula,idCoche, nombre, intervencion.estado, intervencion.id";
    $string = $string.",SEC_TO_TIME(SUM(TIME_TO_SEC(SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT))))) HORAS ";
    $string = $string."FROM persona INNER JOIN( intervencion INNER JOIN coche ";
    $string = $string."ON intervencion.idCoche = coche.idCar) ON persona.id = intervencion.idMec ";
    $string = $string."WHERE intervencion.estado='finalizado' GROUP BY idCoche ORDER BY idCoche ASC";

 $resultado=mysql_query($string, $conexio);

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
            ->setCellValue('A1', "CLIENTE")
            ->setCellValue('B1', "MATRICULA")
            ->setCellValue('C1', "HORAS INVER");
//---------------------RESTO DE DATOS-----------------------//
$i= 2;
while($registro = mysql_fetch_array($resultado)){

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $registro['cliente'])
            ->setCellValue('B'.$i, $registro['matricula'])
            ->setCellValue('C'.$i, $registro['HORAS']);

      $i++;
            

//-----------------------------------------------------------------//
      $c="SELECT comentario, cliente, estado, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT)) TIME, matricula, nombre, horaIn, horaOUT FROM coche INNER JOIN ( intervencion INNER JOIN persona ON intervencion.idMec = persona.id) ON intervencion.idCoche = coche.idCar WHERE coche.matricula='".$registro['matricula']."'";
      $l = mysql_query($c, $conexio);
      $rs = mysql_num_rows($l);

      if ($rs > 0) {
      
//---------------------CABEZERA--------------------------//
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('E'.$i, "CLIENTE")
                  ->setCellValue('F'.$i, "MATRICULA")
                  ->setCellValue('G'.$i, "MECANICO")
                  ->setCellValue('H'.$i, "INICIO")
                  ->setCellValue('I'.$i, "FINALIZACION")
                  ->setCellValue('J'.$i, "TIEMPO")
                  ->setCellValue('K'.$i, "COMENTARIOS");
      //---------------------RESTO DE DATOS-----------------------//
            $i++;

      while($re = mysql_fetch_array($l)){

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E'.$i, $re['cliente'])
                        ->setCellValue('F'.$i, $re['matricula'])
                        ->setCellValue('G'.$i, $re['nombre'])
                        ->setCellValue('H'.$i, $re['horaIn'])
                        ->setCellValue('I'.$i, $re['horaOUT'])
                        ->setCellValue('J'.$i, $re['TIME'])
                        ->setCellValue('K'.$i, $re['comentario']);

                        $i++;

            }

}

//---------------------------------------------------------------//      
$i++;
$i++;
}

}

$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="interv_mecanic.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

mysql_close();
exit;

?>