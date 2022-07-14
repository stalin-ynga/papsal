<? 

       include('../clases/conexion.php');

       $enlace=conexion();
	   
       mysql_select_db('dbpap', $enlace);
	   
       # INICIAMOS LAS VARIABLES
	  
	   $usuario="";   
	   $inicio="";
	   $final="";
	   $area="";
	   $estado="";
	   $tipo="";
	   $data="";
	   $condi="";
	   $i=0;
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
	  
	   
	   // verificamos si hay datos en las cajas de texto
	    if($usuario!=""){$where=" AND NombreCom='$usuario'";};
	    if($area!=""){$where=$where." AND Area=(SELECT Codigo from tblarea where Nombre='$area')";};
		if($estado!="T"){$where=$where." AND tblmarcado.Condicion='$estado'";};
		if($tipo!="T"){$where=$where." AND Tipo='$tipo'";};
		if($condi!="T"){$where=$where." AND Tblusuario.Condicion='$condi'";};  
	   //
		if($estado=='T'){$it1='TODOS';};
		if($estado=='01'){$it1='MARCADO NORMAL';};
		if($estado=='02'){$it1='JUSTIFICADO';};
		if($estado=='03'){$it1='NO MARCO';};
		if($estado=='04'){$it1='TARDANZA';};
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
		if($tipo=='T'){$it2='TODOS';};
		if($tipo=='EN1'){$it2='ENTRADA DRSAU';};
		if($tipo=='SA1'){$it2='SALIDA REFRIGERIO';};
		if($tipo=='EN2'){$it2='ENTRADA REFRIGERIO';};
		if($tipo=='SA2'){$it2='SALIDA DRSAU';};
		//  
       $sql_guardar="select tblmarcado.Codigo,NombreCom,Fecha,Conteo,(CASE Tipo WHEN 'EN1' THEN 'ENTRADA DRSAU' WHEN 'SA1' THEN 'SALIDA REFRIGERIO' WHEN 'EN2' THEN 'ENTRADA REFRIGERIO' WHEN 'SA2' THEN 'SALIDA DRSAU' ELSE NULL END) as Tipo,Papeleta,tblmarcado.Estado,TRUNCATE((((Sueldo/31)/8)/60)*Conteo,2) AS dcto from tblmarcado,tblusuario WHERE tblusuario.Codigo=tblmarcado.Usuario AND Fecha BETWEEN '$inicio' AND '$final'".$where." ORDER BY  tblusuario.Condicion,tblusuario.NombreCom  ; 
 ";
    $res1 =mysql_query($sql_guardar,$enlace);  
	
	while ($reg = mysql_fetch_array($res1))
                            {   $i++;
								$data[]=array_merge($reg);
								$minu=$minu+$reg[3];
			                    $dcto=$dcto+$reg[7];
		                	};
							
			if($i==0){
					   header("Location:../error3.php");
			         }
			else{			
				   
//------------------------------
ob_end_clean();			
require('fpdf.php');

class PDF extends FPDF
{ var $usuario;
  var $inicio;
  var $fin;
  var $estado;
  var $tipo;
  var $area;
  var $minu;
  var $dcto;
	
function DATACAB($usuario,$inicio,$final,$estado,$tipo,$area,$min,$dcto)
{
	$this->usuario=$usuario;
	$this->inicio=$inicio;
	$this->fin=$final;
	$this->estado=$estado;
	$this->tipo=$tipo;
	$this->area=$area;
	$this->minu=$min;
	$this->dcto=$dcto;
	
	
	}

function Header()
{

$this->SetLineWidth(1.4);
$s=sprintf('[%.3F %.3F] 0 d',10,10);
$this->_out($s);
$this->Rect(10,70,1140,60); 
$s='[] 0 d';
$this->_out($s);
$this->Image('../images/UTI1.png',40,3,65);
$this->Image('../images/UTI2.png',1050,3,65);
$this->SetFont('Arial','B',22);
$this->Cell(530);
$this->Cell(45,4,'GOBIERNO REGIONAL DE UCAYALI',0,0,'C');
$this->Ln(4);
$this->Cell(80);
$this->SetFont('Arial','B',22);
$this->Cell(45,10,'',0,0,'C');
$this->Ln(3);
$this->Cell(530);$this->SetFont('Arial','B',22);
$this->Cell(45,12,'DIRECCION REGIONAL SECTORIAL DE AGRICULTURA DE UCAYALI',0,0,'C');//
$this->Ln(5);
$this->Cell(80);
$this->SetFont('Arial','B',22);
$this->Cell(45,10,'',0,0,'C');
$this->Ln(5);
$this->Cell(530);$this->SetFont('Arial','B',22);
$this->Cell(45,12,'OFICINA DE ADMINISTRACION',0,0,'C');//
$this->Ln(5);
$this->Cell(80);
$this->SetFont('Arial','B',22);
$this->Cell(45,10,'',0,0,'C');
$this->Ln(5);
$this->Cell(530);$this->SetFont('Arial','B',22);
$this->Cell(45,12,'UNIDAD DE TECNOLOGIAS DE LA INFORMACION',0,0,'C');//
$this->Ln(33);
//
$this->Cell(0.1);
$this->SetFont('Times','B',32);$this->SetFillColor(200,220,255);
$this->Cell(1140,15,'Reportes Del Marcado De Huella Dactilar',0,'1LB','C',true);
$this->Cell(90,20,'USUARIO: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(350,20,$this->usuario,0,0,'L');$this->SetFont('Times','B',32);
$this->Cell(110,20,'TIPO MARCADO: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(100,20,$this->tipo,0,0,'L');$this->SetFont('Times','B',32);
$this->Cell(80,20,'ESTADO: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(221,20,$this->estado,0,0,'L');$this->SetFont('Times','B',32);
$this->Cell(145,20,'TOTAL MIN ACUMULADO: ',0,0,'C');$this->SetFont('Times','',35);$this->Cell(45,20,$this->minu,0,0,'L');
$this->Ln(20);$this->SetFont('Times','B',34);//salta a la sgte linea de la cabezera
$this->Cell(90,20,'DESDE: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(100,20,$this->inicio,0,0,'L');$this->SetFont('Times','B',34);
$this->Cell(90,20,'HASTA: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(100,20,$this->fin,0,0,'L');$this->Cell(11);
$this->SetFont('Times','B',32);
$this->Cell(110,20,'UNIDAD/OFICINA: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(450,20,$this->area,0,0,'L');
$this->SetFont('Times','B',32);
$this->Cell(85,20,'DCTO TOTAL: ',0,0,'L');$this->SetFont('Arial','',40);$this->Cell(105,20,'s/. '.$this->dcto,0,0,'L');
//
$this->SetFont('Arial','',29);
$this->Cell(72);
$header = array('Codigo Marcado', 'Trabajador', 'Fecha Marcado', 'Min.Acumulados', 'Tipo Marcado', 'Doc. Justificacion', 'Estado De Marcacion');
$this->Cell(10);$this->Ln(35);
$w = array(150,310, 140, 90,170,140,140);
	$periodo = array(20);
		// Header
		$this->SetFillColor(200,220,255);
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],16,$header[$i],1,0,'C',true);
		};

$this->Cell(10);$this->Ln(8);
$w = array(150,310, 140, 90,170,140,140);
	$periodo = array(20);
		// Header
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],11,'',0,0,'C');
			

		};
$this->Ln(5);
}
//----------------------

function ChapterTitle($num, $label)
{
    // Arial 12
    $this->SetFont('Times','B',15);
    // Color de fondo
    $this->SetFillColor(200,220,255);
    // Título
	
    $this->Cell(0,3,$label,0,1,'L',true);
    // Salto de línea
//  $this->Ln(4);
}



function PrintChapter($num, $title)
{
    
    $this->ChapterTitle($num,$title);
  
}



//Page footer
function Footer()
{
	// Whatever written here will come in footer of the pdf file.
	$this->Ln(3);
	//Position at 1.5 cm from bottom
	$this->SetY(-9);
	//Arial italic 8
	$this->SetFont('Arial','B',22);
	//Page number
	$this->Cell(0,10,'E-mail: agricultura@draucayali.gob.pe',0,0,'C');
	$this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'R');
	$this->SetY(-18);
	$this->Cell(0,10,'Jr. Jose Galvez #287 -- Central 571754 -- Pucallpa',0,0,'C');
	$this->SetY(-27);
	$this->Cell(0,10,'Direccion Regional Sectorial De Agricultura De Ucayali D.R.S.A.U',0,0,'C');
	$this->Ln(3);
	//Jr. José Gálvez Nº 287 – Central 57-1754 – Pucallpa
//E-mail: agricultura@draucayali.gob.pe

}

//----------------------
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}

//----------------------
function ImprovedTable($data,$c1,$header)
{
	// Column widths
	
	
	
	$i=0;
	$tmp=0; $this->SetFont('Times','',30);
	
	
			
		foreach($data as $row)
		{$i++;
			 $this->Ln(8);
                            
								$this->Cell(150,16,$row[0],'1BT',0,'C'); 
								$this->Cell(310,16,$row[1],'1LB',0,'C');
								$this->Cell(140,16,$row[2],'1LB',0,'C');
								$this->Cell(90,16,$row[3],'1LB',0,'C');
								$this->Cell(170,16,$row[4],'1LB',0,'C');
								$this->Cell(140,16,$row[5],'1LB',0,'C');
								$this->Cell(140,16,$row[6],'1LBR',0,'C');
								
							
					
		    $this->Ln(8);
				
				
	          }
          }
}
//----------------------array(300.28,600.89)
$header = array('COD. CURSO', 'CURSO', 'SECCION', 'CRE.', 'NOTA', 'ESTADO', 'ESTADO');
$pdf = new PDF('L','mm',array(800.28,1170.89));//$pdf=new FPDF('L','mm','A4');
$pdf->DATACAB($usuario,$inicio,$final,$it1,$it2,$area,$minu,$dcto);			 
$pdf->AddPage();
$pdf->SetFont('Times','',22);
$pdf->Ln(2);
$pdf->ImprovedTable($data,$i,$header);
$pdf->Output();
				 }		 
					  
?>