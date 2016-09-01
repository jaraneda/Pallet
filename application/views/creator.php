<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<title>7OC Document Creator v1.0.0</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
		<!-- include summernote css/js-->
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css');?>" />
	</head>
	<body>
		<!-- http://asp-arka.blogspot.cl/2014/09/printing-page-size-in-a4-using-css-paged-media.html -->
		<!-- http://docs.emmet.io/cheat-sheet/ -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div id="toolbar" class="panel panel-default">
						<div class="panel-body">
							<div class="btn-group" role="group" aria-label="...">
								<button type="button" class="btn btn-default" id="agregar-pagina"><i class="fa fa-plus"></i> Nueva página</button>
							</div>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-align-left"></i><span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<div class="btn-group" role="group" aria-label="...">
										<button type="button" class="btn btn-default btn-action" data-action="justifyLeft"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn btn-default btn-action" data-action="justifyCenter"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn btn-default btn-action" data-action="justifyRight"><i class="fa fa-align-right"></i></button>
										<button type="button" class="btn btn-default btn-action" data-action="justifyFull"><i class="fa fa-align-justify"></i></button>
									</div>
								</ul>
							</div>
							
							<div class="btn-group" role="group" aria-label="...">
								<button type="button" class="btn btn-default btn-action" data-action="bold"><i class="fa fa-bold"></i></button>
								<button type="button" class="btn btn-default btn-action" data-action="italic"><i class="fa fa-italic"></i></button>
								<button type="button" class="btn btn-default btn-action" data-action="underline"><i class="fa fa-underline"></i></button>
								<button type="button" class="btn btn-default btn-action" data-action="removeFormat"><i class="fa fa-eraser"></i></button>
							</div>
							<div class="btn-group pull-right" role="group" aria-label="...">
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-crear-documento"><i class="fa fa-floppy-o"></i> Guardar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">Campos variables</div>
						<div class="panel-body">
							<ul id="campos" class="list-unstyled">
								<li class="campo" data-node="texto_1"><span class="label label-primary">TOC FECHA ACTUAL</span></li>
								<li class="campo" data-node="texto_2"><span class="label label-primary">TOC HORA ACTUAL</span></li>
								<li class="campo" data-node="texto_3"><span class="label label-primary">TOC NOMBRES</span></li>
								<li class="campo" data-node="texto_4"><span class="label label-primary">TOC APELLIDO PATERNO</span></li>
								<li class="campo" data-node="texto_5"><span class="label label-primary">TOC APELLIDO MATERNO</span></li>
							</ul>
						</div>
						<div class="panel-footer">
							<button type="button" class="btn btn-default btn-xs" id="agregar-campo"><i class="fa fa-plus"></i> Nuevo Campo</button>
						</div>
					</div>
				</div>
				<div class="col-md-9"><div id="page-container"></div></div>
			</div>
		</div>
		<div class="modal fade" tabindex="-1" role="dialog" id="modal-crear-documento">
			<?php echo form_open('creator/crear_documento', array('id' => 'formulario-crear-documento'));?>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Creación de documento</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="documento_nombre">Nombre de Documento</label>
							<input type="text" class="form-control" name="documento_nombre" placeholder="Nombre de Documento">
						</div>
					</div>
					<input type="hidden" name="documento_paginas">
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="submit-crear-documento">Crear</button>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
		<script src="<?php echo base_url('assets/js/main.js');?>"></script>
	</body>
</html>