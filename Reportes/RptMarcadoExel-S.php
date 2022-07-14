<?php

error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once '../Classes/PHPExcel.php';
include('../clases/conexion.php');

//

# INICIAMOS LAS VARIABLES
       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);	  
#	  
	   $where="";
	   $usuario="";   
	   $inicio="";
	   $final="";
	   $area="";
	   $estado="";
	   $tipo="";
	   $data="";
	   $condi="";
	   $i=0;
	   $j="";
	   $k=0;
	   $l=0;
	   $m=0;
	   $tm="";
	   $minu=0;
	   $dcto=0;
	   #DEFINIMOS VARIABLES QUE TENDRAN EL VALOR LITERAL
	   
	   $it1="";
	   $it2=""; 
	   $it3=""; 
	  
	  #
 
       // traemos los datos ingresados en la consulta
	   $usuario=trim($_GET['usuario']);   
	   $inicio=$_GET['inicio'];
	   $final=$_GET['final'];
	   $area=trim($_GET['area']);
	   $estado=$_GET['estado'];
	   $tipo=$_GET['tipo'];
	   $condi=$_GET['condi'];
	   //
	     if($usuario!=""){$where=" AND NombreCom='$usuario'";};
		 if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND (tblmarcado.Condicion='$estado' OR Tblmarcado.condicion='04')";};
		if($tipo!="T"){$where=$where." AND Tipo='$tipo'";};
		if($condi!="T"){$where=$where." AND Tblusuario.Condicion='$condi'";};
		 //
		if($condi=='T'){$it3='TODOS';};
		if($condi=='0000000001'){$it3='CAS';};
		if($condi=='0000000002'){$it3='NOMBRADO';};
		if($condi=='0000000003'){$it3='PROYECTO';};
		if($condi=='0000000004'){$it3='TERCEROS';};
		if($condi=='0000000005'){$it3='ADSCRITO';};
		if($condi=='0000000006'){$it3='CONTRATADO';};
		
		//   
	   //
		if($estado=='T'){ $it1='TODOS';};
		if($estado=='01'){$it1='MARCADO NORMAL';};
		if($estado=='02'){$it1='JUSTIFICADO';};
		if($estado=='03'){$it1='NO MARCO';};
		if($estado=='04'){$it1='TARDANZA';};
		
		// 
		if($tipo=='T'){$it2='TODOS';};
		if($tipo=='EN1'){$it2='ENTRADA DRSAU';};
		if($tipo=='SA1'){$it2='SALIDA REFRIGERIO';};
		if($tipo=='EN2'){$it2='ENTRADA REFRIGERIO';};
		if($tipo=='SA2'){$it2='SALIDA DRSAU';};
      
	     $sql_guardar="SELECT tblusuario.Codigo,NombreCom,
(CASE Tblusuario.Condicion WHEN '0000000001' THEN 'CAS' WHEN '0000000002' THEN 'NOMBRADO' WHEN '0000000003' THEN 'PROYECTO' WHEN '0000000004' THEN 'TERCEROS' WHEN '0000000005' THEN 'ADSCRITOS' WHEN '0000000006' THEN 'CONTRATADO' ELSE NULL END) as Tipo,
TRUNCATE((((Sueldo/31)/8)/60)*Conteo,2) AS dcto,Conteo from tblmarcado,tblusuario where tblmarcado.Usuario=tblusuario.Codigo AND Fecha BETWEEN '$inicio' AND '$final'".$where." ORDER BY  tblusuario.Condicion,tblusuario.NombreCom; 
 ";
 
 
       $res1 =mysql_query($sql_guardar,$enlace);  
	
	while ($reg = mysql_fetch_array($res1))
                            {   $i++;
								$data[]=array_merge($reg);
								$minu=$minu+$reg[4];
			                    $dcto=$dcto+$reg[3];
		                	};
    if($i==0){
					   header("Location:../error3.php");
			         }
			else{	
	   //
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);
// Add some data
$objPHPExcel->setActiveSheetIndex(0)

            ->setCellValue('A1', 'REPORTES DEL MARCADO DE HUELLA DACTILAR')
			->setCellValue('A3', 'USUARIO: ')
			->setCellValue('B3',  $usuario)
			->setCellValue('A5', 'DESDE: ')
			->setCellValue('B5',  $inicio)
			->setCellValue('D5', 'HASTA: ')
			->setCellValue('E5',  $final)
			->setCellValue('G3', 'ESTADO DEL MARCADO: ')
			->setCellValue('J3',  $it1)
			->setCellValue('G5', 'UNIDAD/OFICINA: ')
			->setCellValue('I5',  $area)
			->setCellValue('L3', 'TIPO DE MARCADO: ')
			->setCellValue('N3',  $it2)
            ->setCellValue('A7', 'CODIGO')
            ->setCellValue('C7', 'USUARIO')
            ->setCellValue('G7', 'CONDICION')
			->setCellValue('I7', 'DSCTO TOTAL S/.')
			->setCellValue('P3','TOT.MIN: ')
			->setCellValue('P5','DCTO: ')
			->setCellValue('Q3',$minu)
			->setCellValue('Q5',"S/.".$dcto)
			->setCellValue('S3',"CONDICION:")
			->setCellValue('S5',$it3);
			
$i=8;$k=0;
foreach($data as $row)
		{   $m=$row[0];
			if($k==0)
			{
			$j=$row[0];$l=$row[3];$tm='1';
			}
			else{
				  if($m==$j){
					  $j=$m;
					  $l=$l+$row[3];$tm='1';
					  }
				   else{

					    $l=$row[3];
						$j=$row[0];$i++;
				       }
				}
				
			$objPHPExcel->setActiveSheetIndex(0)	
	     	->setCellValue('A'.$i," ".$row[0]." ")
            ->setCellValue('C'.$i,$row[1])
            ->setCellValue('G'.$i,$row[2])
            ->setCellValue('I'.$i,$l);
			
			$k++;
			};

// Rename sheet
$objPHPExcel->getActiveSheet()->getStyle('A7:T7')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'top'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			),
			'fill' => array(
	 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	  			'rotation'   => 90,
	 			'startcolor' => array(
	 				'argb' => 'FFA0A0A0'
	 			),
	 			'endcolor'   => array(
	 				'argb' => 'FFFFFFFF'
	 			)
	 		)
		)
);


$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray(
		array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'top'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			)
			
		)
);
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('A7:B7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('C7:F7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('G7:H7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('I7:J7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('K7:L7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('M7:O7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('P7:R7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('S7:T7')->applyFromArray($styleThinBlackBorderOutline);
//UNE DOS CELDAS O MAS, TENIENDO UNA SOLA CELDA
$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
$objPHPExcel->getActiveSheet()->mergeCells('B3:F3');
$objPHPExcel->getActiveSheet()->mergeCells('G3:I3');
$objPHPExcel->getActiveSheet()->mergeCells('J3:K3');
$objPHPExcel->getActiveSheet()->mergeCells('L3:M3');
$objPHPExcel->getActiveSheet()->mergeCells('N3:O3');
$objPHPExcel->getActiveSheet()->mergeCells('G5:H5');
$objPHPExcel->getActiveSheet()->mergeCells('B5:C5');
$objPHPExcel->getActiveSheet()->mergeCells('I5:O5');
$objPHPExcel->getActiveSheet()->mergeCells('E5:F5');
$objPHPExcel->getActiveSheet()->mergeCells('A7:B7');
$objPHPExcel->getActiveSheet()->mergeCells('C7:F7');
$objPHPExcel->getActiveSheet()->mergeCells('G7:H7');
$objPHPExcel->getActiveSheet()->mergeCells('I7:J7');
$objPHPExcel->getActiveSheet()->mergeCells('K7:L7');
$objPHPExcel->getActiveSheet()->mergeCells('M7:O7');
$objPHPExcel->getActiveSheet()->mergeCells('P7:R7');
$objPHPExcel->getActiveSheet()->mergeCells('S7:T7');

//realizamos la union de los casilleros que contendran los datos
   for($k=0,$i=8;$k<$j;$k++){
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':F'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('G'.$i.':H'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('I'.$i.':J'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('K'.$i.':L'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('M'.$i.':O'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('P'.$i.':R'.$i);
$i++;
   }

//
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('P5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('P3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('S3')->getFont()->setBold(true);
//
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('DRSAU');
$objDrawing->setDescription('DRSAU');
$objDrawing->setPath('../img/ex.png');
$objDrawing->setCoordinates('L1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
//
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Rpt-Marcado.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
			}