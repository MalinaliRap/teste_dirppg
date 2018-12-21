<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Sistema de Gerenciamento Repfarma</title>
	<meta name="description" content="Sistema de gerenciamento repfarma">
	<meta name="keywords" content="repfarma,Rio de janeiro, Campinas, cursos">
	<meta name="author" content="Gabriel Coplas Becher, Elton José de Almeida">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url();?>assets/image/gauico.png" />

	<!--Google Fontes-->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

	<!--Google Icons-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--Font Awesome Icons-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Bootstrap CSS-->
	<link href="<?php echo base_url();?>node_modules/bootstrap3/dist/css/bootstrap.css" rel="stylesheet">

	<!-- jQuery & Bootstrap -->
	<script src="<?php echo base_url();?>node_modules/jquery/dist/jquery.js"></script>
	<script src="<?php echo base_url();?>node_modules/bootstrap3/dist/js/bootstrap.min.js"></script>

	<!--AngularJS-->
	<script src="<?php echo base_url();?>node_modules/angular/angular.js"></script>

	<!--Angular Route-->
	<script src="<?php echo base_url();?>node_modules/angular-route/angular-route.min.js"></script>

	<!--Angular Material-->
	<script src="<?php echo base_url();?>node_modules/angular-material/angular-material.min.js"></script>

	<!--Angular Animate-->
	<script src="<?php echo base_url();?>node_modules/angular-animate/angular-animate.min.js"></script>

	<!--Angular Aria-->
	<script src="<?php echo base_url();?>node_modules/angular-aria/angular-aria.min.js"></script>

	<!--Angular Messages-->
	<script src="<?php echo base_url();?>node_modules/angular-messages/angular-messages.min.js"></script>

	<!--xlsx-->
	<script lang="javascript" src="<?php echo base_url();?>node_modules/xlsx/dist/xlsx.full.min.js"></script>

	<!--ng-file-upload-->
	<script src="<?php echo base_url();?>/node_modules/ng-file-upload/dist/ng-file-upload-shim.min.js"></script>
	<script src="<?php echo base_url();?>/node_modules/ng-file-upload/dist/ng-file-upload.min.js"></script>

	<!--autocomplete combo buscar aluno-->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
	<script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>

	<!--Checklist-model-->
	<script src="<?php echo base_url();?>/node_modules/checklist-model/checklist-model.js"></script>

	<!--loading bar-->
	<link rel='stylesheet' href='<?php echo base_url();?>node_modules/angular-loading-bar/build/loading-bar.css' type='text/css' media='all' />
	<script type='text/javascript' src='<?php echo base_url();?>node_modules/angular-loading-bar/build/loading-bar.min.js'></script>


	<!--Toast-->
	<link href="<?php echo base_url();?>assets/toastr/toastr.min.css" rel="stylesheet"/>
	<script src="<?php echo base_url();?>assets/toastr/toastr.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/toast-options.js"></script>

	<!--My AngularJS App-->
	<script src="<?php echo base_url();?>assets/js/app.js"></script>
	<script src="<?php echo base_url();?>assets/js/route.js"></script>

	<!--Login e Senha-->
	<script src="<?php echo base_url();?>assets/js/ctrRecuperarSenha.js"></script>
	<script src="<?php echo base_url();?>assets/js/ctrLogin.js"></script>
	<script src="<?php echo base_url();?>assets/js/ctrStaffAlterarSenha.js"></script>

	<!--Aluno-->
	<script src="<?php echo base_url();?>assets/js/aluno/ctrAluno.js"></script>

	<!--page style-->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/common.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/login.css">
	


</head>

<body ng-app="gauchurrascaria">

	<div class="container padding0 col-md-12">
		<ng-view></ng-view>
	</div>

</body>
</html>
