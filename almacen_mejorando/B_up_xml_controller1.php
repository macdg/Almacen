<?php
class B_up_xml_controller1 extends CI_Controller {

public function __construct() {
	parent::__construct();
		$this->load->helper('file','form','url','directory');
		$this->load->model('B_up_xml_model');
		$this->load->model('B_up_xml_model','b_up_xml_model');
		$this->load->library('form_validation');
		$this->load->helper('xml2array');
	//echo validation_errors();

	}

public function index() {
//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// $this->form_validation->set_rules('mi_check', 'Selección XML requerido', 'required');
// echo form_error('mi_check');
// $this->form_validation->set_rules('mi_check', 'Selección XML requerido', 'required');
// echo form_error('mi_check');

//  if ($this->form_validation->run() == FALSE) {
 $this->load->view('b_subirgeneral1_view');
 // }
 // else {
 // $this->load->view('pagina_exito');
 // }

}


public function subiendo_archivo() {

		// MANEJANDO LOS ARCHIVOS

echo '<br><br><br>';

	if (is_uploaded_file($_FILES['mi_archivo_1']['tmp_name']))
	{
 	$nombreDirectorio = "/var/www/html/ci/uploads/";
 	$nombreFichero = $_FILES['mi_archivo_1']['name'];
 
		$rutaCompleta = $nombreDirectorio . $nombreFichero;


 	if (file_exists($nombreDirectorio.$nombreFichero)) {
			//echo '<br>'.'El archivo: "'.$nombreFichero.'",ya existe'. 'Seleccione otro archivo.';
		// $this->load->view('up_x');
			$salida='b_up_xml_controller1/index';
//		return ($this->load->view('up_xml_view'));
			} 

			move_uploaded_file($_FILES['mi_archivo_1']['tmp_name'],$rutaCompleta);
 
 }
 
else
 
 echo ("No se ha podido subir el fichero");

	echo '<br><br><br>';

// echo 'El nombre del archivo subido es: '.$nombreFichero;
// echo '<br><br>';

// $val_ext=substr($nombreFichero,-4);
// echo 'Extension del archivo valido: '.$val_ext;
// echo '<br><br><br>';

   // $array = array();
   // $array['nombreFichero'] = $nombreFichero;
   // $array['nombreDirectorio'] = $nombreDirectorio;

//Crea una sola variable llamada $array TIPO array[], conteniendo la ruta y nombre del archivo.
//Enviando el contenido del arreglo:$array, al metodo b_contenido_xml_1.
     //echo $this->b_contenido_xml_1($array);

//$this->load->view('pagina_exito');

	echo '<br>';
		
// $this->output->enable_profiler(TRUE);

	echo $this->tipo_archivo($nombreFichero, $rutaCompleta);

}



public function tipo_archivo($nombreFichero, $rutaCompleta) {
	
//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
//$this->subiendo_archivo($nombreFichero);
//$this->subiendo_archivo();
// subiendo_archivo($nombreFichero);

//echo subiendo_archivo($nombreFichero);

// echo '<br>';
// print_r($nombreFichero);
// echo '<br>';


//Convirtiendo el arreglo a cadena con implode y separandolo para manipularlo con explode.
// $a_cade=implode(',',$a);
// $nombreFichero=explode(',',$a_cade);

	echo 'El nombre del archivo subido es: '.$nombreFichero;
	echo '<br><br>';

	$val_ext=substr($nombreFichero,-4);
	echo 'Extension del archivo valido: '.$val_ext;
	echo '<br><br><br>';


 echo $this->conv_xmlarreglo($rutaCompleta);

// $this->load->view('pagina_exito');

}



public function conv_xmlarreglo($rutaCompleta){

//**********************************************************
//Para imprimir contenido en tablas.
//$contents= file_get_contents($nombreDirectorio.$tip_arch);
	$this->load->helper('xml2array');
	$contents= file_get_contents($rutaCompleta);
	$result = xml2array($contents,1,'attribute');
	// $result = $this->compara_cambia_estructura($result);

 // print_r($result);
 // exit;
//**********************************************************
//$this->load->view('pagina_exito');
//Enviando variables al metodo metodo mostrando_tabla.

// $this->load->view('pagina_exito');
echo $this->cam_estructura($result);

}

// Comparando la estructura del XML

public function cam_estructura($result) {
	if (!isset($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'][0]))
			$result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'] = array(0 => $result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);

	//return $result;

	// 	// $this->load->view('pagina_exito');

echo $this->asignando_var($result);

}




public function asignando_var($result){


//[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
// SEGUNDA OPCION

// $key_search='attr';
// $si_existe_key=array_key_exists($key_search,$result);

// if ($si_existe_key==NULL || $si_existe_key==FALSE) {

//*************************************
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

 
 $cont=count($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);

// echo '<br><br>';
// echo "CONT:". $cont;

// $this->load->view('pagina_exito');

for ($i=0; $i<$cont; $i++){

 	foreach ($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'][$i]['attr'] as $e => $val) {
 		// echo '<br><br>[attr] KEY:= '.$key.'  	|| [attr] VALUE:= '.$value;
 	
		if ($e == 'cantidad')
					$cantidad = $val;
		if ($e == 'unidad')
					$unidad = $val;
		if ($e == 'descripcion')
					$descrip = $val;
		if ($e == 'valorUnitario')
					$val_unit = $val;

 $datos_concepto_c[$i]=$cantidad;
 $datos_concepto_u[$i]=$unidad;
 $datos_concepto_d[$i]=$descrip;
 $datos_concepto_v[$i]=$val_unit;
																										} //Fin de Foreach

 	}  //Fin de For.

 echo '<br><br>';
//} // Fin de IF

// echo '<br><br>';
// print_r($datos_concepto_cantidad);
// echo '<br><br>';
// var_dump($datos_concepto_cantidad);
// echo '<br><br>';
// foreach ($datos_concepto_c as $key => $value) {
// 	 echo '<br><br>$datos_concepto_cantidad: KEY~> '.$key.'<br><br> VALUE~> '.$value;
// }



// echo '<br><br>';
// print_r($datos_concepto_unidad);
// echo '<br><br>';
// var_dump($datos_concepto_unidad);
// echo '<br><br>';

// echo '<br><br>';
// print_r($datos_concepto_descrip);
// echo '<br><br>';
// var_dump($datos_concepto_descrip);
// echo '<br><br>';

// echo '<br><br>';
// print_r($datos_concepto_val_unit);
// echo '<br><br>';
// var_dump($datos_concepto_val_unit);
// echo '<br><br>';


//[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
// Datos de TimbreFiscalDigital.
// Concepto - UUID.

	foreach ($result['cfdi:Comprobante']['cfdi:Complemento']['tfd:TimbreFiscalDigital']['attr'] as $s => $vu) {
// //	echo '<br>%%%Nivel2 Esto es lo que tiene $result: '.$result['cfdi:Comprobante']['cfdi:Complemento']['tfd:TimbreFiscalDigital']['attr'].' $key: '.$key.' $value: '.$value.' %%%';

		if ($s=='UUID')
				$id_uuid=$vu;

	}



//   Datos del Proveedor.
// Proveedor - RFC.
// Extraidos de Factura para no repetir código.
// $rfc; y $rfc_nom;

foreach ($result['cfdi:Comprobante']['cfdi:Emisor']['cfdi:DomicilioFiscal']['attr'] as $ke => $vue) {

if ($ke=='calle')
	$calle=$vue;
if ($ke=='noExterior')
	$no_ext=$vue;
if ($ke=='noInterior')
	$no_int=$vue;
if ($ke=='colonia')
	$colonia=$vue;
if ($ke=='referencia')
	$referen=$vue;
if ($ke=='municipio')
	$mun=$vue;
if ($ke=='estado')
	$estado=$vue;
if ($ke=='pais')
	$pais=$vue;
if ($ke=='codigoPostal')
	$cp=$vue;


}


//   Datos de Factura.
// Factura - RFC.
foreach ($result['cfdi:Comprobante']['cfdi:Emisor']['attr'] as $ky => $l) {

if ($ky=='rfc')
	$id_rfc=$l;
if ($ky=='nombre')
	$rfc_nom=$l;

}

// Factura - Desglose.
// Fctura - ['attr'].

foreach ($result['cfdi:Comprobante']['attr'] as $cy => $ll) {

if ($cy=='fecha')
	$fecha=$ll;
if ($cy=='subTotal')
	$subtotal=$ll;
if ($cy=='Moneda')
	$moneda=$ll;
if ($cy=='total')
	$total=$ll;

}

	$datos_concepto['id_uuid'] = $id_uuid;
	$datos_concepto['cantidad'] = $datos_concepto_c;
	$datos_concepto['unidad'] = $datos_concepto_u;
	$datos_concepto['descrip'] = $datos_concepto_d;
	$datos_concepto['val_unit'] = $datos_concepto_v;




// echo '<br><br>';
// print_r($datos_concepto);
// echo '<br><br>';
// var_dump($datos_concepto);
// echo '<br><br>';
// foreach ($datos_concepto as $key => $value) {
// 	 echo '<br><br>$datos_concepto_cantidad: KEY~> '.$key.'<br><br> VALUE~> '.$value;
// }



// echo '<br><br>';
// print_r($datos_concepto);
// echo '<br><br>';
// var_dump($datos_concepto);
// echo '<br><br>';

// echo '<br><br>';
// print_r($datos_concepto);
// echo '<br><br>';
// var_dump($datos_concepto);
// echo '<br><br>';

// echo '<br><br>';
// print_r($datos_concepto);
// echo '<br><br>';
// var_dump($datos_concepto);
// echo '<br><br>';


	$datos_proveedor['id_rfc']= $id_rfc;
	$datos_proveedor['rfc_nom']=$rfc_nom;
	$datos_proveedor['calle'] = $calle;
	$datos_proveedor['no_ext']= $no_ext;
	$datos_proveedor['no_int']= $no_int;
	$datos_proveedor['colonia']= $colonia;
	$datos_proveedor['referen']= $referen;
	$datos_proveedor['mun']= $mun;
	$datos_proveedor['estado']= $estado;
	$datos_proveedor['pais']= $pais;
	$datos_proveedor['cp']= $cp;
	$datos_proveedor['id_uuid']=$id_uuid;

	$datos_factura['id_uuid']=$id_uuid;
	$datos_factura['rfc_nom']= $rfc_nom;
	$datos_factura['fecha']= $fecha;
	$datos_factura['subtotal']= $subtotal;
	$datos_factura['moneda']= $moneda;
	$datos_factura['total']= $total;
	$datos_factura['id_rfc']= $id_rfc;

// foreach ($datos_concepto['cantidad'] as $key => $value) {
	
// $cuantos_datos_concepto[$key]= $value;
// }
// $string_d_concepto = implode(",", $cuantos_datos_concepto);

//echo $string_d_concepto; // apellido,email,teléfono




// echo '$datos_concepto: '. $datos_concepto;
// echo '<br><br>';
// print_r($datos_concepto);
// echo '<br><br>';
// var_dump($datos_concepto);
// echo '<br><br>';

// echo '<br><br>';
// foreach ($datos_concepto as $key => $value) {
// 	 echo '<br><br>$datos_concepto: KEY~> '.$key.'<br><br> VALUE~> '.$value;
// }


	// $this->load->view('b_xmlcaso2_view', $datos_concepto, $datos_concepto_cantidad, $datos_concepto_unidad, $datos_concepto_descrip, $datos_concepto_val_unit, $cont);


//  $arr['cont'] = $cont;

// echo '$cont: '. $cont;
// echo '<br><br>';
// print_r($cont);
// echo '<br><br>';
// var_dump($cont);
// echo '<br><br>';

// $productos_view1 =$this->load->view('b_xmlcaso2_view', $datos_concepto, $datos_concepto_cantidad, $datos_concepto_descrip, $cont, TRUE);

// echo $this->x_x($datos_concepto, $datos_proveedor, $datos_factura, $datos_concepto_cantidad, $datos_concepto_unidad, $datos_concepto_descrip, $datos_concepto_val_unit, $cont);

//[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
 // } // Fin de IF

$changos=$this->load->view('b_xmlcaso2_view',$datos_concepto, $cantidad, TRUE);

// echo $this->solicitar2($datos_concepto);



echo $this->x($datos_concepto, $datos_proveedor, $datos_factura, $cont);

// $this->load->view('pagina_exito');
// $this->load->view('pagina_exito');
}



public function x($datos_concepto, $datos_proveedor, $datos_factura, $cont){

// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// echo '<br><br>';
// print_r($datos_concepto);
// echo '<br><br>';
// var_dump($datos_concepto);
// echo '<br><br>';
		$igual=$datos_concepto['id_uuid'];
		$consulta = $this->db->query(" SELECT id_uuid FROM concepto; ");

		foreach ($consulta->result_array() as $row){
			if ($row['id_uuid'] === $igual){
								echo '<br><br> Ya existe este registro en la DB.<br>'.$row->$value.'<br>';
    					$this->load->view('pagina_exito');
 								return ('<br><br> Saliendo del Programa.<br><br>');
										
			}
		}
			echo '<br><br><br>';
		
			foreach ($consulta->result_array() as $row){
   				echo '<br><br><br>';
   				echo $row['id_uuid'];
   				echo '<br><br><br>';
			}
				
					echo '<br><br>'.$cont.'<br>';
				for ($i=0; $i<$cont; $i++){

							
		// echo '<br><br>';  
		// echo 'datos cantidad arreglo: '.$datos_concepto['id_uuid'];
		// echo '<br><br>';
		// echo 'datos cantidad arreglo: '.$datos_concepto['cantidad'][$i];
		// echo '<br><br>'; 
		// echo 'datos cantidad arreglo: '.$datos_concepto['unidad'][$i];
		// echo '<br><br>'; 
		// echo 'datos cantidad arreglo: '.$datos_concepto['descrip'][$i];
		// echo '<br><br>'; 
		// echo 'datos cantidad arreglo: '.$datos_concepto['val_unit'][$i];
		// echo '<br><br>'; 
		// echo '<br><br>';
								// $igual=$datos_concepto['id_uuid'];

					$this->db->set('id_uuid', $datos_concepto['id_uuid']);
					$this->db->set('cantidad', $datos_concepto['cantidad'][$i]);
					$this->db->set('unidad', $datos_concepto['unidad'][$i]);
					$this->db->set('descrip', $datos_concepto['descrip'][$i]);
					$this->db->set('val_unit',$datos_concepto['val_unit'][$i]);

 				$this->db->insert('concepto');

 				$this->load->view('pagina_exito');
 				$this->output->enable_profiler(TRUE);			
 			} 

					foreach ($consulta->result() as $valu){
    		if ($igual === $valu->id_uuid){
    					// echo '<br><br>'.'El UUID ya existe en la DB.';
    					// echo 'Este es consultado desde la DB id_uuid: '.$value->id_uuid . ' Y este es desde la asignación IGUAL: '. $igual.'<br><br>';
    					echo '<br><br> Ya existe este registro en la DB.<br>'.$valu->id_uuid.'<br>';
    					$this->load->view('pagina_exito');
 								return( '<br><br> Saliendo del Programa.<br><br>');
 								
    		} 
    	}

		echo "<br><br>cont: ".$cont.'<br><br>';
		$cont_alt=$cont;



$id_rfc=$datos_proveedor['id_rfc'];
$rfc_nom=$datos_proveedor['rfc_nom'];
$calle=$datos_proveedor['calle'];
$no_ext=$datos_proveedor['no_ext'];
$no_int=$datos_proveedor['no_int'];
$colonia=$datos_proveedor['colonia'];
$referen=$datos_proveedor['referen'];
$mun=$datos_proveedor['mun'];
$estado=$datos_proveedor['estado'];
$pais=$datos_proveedor['pais'];
$cp=$datos_proveedor['cp'];
$id_uuid=$datos_proveedor['id_uuid'];

$this->b_up_xml_model->proveedor_data_insert(
	$id_rfc,
	$rfc_nom,
	$calle,
	$no_ext,
	$no_int,
	$colonia,
	$referen,
	$mun,
	$estado,
	$pais,
	$cp,
	$id_uuid
 );

$id_uuid=$datos_factura['id_uuid'];
$rfc_nom=$datos_factura['rfc_nom'];
$fecha=$datos_factura['fecha'];
$subtotal=$datos_factura['subtotal'];
$moneda=$datos_factura['moneda'];
$total=$datos_factura['total'];
$id_rfc=$datos_factura['id_rfc'];


$this->b_up_xml_model->factura_data_insert(
	$id_uuid,
	$rfc_nom,
 $fecha,
	$subtotal,
 $moneda,
	$total,
	$id_rfc
 );


$this->load->view('pagina_exito');
$this->output->enable_profiler(TRUE);

}



public function solicitar2() {
// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	

	// $datos_productos_numserie = $this->input->post('noserie');
	$id_uuid = $this->input->post('id_concepto');
	$cont = $this->input->post('cont_datos_concepto');
	$cantidad_total=$this->input->post();
	$cantidad = $this->input->post('canti');
	$noserie = $this->input->post('noserie');

	// $datos_concepto = $this->input->post($oc_datos_concepto);
	$elementos=count($cantidad);

 for ($i=0; $i<$cont; $i++){
		echo '<br><br>'.$i.'  Cantidad Total: '.$cantidad_total[$i].'<br><br>';
}

for ($j=0; $j<$elementos; $j++){
		echo '<br><br>'.$j.'  Cantidad: '.$cantidad[$j].'<br><br>';
		echo '<br><br>'.$j.'  Noserie: '.$noserie[$j].'<br><br>';


			$this->db->set('cantidad', $cantidad[$j]);
			$this->db->set('noserie',$noserie[$j]);

 				$this->db->insert('productos');

}


// foreach ($cantidad as $key => $value) {

// 					if (isset( $cantidad[0] ) ){
// 		 			foreach ($cantidad[0] as $key => $value) {
// 		 					echo '<br><br>$cantidad: KEY~> '.$key.'<br><br> VALUE~> '.$value.'<br><br>';
// 						}

// 					}







// for ($i=0; $i<=0; $i++){
// foreach ($cantidad[$i] as $key => $value) {
// 		 	echo '<br><br>$cantidad: KEY~> '.$key.'<br><br> VALUE~> '.$value.'<br><br>';

// }

// }

// $vale=$datos_concepto['cantidad'];
	// echo "<br><br>string CONCEPTO:";
	// var_dump($string_d_concepto);
// 	echo "<br><br>DATOS CONCEPTO:";
// 	print_r($datos_concepto);
// 	echo "<br><br>";
	// echo 'String_Concepto:'.$string_d_concepto;
	
	// echo "<br><br>";

	// echo "<br><br>ALL:";
	// var_dump($c);
	// echo "<br><br>ALL:";
	// print_r($c);
	// echo "<br><br>";
	// echo 'ALL:'.$c;

	// echo "<br><br>CANTIDAD:";
	// var_dump($cantidad_total);
	// echo "<br><br>CANTIDAD:";
	// print_r($cantidad_total);
	// echo "<br><br>";
	// echo 'CANTIDAD:'.$cantidad_total;

// echo '<br><br>';
// echo "Changos:". $changos;

	echo '<br><br>';
	echo 'cont:'.$cont;
	// echo '<br>id_uuid:'.$id_uuid_productos;

		// foreach ($datos_concepto as $k => $valor) {
		// 	if ($valor == 'id_uuid') {
		// 		$id_uuid=$valor;	
					
		// //$id_uuid=$datos_concepto['id_uuid'];
		// 		echo '<br>id_uuid:'.$id_uuid;
		// // $this->b_up_xml_model->solicita_productos_insert(
		// // 								$id_uuid
 	// // 								);
		// 		}
		// }


			echo '<br>id_uuid:'.$id_uuid;
		// $this->b_up_xml_model->solicita_productos_insert(
		// 								$id_uuid
 	// 								);


			// foreach ($datos_concepto['cantidad'] as $key => $value) {
			//  	echo '<br><br>$cantidad: KEY~> '.$key.'<br><br> VALUE~> '.$value;
			//  	 				$datos_productos['cantidad']=$datos_concepto['cantidad'];
			// 							$total_reg+=$value;
	
			// }


	// foreach ($datos_productos['cantidad'] as $key => $value) {
	// 	 echo '<br><br>$datos_productos<cantidad>: KEY~> '.$key.'<br><br> VALUE~> '.$value;
	// }

					// for ($i=0; $i<$total_reg; $i++){

				// foreach ($cantidad_total as $i => $val) {	
						// echo '<br>'.$cantidad_total.'<br>KEY:'. $k. '<br>VALUE:'.$val;
							// $cantidad=$val;	
									// $cantidad=$cantidad_total[$i];
						// $this->b_up_xml_model->solicita_productos_insert(
						// 		$cantidad
 					// 		);
				// } 
		
		// echo '<br><br>';
		
				// foreach ($datos_productos_numserie as $i => $valu) {		
				// 		echo '<br>'.$datos_productos_numserie.'<br>KEY:'. $ke. '<br>VALUE:'.$valu;
						 // $noserie=$valu;
										// $noserie = $datos_productos_numserie[$i];
									// $this->b_up_xml_model->solicita_productos_insert(
									// 		$id_uuid,
									// 		$cantidad,
									// 		$noserie
 								// 		);
				// } 

				// for ($i=0; $i<$total_reg; $i++){

				// 	foreach ($cantidad_total as $i => $val) {	
				// 			$cantidad = $val;
				// 	foreach ($datos_productos_numserie as $i => $valu) {					$noserie  = $valu;

				// 	$this->b_up_xml_model->solicita_productos_insert(
				// 					$id_uuid,
				// 					$cantidad,
				// 					$noserie
 			// 							);
									
				// 			}}
				// }
							
					
// 	echo "<br><br>CANTIDADtotal:";
// 	var_dump($cantidad_total);
// 	echo "<br><br>CANTIDADtotal:";
// 	print_r($cantidad_total);
// 	echo "<br><br>";
// 	echo 'CANTIDADtotal:'.$cantidad_total;


// echo "<br><br>Numserie:";
// 	var_dump($datos_productos_numserie);
// 	echo "<br><br>Numserie:";
// 	print_r($datos_productos_numserie);
// 	echo "<br><br>";
// 	echo 'Numserie:'.$datos_productos_numserie;

// $this->db->insert('productos',$id_uuid);

			
// $this->db->insert('productos', $cantidad_total, $datos_productos_numserie);


// 	$datos_productos_numserie = $this->input->post('noserie');
// 	$cantidad_total = $this->input->post('cantidad');

// 		foreach ($datos_productos['cantidad'] as $key => $value) {
// 		 // echo '<br><br>$datos_productos<cantidad>: KEY~> '.$key.'<br><br> VALUE~> '.$value;
	
// 				echo "<br><br>total_reg:".$total_reg;
// 				for ($i=0; $i<$value; $i++){
						

// 						$cantidad=$datos_productos;
// 						$noserie=$datos_productos;

// 						echo "<br><br>cantidad:".$cantidad;
// 						echo "<br><br>noserie:".$noserie;
// }}





						// $this->b_up_xml_model->productos_data_insert(
						// 				$cantidad,
						// 				$noserie
 					// 				);



			// for ($j=0; $j<$cont; $j++)  {

			// 	$cantidad=$datos_productos['cantidad'][$j]; 
												
			// 			$this->b_up_xml_model->productos_data_insert(
			// 							$cantidad
 		// 							);
			// }

// $cantidad_total = $this->input->post('cantidad');
// 	$datos_productos_numserie = $this->input->post('noserie');
// 	$id_uuid_productos = $this->input->post('id_concepto');


// echo $this->grabar($cantidad_total, $datos_productos_numserie, $id_uuid_productos, $datos_concepto);


$this->load->view('pagina_exito');


$this->output->enable_profiler(TRUE);

}


public function grabar($cantidad_total, $datos_productos_numserie, $id_uuid_productos, $datos_concepto){

	$cantidad_total = $this->input->post('cantidad');
	$datos_productos_numserie = $this->input->post('noserie');
	$id_uuid_productos = $this->input->post('id_concepto');
$cont = $this->input->post('cont_datos_concepto');
$total_reg = $this->input->post($total_reg);
$changos = $this->input->post($changos);

// foreach ($cantidad_total as $key => $value) {
		 // echo '<br><br>$datos_productos<cantidad>: KEY~> '.$key.'<br><br> VALUE~> '.$value;
	
				// echo "<br><br>total_reg:".$total_reg;
				// for ($i=0; $i<$cont; $i++){
						
						$cantidad=$cantidad_total = $this->input->post('cantidad');
						$noserie=$datos_productos_numserie = $this->input->post('noserie');



						$cont_cant=count($cantidad);

							echo "<br><br>cont_cant: ".$cont_cant."<br><br>";

			// for ($i=0; $i<=$cont_cant; $i++){



						foreach ($cantidad as $key => $value) {
							
						echo "<br><br>cantidad: ".$key. 'VALUE: '.$value;
						// $cantidad = $value;
						// $d_productos_cant_dina[$i]=$cantidad;

						// $this->b_up_xml_model->solicita_productos_insert(
						// 					$cantidad
											
 					// 					);

						}

						foreach ($noserie as $k => $val) {
						echo "<br><br>noserie: ".$k. 'VALUE: '.$val;
						// $noserie = $val;
 					// $d_productos_noser_dina[$i]=$noserie;

						// $this->b_up_xml_model->solicita_productos_insert(
											
						// 					$noserie
 					// 					);

						}



			// }

			// $datos_productos['cantidad'] = $d_productos_cant_dina;
			// $datos_productos['noserie'] = $d_productos_noser_dina;

			// $cantidad = $datos_productos['cantidad'];
			// $noserie = $datos_productos['noserie'];

						// $this->b_up_xml_model->solicita_productos_insert(
											// $cantidad,
											// $noserie
 										// );

						// echo "<br><br>cantidad: ".$key. 'VALUE: '.$value;
						
// }

// echo "<br><br>total_reg:".$total_reg;
// foreach ($total_reg as $key => $value) {
// 								echo "<br><br>total_reg-KEY: ".$key. '<br>VALUE: '.$value.'<br><br>';
// 						}


// foreach ($changos as $key => $value) {
// 								echo "<br><br>CHANGOS-KEY: ".$key. '<br>VALUE: '.$value.'<br><br>';
// 						}


// foreach ($changos['datos_concepto']['array'] as $key => $value) {
	

 
// echo "<br><br>total_reg-KEY: ".$key. '<br>VALUE: '.$value.'<br><br>';
// echo $changos['datos_concepto'][$i];

// }

var_dump($datos_concepto);
// foreach ($changos as $key => $value) {
								
// 								if ($key == 'datos_concepto') {
	 							

// 								echo "<br><br>CHANGOS Datos_Concepto -  KEY: ".$key. '<br>VALUE: '.$value.'<br><br>';
// 						echo "<br><br> Datos_Concepto PRINTR-: ".print_r($changos['datos_concepto'][$key]). '<br>';

// 						}

// 						}

// echo "<br><br>CHANGOS:".$changos.'  <br>';
// $cont_cant=count($cantidad);

// echo "<br><br>cont_cant: ".$cont_cant."<br><br>";

// for ($i=0; $i<=$cont_cant; $i++){
// foreach ($cantidad[$i] as $key => $value) {
// 								echo "<br><br>cantidad-KEY: ".$key. '<br>VALUE: '.$value.'<br><br>';
						

// 						}

// foreach ($noserie[$i] as $key => $value) {
// 								echo "<br><br>noserie-KEY: ".$key. '<br>VALUE: '.$value.'<br><br>';
// 						}

// }



$this->load->view('pagina_exito');
$this->output->enable_profiler(TRUE);

}












public function subir_xml() {


		echo '<br>';
		echo '--------------------'.'<br>';
		

		// MANEJANDO LOS ARCHIVOS
$ruta_archivo = '/root/Documentos/rep_xml/';
echo '<br>'.'<br>'.'<br>';
//print_r($_FILES['mi_archivo_1']);
echo '<br>'.'<br>'.'<br>';
//var_dump($_FILES['mi_archivo_1']);

$mi_archivo_1=$_FILES['mi_archivo_1'];
$tip_arch=$mi_archivo_1['name'];
echo 'El nombre del archivo es: '.$tip_arch;
echo '<br>'.'<br>';

$val_ext=substr($tip_arch,-4);
echo '($val_ext) Extension d archivo: '.$val_ext;





if (is_uploaded_file($_FILES['mi_archivo_1']['tmp_name']))
{
 $nombreDirectorio = "/var/www/html/ci/uploads/";
 $nombreFichero = $_FILES['mi_archivo_1']['name'];
 
$nombreCompleto = $nombreDirectorio . $nombreFichero;
 


 	if (file_exists($nombreDirectorio.$nombreFichero)) {
			//echo '<br>'.'El archivo: "'.$nombreFichero.'",ya existe'. 'Seleccione otro archivo.';
		// $this->load->view('up_x');
			$salida='up_xml_controller/index';
//		return ($this->load->view('up_xml_view'));
		} 

			move_uploaded_file($_FILES['mi_archivo_1']['tmp_name'], $nombreDirectorio.$nombreFichero);
 
 }
 
else
 print ("No se ha podido subir el fichero");


// foreach ($todos_archivos as $key => $value) {
//  echo '<br>Todos los archivos: '.$todos_archivos.'Key: '.$key.'Valor: '.$value;
// }

// //Todos los archivos: ArrayKey: 0Valor: NEO0303288Z1FB8410.xml


// echo "<br><hr/>";

// print_r($todos_archivos['0']);
// echo '<br>';
// print_r($todos_archivos['1']);
// echo "<br><hr/>";



echo '<br>Este es el contenido del archivo subido';
echo "<br><hr/>";
echo '<br>';
$this->load->helper('xml2array');
$contents = xml2array(file_get_contents($nombreDirectorio.$nombreFichero));
echo 'Contenido:'. print_r($contents,1);
echo '<br><br><hr/>';


//**********************************************************
//Para imprimir contenido en tablas.
$contents= file_get_contents($nombreDirectorio.$tip_arch);
$result = xml2array($contents,1,'attribute');
// print_r($result);
//**********************************************************

		//// $result2 = $result;
		//// $result2['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'] = 
		//// array($result2['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);

// print_r($result['cfdi:Comprobante']['cfdi:Conceptos']);
// print_r($result2['cfdi:Comprobante']['cfdi:Conceptos']);
echo "<br>";
		//// $result3 = $result;
		//// $result3['cfdi:Comprobante']['cfdi:Complemento']['tfd:TimbreFiscalDigital'] = 
		//// array($result3['cfdi:Comprobante']['cfdi:Complemento']['tfd:TimbreFiscalDigital']);


// $contents= file_get_contents('/var/www/html/ci/uploads/NEO0303288Z1FB8410.xml');
// $result = xml2array($contents,1,'attribute');
// print_r($result['cfdi:Comprobante']['cfdi:Conceptos']);




//         CASO DE UN PRODUCTO DENTRO DE LA FACTURA.
// Datos de Concepto.

foreach (($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']['attr']) as $key => $value) {
	//echo '<br>###Nivel1 Esto es lo que tiene $result: '.($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']['attr']).' $key: '.$key.' $value: '.$value.' ###';

if ($key=='cantidad')
	$cant=$value;
$cantidad=$cant;
if ($key=='unidad')
$unidad=$value;
if ($key=='noIdentificacion')
$no_ident=$value;
if ($key=='descripcion')
$descrip=$value;
if ($key=='valorUnitario')
$val_unit=$value;

}

// Datos de TimbreFiscalDigital.
// Concepto - UUID.

foreach ($result['cfdi:Comprobante']['cfdi:Complemento']['tfd:TimbreFiscalDigital']['attr'] as $key => $value) {
// //	echo '<br>%%%Nivel2 Esto es lo que tiene $result: '.$result['cfdi:Comprobante']['cfdi:Complemento']['tfd:TimbreFiscalDigital']['attr'].' $key: '.$key.' $value: '.$value.' %%%';

if ($key=='UUID')
	$uuid=$value;
$id_uuid=$uuid;

}


//   Datos del Proveedor.
// Proveedor - RFC.
// Extraidos de Factura para no repetir código.
// $rfc; y $rfc_nom;

foreach ($result['cfdi:Comprobante']['cfdi:Emisor']['cfdi:DomicilioFiscal']['attr'] as $key => $value) {

if ($key=='calle')
	$calle=$value;
if ($key=='noExterior')
	$no_ext=$value;
if ($key=='noInterior')
	$no_int=$value;
if ($key=='colonia')
	$colonia=$value;
if ($key=='referencia')
	$referen=$value;
if ($key=='municipio')
	$mun=$value;
if ($key=='estado')
	$estado=$value;
if ($key=='pais')
	$pais=$value;
if ($key=='codigoPostal')
	$cp=$value;


}


//   Datos de Factura.
// Factura - RFC.
foreach ($result['cfdi:Comprobante']['cfdi:Emisor']['attr'] as $key => $value) {

if ($key=='rfc')
	$id_rfc=$value;
if ($key=='nombre')
	$rfc_nom=$value;

}

// Factura - Desglose.
// Fctura - ['attr'].

foreach ($result['cfdi:Comprobante']['attr'] as $key => $value) {

if ($key=='fecha')
	$fecha=$value;
if ($key=='subTotal')
	$subtotal=$value;
if ($key=='Moneda')
	$moneda=$value;
if ($key=='total')
	$total=$value;

}


//===============================================================
//========   INSERTANDO DATOS ===================================

// $this->up_xml_model->concepto_data_insert(
// 	$id_uuid,
// 	$cantidad,
// 	$unidad,
// 	$no_ident,
// 	$descrip,
// 	$val_unit
// 	);

// $this->up_xml_model->proveedor_data_insert(
// 	$id_rfc,
// 	$rfc_nom,
// 	$calle,
// 	$no_ext,
// 	$no_int,
// 	$colonia,
// 	$referen,
// 	$mun,
// 	$estado,
// 	$pais,
// 	$cp
//  );

// $this->up_xml_model->factura_data_insert(
// 	$id_rfc,
// 	$rfc_nom,
//  $fecha,
// 	$subtotal,
//  $moneda,
// 	$total
//  );




//===============================================================

//            CASO DE MAS PRODUCTOS DENTRO DE LA FACTURA.
//echo '<br>@@@@@@  UUID:= '.$uuid.'  @@@@@@<br>';

$key_search='attr';
$si_existe_key=array_key_exists($key_search,$result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);
// echo '<br><br>$si_existe_key: '.$si_existe_key;


// echo '<br>@@@@@@ Imprimiendo Indices de Arreglos@@@@@@<br>';
$nivel3=$result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'];
// print_r(array_keys($nivel3));
echo '<br><br>';

//print_r($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);
if ($si_existe_key==NULL || $si_existe_key==FALSE) {


//*************************************
	$cont=count($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);
// echo '<br><br>$cont: '.$cont;
 foreach ($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'] as $key => $value) {
	//echo '<br>@@@Nivel3 Esto es lo que tiene $result: '.$result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'].' $key: '.$key.' @@@';

// echo '<br><br> ~> '.$key.'<br><br> ~> '.$value;
//*************************************																										

 }


for ($j=0; $j<$cont; $j++){

 	foreach ($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'][$j]['attr'] as $key => $value) {
 		//echo '<br><br>[attr] KEY:= '.$key.'  				|| [attr] VALUE:= '.$value;
 	
if ($key=='cantidad')
$cant=$value;
if ($key=='descripcion')
$descrip=$value;
$cant_1[$j]=$cant;
$descrip_1[$j]=$descrip;
																										} //Fin de For.

 	}

 echo '<br><br>';



echo '<br><br>';
// print_r( array_keys($nivel3));
}
echo '<br><br>';
// echo '$cant'.$cant ;
echo '<br><br>';
// echo '$descripcion'.$descrip;

echo '<br><br>';
// echo '$cont:'.$cont;

$array            = array();
$array['cant']    = $cant;
$array['descrip'] = $descrip;
$array['descrip_xml1'] = $descrip_xml1;
$array['uuid']    = $uuid;
$array['cant_1']		=	$cant_1;
$array['descrip_1']= $descrip_1;


//***********************************************************************
// $cantidad = $this->input->post($datos_in_cantidad);
// echo '<br>Datos in Cantidad:<br>';
// var_dump($cantidad);
// echo '<br>';
// print_r($cantidad);
// echo '<br>';

// $unidad = $this->input->post($datos_in_unidad);
// echo '<br>Datos in Cantidad:<br>';
// var_dump($unidad);
// echo '<br>';
// print_r($unidad);
// echo '<br>';



// =====================================================================
// == Comentando para poder escribir en db almacen en tabla productos.==
// ============================== Para XML1.============================
// $cantidad = $this->input->post('cantidad');
// $unidad = $this->input->post('unidad');
// $modelo = $this->input->post('modelo');
// $descripcion = $this->input->post('descripcion');
// $valorunitario = $this->input->post('valorunitario');
// $fecha_ingreso = $this->input->post('fecha_ingreso');
// $noserie = $this->input->post('noserie');
// $nopieza = $this->input->post('nopieza');
// $this->up_xml_model->productos_data_insert($cantidad, $unidad, $modelo, $descripcion, $valorunitario, $fecha_ingreso, $noserie, $nopieza);
// echo '<br>Insertando Datos...<br>';
// =====================================================================



//=====================================================================
//== Comentando para poder escribir en db almacen en tabla productos.==
//============================== Para XML2.============================
// $cantidad = $this->input->post('cantidad');
// $unidad = $this->input->post('unidad');
// $modelo = $this->input->post('modelo');
// $descripcion = $this->input->post('descripcion');
// $valorunitario = $this->input->post('valorunitario');
// $fecha_ingreso = $this->input->post('fecha_ingreso');
// $noserie = $this->input->post('noserie');
// $nopieza = $this->input->post('nopieza');
// $this->up_xml_model->productos_data_insert($cantidad, $unidad, $modelo, $descripcion, $valorunitario, $fecha_ingreso, $noserie, $nopieza);
// echo '<br>Insertando Datos...<br>';
//=====================================================================







$this->load->view('up_xml_view1', $array);
$this->load->view('up_xml_in_view1a',$cant,$uuid,$array);
$this->load->view('up_xml_in_view1',$cant,$cont,$cant_1,$descrip_1,$array);
// $this->load->view('up_xml_in_view1a',$cant,$uuid,$array);
		echo '<br>';
		// print_r($file_information);
		// echo $file_information;
		echo '<br>';
		
		$this->output->enable_profiler(TRUE);

	}










}

