<?php
/**
 * Template : https://gist.github.com/bMinaise/7329874
 * User: Gabriel Coplas Becher
 * Date: 13/09/2018
 * Time: 15:36
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container login-panel">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="account-wall">
					<p class="text-center">Sistema do aluno</p>
					<form ng-submit="login();" class="form-signin">
						<input type="text" ng-model="email" class="form-control" placeholder="Email" autofocus>
						<input type="password" ng-model="senha" class="form-control" placeholder="Password">
						<button class="btn btn-lg btn-primary btn-block" type="submit">
							Login</button>
						<label class="checkbox pull-left">
						</label>
						<a href="#!/recuperarsenha" class="pull-right need-help">Esqueceu a senha? </a><span class="clearfix"></span>
					</form>
					<div>
						<a href="#!/" class="btn btn-primary margin10">
							<span class="glyphicon glyphicon-arrow-left"></span> Voltar
						</a>
                    </div>
				</div>
			</div>
		</div>
</div>
