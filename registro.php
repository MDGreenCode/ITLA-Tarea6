<?php
	$respuesta = "";
	
	$CI =& get_instance();
	if($_POST){
		
		$datos = $_POST;
		$datos['ip'] = $_SERVER['REMOTE_ADDR'];
		
		$CI->db->insert('personas', $datos);
		$mensaje = "Registro exitoso"
	}
?>

<html>
	<head>
	 <title>Registros<title>
	 <!-- Latest compiled and minified CSS -->
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	 <!-- Optional theme -->
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	 <!-- Latest compiled and minified JavaScript -->
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	</head>
	<body>
		<div class="container" >
			<h3><?php echo $mensaje ?></h3>
			<h2>Tu firma aqui</h2>
			<form method="post">
				<div class="row" >
					<div class="col col-sm-6">
						<div class="form-group input-group">
							<span class="input-group-addon">Cedula</span>
							<input type="text" class="form-control" name="Cedula"/>
						</div>
					</div>
					<div class="col col-sm-6">
						<div class="form-group input-group">
							<span class="input-group-addon">Nombre</span>
							<input type="text"class="form-control" name="Nombre"/>
					</div> 
						</div>
					</div>
					<div class="col col-sm-6">
						<div class="form-group input-group">
							<span class="input-group-addon">Apellido</span>
							<input type="text" class="form-control" name="Apellido"/>
						</div>
					</div>
					<div class="col col-sm-6">
						<div class="form-group input-group">
							<span class="input-group-addon">Telefono</span>
							<input type="text" class="form-control" name="Telefono"/>
						</div>
					</div>
					<div class="col col-sm-6">
						<div class="form-group input-group">
							<span class="input-group-addon">Comentario</span>
							<textarea class="form-control" name="Comentario"></textarea>
						</div>
					<div class="text-center">
						<button class="btn btn-success" type="submit">Guardar</button>
						<a href="<?php base_url('app') ?>" class="btn btn-warning"></a>
					</div>
				</div>
				<input type="hidden" name="lat" id="lat">
				<input type="hidden" name="lon" id="lon">
			</form>
		</div> 
		<script>
			window.onload = function(){
				navigator.geolocation.getCurrentPosition(function(datos){
					document.getElementById('lat').value = datos.coords.latitude;
					document.getElementById('lon').value = datos.coords.longitude;
				}
				
				
			}
		</script>
	</body>
	<script>
		function initmap(){
			var mylatLng = {lat: 18.45, lng: -69.66};
			
			var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 7,
			center: mylatLng
			});
			<?php
				
				$CI =& get_instace();
				
				$rs = $CI->db->query("select * from personas order by id desc limit 10")
				
				$datos = $rs->result();
				
				foreach($datos as $persona){
					
					echo " myLatLng = {lat: {$persona->lat}, lng: {$persona->lon}};
					var marker = new google.maps.Marker({
						posistion: mylatLng,
						map: map,
						title: 'Mapa'
					});";
					
				}
			?>
		}
	</script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF_QnJG-NCFziHUlue2J-xb2sKuF1GE1U&region=GB"
	type="text/javascript">
	</script>
</html>