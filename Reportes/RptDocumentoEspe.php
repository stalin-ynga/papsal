<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 

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
			  
$sql_guardar1="select tblsalida.Codigo,NombreCom,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado,fechahora AS 'FECHA DE APROBACION'
from tblsalida,tblusuario,tbladrees WHERE NOT(Statuss='04' || TipoMotivo='0000000005' || TipoMotivo='0000000007' || TipoMotivo='0000000008' || TipoMotivo='0000000009' || TipoMotivo='0000000010' || TipoMotivo='0000000011' || TipoMotivo='0000000012' || TipoMotivo='0000000013' || TipoMotivo='0000000014' || TipoMotivo='0000000015' || TipoMotivo='0000000016')
AND tblusuario.Codigo=tblsalida.Usuario AND FecSalida BETWEEN '$inicio' AND '$final' AND tblsalida.Codigo=tbladrees.Papeleta AND fechahora>CONCAT(DATE_FORMAT(DATE_ADD(FecSalida,INTERVAL 1 DAY),'%Y-%m-%d'),' ','00:00:00') and Operacion='APROBACION' AND FecRetorno='0000-00-00 00:00:00'  ORDER BY NombreCom  ;";

       $res1 =mysql_query($sql_guardar1,$enlace); 
	  
	   }
	   
	   // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE TARDANZA 
	   
	   
	    // INDICAMOS EL QUERY QUE SERA DE ACUERDO AL TIPO-SI ES DE VEHICULAR
   
    
   //--
	   
	   //------------
	while ($reg = mysql_fetch_array($res1))
                            {    $i++;
								$data[]=array_merge($reg);
								
		                	};
							
			if($i==0){
				       if($categoria=="02" || $categoria=="04" || $categoria=="03"){
			
		  header("Location:../error5.php");
	 
	   }else{
					   header("Location:../error3.php");
	   }
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
  var $categoria;
  

		
function DATACAB($usuario,$inicio,$final,$estado,$tipo,$area,$categoria)
{
	$this->usuario=$usuario;
	$this->inicio=$inicio;
	$this->fin=$final;
	$this->estado=$estado;
	$this->tipo=$tipo;
	$this->area=$area;
	$this->categoria=$categoria;
	
	
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
$this->Cell(1140,15,'REPORTE DE PAPELETAS APROBADAS PASADA LA FECHA DE SALIDA',0,'1LB','C',true);
$this->Cell(90,20,'USUARIO: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(350,20,$this->usuario,0,0,'L');$this->SetFont('Times','B',32);
$this->Cell(80,20,'CATEGORIA: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(221,20,$this->categoria,0,0,'L');$this->SetFont('Times','B',32);
$this->Cell(95,20,'JUSTIFICACION: ',0,0,'C');$this->SetFont('Times','',35);$this->Cell(70,20,$this->tipo,0,0,'L');
$this->Ln(20);$this->SetFont('Times','B',34);//salta a la sgte linea de la cabezera
$this->Cell(90,20,'DESDE: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(100,20,$this->inicio,0,0,'L');$this->SetFont('Times','B',34);
$this->Cell(90,20,'HASTA: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(100,20,$this->fin,0,0,'L');$this->Cell(11);
$this->SetFont('Times','B',32);
$this->Cell(110,20,'UNIDAD/OFICINA: ',0,0,'C');$this->SetFont('Times','',32);$this->Cell(450,20,$this->area,0,0,'L');
$this->SetFont('Times','B',32);
$this->Cell(85,20,'ESTADO: ',0,0,'L');$this->SetFont('Arial','',34);$this->Cell(105,20,$this->estado,0,0,'L');
//
$this->SetFont('Arial','',29);
$this->Cell(72);

//---SALIDA
if($this->categoria=='PAPELETAS DE SALIDA' || $this->categoria=='DOCUMENTOS Y FORMATOS' ){
$header = array('Codigo Documento', 'Trabajador', 'Fecha Salida', 'Fecha Retorno', 'Justificacion', 'Lugar', 'Fecha de Aprobacion');
$this->Cell(10);$this->Ln(35);
$w = array(150,310, 120, 120,170,150,120);
	$periodo = array(20);
		// Header
		$this->SetFillColor(200,220,255);
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],16,$header[$i],1,0,'C',true);
		};

$this->Cell(10);$this->Ln(8);
$w = array(150,310, 120, 120,170,150,120);
	$periodo = array(20);
		// Header
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],11,'',0,0,'C');
			

		};}
		
//---TARDANZA
if($this->categoria=='PAPELETAS DE TARDANZA' ){
$header = array('Codigo Documento', 'Trabajador', 'Motivo', 'Fecha', 'Tipo De Marcado', 'Estado');
$this->Cell(10);$this->Ln(35);
$w = array(150,310, 210,190,168,110);
	$periodo = array(20);
		// Header
		$this->SetFillColor(200,220,255);
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],16,$header[$i],1,0,'C',true);
		};

$this->Cell(10);$this->Ln(8);
$w = array(150,310, 210, 190,168,110);
	$periodo = array(20);
		// Header
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],11,'',0,0,'C');
			

		};}
		
//---VEHICULO
if($this->categoria=='PAPELETAS VEHICULARES' ){
$header = array('Codigo Documento', 'Trabajador','Vehiculo', 'Motivo', 'Fecha', 'Destino', 'Estado');
$this->Cell(10);$this->Ln(35);
$w = array(150,310,150,110,158,170,90);
	$periodo = array(20);
		// Header
		$this->SetFillColor(200,220,255);
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],16,$header[$i],1,0,'C',true);
		};

$this->Cell(10);$this->Ln(8);
$w = array(150,310, 150, 110,158,170,90);
	$periodo = array(20);
		// Header
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],11,'',0,0,'C');
			

		};}
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
	
	
			if($this->categoria=='PAPELETAS DE SALIDA' || $this->categoria=='DOCUMENTOS Y FORMATOS'){
		foreach($data as $row)
		{$i++;
			 $this->Ln(8);
                            
								$this->Cell(150,16,$row[0],'1BT',0,'C'); 
								$this->Cell(310,16,$row[1],'1LB',0,'C');
								$this->Cell(120,16,$row[2],'1LB',0,'C');
								$this->Cell(120,16,$row[3],'1LB',0,'C');
	                            $this->Cell(170,16,$row[4],'1LB',0,'C');							
								$this->Cell(150,16,$row[5],'1LBR',0,'C');
								$this->Cell(120,16,$row[6],'1LBR',0,'C');
								
							
					
		    $this->Ln(8);
				
				
	          } }
          
		  if($this->categoria=='PAPELETAS DE TARDANZA'){
		foreach($data as $row)
		{$i++;
			 $this->Ln(8);
                            
								$this->Cell(150,16,$row[0],'1BT',0,'C'); 
								$this->Cell(310,16,$row[1],'1LB',0,'C');
								$this->Cell(210,16,$row[2],'1LB',0,'C');
								$this->Cell(190,16,$row[3],'1LB',0,'C');
	                            $this->Cell(168,16,$row[4],'1LB',0,'C');							
								$this->Cell(110,16,$row[5],'1LBR',0,'C');

								
							
					
		    $this->Ln(8);
				
				
	          } }
		  
		  
		 if($this->categoria=='PAPELETAS VEHICULARES'){
		foreach($data as $row)
		{$i++;
			 $this->Ln(8);
                            
								$this->Cell(150,16,$row[0],'1BT',0,'C'); 
								$this->Cell(310,16,$row[1],'1LB',0,'C');
								$this->Cell(150,16,$row[2],'1LB',0,'C');
								$this->Cell(110,16,$row[3],'1LB',0,'C');
	                            $this->Cell(158,16,$row[4],'1LB',0,'C');													                                $this->Cell(170,16,$row[5],'1LB',0,'C');			
								$this->Cell(90,16,$row[6],'1LBR',0,'C');

								
							
					
		    $this->Ln(8);
				
				
	          } }  
		  
		  }
}
//----------------------array(300.28,600.89)
$header = array('COD. CURSO', 'CURSO', 'SECCION', 'CRE.', 'NOTA', 'ESTADO', 'ESTADO');
$pdf = new PDF('L','mm',array(800.28,1170.89));//$pdf=new FPDF('L','mm','A4');
$pdf->DATACAB($usuario,$inicio,$final,$it1,$it2,$area,$it3);			 
$pdf->AddPage();
$pdf->SetFont('Times','',22);
$pdf->Ln(2);
$pdf->ImprovedTable($data,$i,$header);
$pdf->Output();
				 }		 
					  
?>
