<?php

error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once '../Classes/PHPExcel.php';
include('../clases/conexion.php');

       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       # INICIAMOS LAS VARIABLES
	  
	    # INICIAMOS LAS VARIABLES
	   $where="";
	   $usuario="";   
	   $inicio="";
	   $final="";
	   $area="";
	   $estado="";
	   $tipo="";
	   $categoria="";
	  #
	   $i=0;
	   $j=0;
	   $k=0;
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
	   $categoria=$_GET['categoria'];
	  
	    //ASIGNAMOS EL VALOR LITERAL DE LAS VARIABLES CONSULTADAS
		if($estado=='T'){$it1='TODOS';};
		if($estado=='01'){$it1='PENDIENTE';};
		if($estado=='02'){$it1='APROBADO';};
		
		//
		if($categoria=='01'){$it3='PAPELETAS DE SALIDA';};
		if($categoria=='02'){$it3='PAPELETAS DE TARDANZA';};
		if($categoria=='03'){$it3='PAPELETAS VEHICULARES';};
		if($categoria=='04'){$it3='DOCUMENTOS Y FORMATOS';};
		// 
		if($tipo=='T'){$it2='TODOS';};
		if($tipo=='0000000001'){$it2='COMISION';};
		if($tipo=='0000000002'){$it2='SALUD';};
		if($tipo=='0000000003'){$it2='ASUNTO PERSONAL';};
		if($tipo=='0000000004'){$it2='ASUNTO PARTICULAR';};
		if($tipo=='0000000005'){$it2='VACACIONES';};
		if($tipo=='0000000006'){$it2='ONOMASTICO';};
		if($tipo=='0000000007'){$it2='DESCANSO POR SEPELIO';};
		if($tipo=='0000000008'){$it2='LICENSIA POR PATERNIDAD';};
		if($tipo=='0000000009'){$it2='TRATAMIENTO MEDICO';};
		if($tipo=='0000000010'){$it2='CARTA DE JUSTIFICACION';};
		if($tipo=='0000000011'){$it2='DESCANSO MEDICO';};
        if($tipo=='0000000012'){$it2='LICENSIA SINDICAL';};
		if($tipo=='0000000013'){$it2='FERIADOS';};
        if($tipo=='0000000014'){$it2='SUSPENSION';};
		if($tipo=='0000000015'){$it2='LICENSIA SIN GOZE DE HABER';};
		if($tipo=='0000000016'){$it2='LICENCIA POR MATERNIDAD(PRE-POST NATAL)';};
		//FIN DE LA ASIGANCION  
	    if($categoria=="01"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblsalida.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			//
			
				   
$sql_guardar1="select tblsalida.Codigo,NombreCom,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado,Fundamento
from tblsalida,tblusuario WHERE NOT(Statuss='04' || TipoMotivo='0000000005' || TipoMotivo='0000000007' || TipoMotivo='0000000008' || TipoMotivo='0000000009' || TipoMotivo='0000000010' || TipoMotivo='0000000011' || TipoMotivo='0000000012' || TipoMotivo='0000000013' || TipoMotivo='0000000014')
AND tblusuario.Codigo=tblsalida.Usuario AND FecSalida BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";

       $res1 =mysql_query($sql_guardar1,$enlace); 
	  
	   }
	   
	   // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE TARDANZA 
		if($categoria=="02"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tbltardanza.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			
				   
$sql_guardar1="select tbltardanza.Codigo,NombreCom,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Fecha,(CASE Marcado WHEN 'EN1' THEN 'ENTRADA DRSAU' WHEN 'EN2' THEN 'ENTRADA REFRIGERIO' ELSE NULL END) as Marcado,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado,Fundamento
from tbltardanza,tblusuario WHERE NOT(Statuss='04')
AND tblusuario.Codigo=tbltardanza.Usuario AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
 
 
       $res1 =mysql_query($sql_guardar1,$enlace); 
	 
	   }
	   
	   // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE VEHICULAR
		if($categoria=="03"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblvehicular.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			
				   
$sql_guardar1="select tblvehicular.Codigo,NombreCom,(SELECT Modelo from tblauto where tblauto.Codigo=Vehiculo) as Vehi,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Fecha,Destino,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado,Observacion from tblvehicular,tblusuario WHERE NOT(Statuss='04')
AND tblusuario.Codigo=tblvehicular.Usuario AND Fecha BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";
 

       $res1 =mysql_query($sql_guardar1,$enlace); 
	   
	   }
	   
	    // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE VEHICULAR
   
    if($categoria=="04"){
			
		if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblsalida.Statuss='$estado'";};
		if($tipo!="T"){$where=$where." AND TipoMotivo='$tipo'";};
			
				   
$sql_guardar1="select tblsalida.Codigo,NombreCom,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado,Fundamento
from tblsalida,tblusuario WHERE NOT(Statuss='04' || TipoMotivo='0000000002')
AND tblusuario.Codigo=tblsalida.Usuario AND FecSalida BETWEEN '$inicio' AND '$final' ".$where." ; 
 ";

       $res1 =mysql_query($sql_guardar1,$enlace); 
	  
	   }
   //--
	   
	   //------------
	while ($reg = mysql_fetch_array($res1))
                            {    $i++;
								$data[]=array_merge($reg);
								
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

            ->setCellValue('A1', 'REPORTES DE DOCUMENTOS GENERADOS')
			->setCellValue('A3', 'USUARIO: ')
			->setCellValue('B3',  $usuario)
			->setCellValue('A5', 'DESDE: ')
			->setCellValue('B5',  $inicio)
			->setCellValue('D5', 'HASTA: ')
			->setCellValue('E5',  $final)
			->setCellValue('G3', 'ESTADO: ')
			->setCellValue('H3',  $it1)
			->setCellValue('G5', 'UNIDAD/OFICINA: ')
			->setCellValue('I5',  $area)
			->setCellValue('J3', 'JUSTIFICACION: ')
			->setCellValue('L3',  $it2)
			->setCellValue('P3','CATEGORIA: ')		
			->setCellValue('R3',$it3);
			if($categoria=='01' || $categoria=='04'){
				$objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A7', 'CODIGO')
                  ->setCellValue('C7', 'USUARIO')
                  ->setCellValue('G7', 'FEC.SALIDA')
			->setCellValue('I7','FEC.RETORNO')
			->setCellValue('K7','JUSTIFICACION')
			->setCellValue('M7','LUGAR')
			->setCellValue('P7','ESTADO')
                  ->setCellValue('R7','MOTIVO')
			;
			}
			if($categoria=='02'){
				$objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A7', 'CODIGO')
                  ->setCellValue('C7', 'USUARIO')
                  ->setCellValue('G7', 'MOTIVO')
			->setCellValue('I7','FECHA')
			->setCellValue('K7','TIPO MARCADO')
			->setCellValue('M7','ESTADO')
			->setCellValue('P7','FUNDAMENTO')
                  
			;
			}
			if($categoria=='03'){
				$objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A7', 'CODIGO')
                  ->setCellValue('C7', 'USUARIO')
                  ->setCellValue('G7', 'VEHICULO')
			->setCellValue('I7','FECHA')
			->setCellValue('K7','DESTINO')
			->setCellValue('M7','ESTADO')
			->setCellValue('P7','FUNDAMENTO')
                  
			;
			}
$i=8;
foreach($data as $row)
		{
			
			if($categoria=='01' || $categoria=='04'){
			$objPHPExcel->setActiveSheetIndex(0)	
	     	->setCellValue('A'.$i," ".$row[0]." ")
            ->setCellValue('C'.$i,$row[1])
            ->setCellValue('G'.$i,$row[2])
            ->setCellValue('I'.$i,$row[3])
			->setCellValue('K'.$i,$row[4])
            ->setCellValue('M'.$i," ".$row[5]." ")
		    ->setCellValue('P'.$i," ".$row[6]." ")
			->setCellValue('R'.$i," ".$row[7]." ")
			;
     	
			$i++;$j++;}
			if($categoria=='02'){
			$objPHPExcel->setActiveSheetIndex(0)	
	     	->setCellValue('A'.$i," ".$row[0]." ")
            ->setCellValue('C'.$i,$row[1])
            ->setCellValue('G'.$i,$row[2])
            ->setCellValue('I'.$i,$row[3])
			->setCellValue('K'.$i,$row[4])
            ->setCellValue('M'.$i," ".$row[5]." ")
			->setCellValue('P'.$i," ".$row[6]." ")
		
			;
     	
			$i++;$j++;}
			if($categoria=='03'){
			$objPHPExcel->setActiveSheetIndex(0)	
	     	->setCellValue('A'.$i," ".$row[0]." ")
            ->setCellValue('C'.$i,$row[1])
            ->setCellValue('G'.$i,$row[2])
            ->setCellValue('I'.$i,$row[4])
			->setCellValue('K'.$i,$row[5])
            ->setCellValue('M'.$i," ".$row[6]." ")
			->setCellValue('P'.$i," ".$row[7]." ")
		
			;
     	
			$i++;$j++;}
			};

// Rename sheet
$objPHPExcel->getActiveSheet()->getStyle('A7:V7')->applyFromArray(
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
if($categoria=='01' || $categoria=='04'){
$objPHPExcel->getActiveSheet()->getStyle('P7:Q7')->applyFromArray($styleThinBlackBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('R7:V7')->applyFromArray($styleThinBlackBorderOutline);
}
if($categoria=='02' || $categoria='03'){
$objPHPExcel->getActiveSheet()->getStyle('P7:V7')->applyFromArray($styleThinBlackBorderOutline);
}
//UNE DOS CELDAS O MAS, TENIENDO UNA SOLA CELDA
$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
$objPHPExcel->getActiveSheet()->mergeCells('B3:F3');
$objPHPExcel->getActiveSheet()->mergeCells('J3:K3');
$objPHPExcel->getActiveSheet()->mergeCells('L3:N3');
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
if($categoria=='01' || $categoria=='04'){
$objPHPExcel->getActiveSheet()->mergeCells('P7:Q7');
$objPHPExcel->getActiveSheet()->mergeCells('R7:V7');
}

if($categoria=='02' || $categoria=='03' ){
$objPHPExcel->getActiveSheet()->mergeCells('P7:V7');
}
//realizamos la union de los casilleros que contendran los datos
   for($k=0,$i=8;$k<$j;$k++){
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':F'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('G'.$i.':H'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('I'.$i.':J'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('K'.$i.':L'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('M'.$i.':O'.$i);
if($categoria=='01' || $categoria=='04'){
$objPHPExcel->getActiveSheet()->mergeCells('P'.$i.':Q'.$i);
$objPHPExcel->getActiveSheet()->mergeCells('R'.$i.':V'.$i);}
if($categoria=='02'){
$objPHPExcel->getActiveSheet()->mergeCells('P'.$i.':V'.$i);}
$i++;
   }

//
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);
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
header('Content-Disposition: attachment;filename="Rpt-Documento.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
			}