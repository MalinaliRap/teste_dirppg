<?php
/**
 * Template : https://gist.github.com/bMinaise/7329874
 * User: Gabriel Coplas Becher
 * Date: 13/09/2018
 * Time: 15:36
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container" ng-controller="ctrRecuperarSenha">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="account-wall">
					<h3 class="text-center">Esqueceu a sua senha?</h3>
					<form ng-submit="" class="form-signin">
						<div ng-show="div_gerar_token">
							<p class="text-center">Digite seu email e receba o código de recuperação por e-mail</p>
							<input ng-model="email" type="text" class="form-control" placeholder="Email" autofocus>
							<button ng-click="getToken();" class="btn btn-lg btn-primary btn-block">
								Gerar Token</button>
						</div>
						<div ng-show="div_recuperar_senha">
							<p class="text-center">Recebeu o código por email? digite no campo abaixo</p>
							<input ng-model="token" type="text" class="form-control" placeholder="Token">
							<button ng-click="enviarToken();" class="btn btn-lg btn-primary btn-block" type="submit">
								Recuperar senha</button>

							<button ng-click="showPanel();" class="btn btn-lg btn-secondary btn-block">
								Voltar</button>
						</div>
						<label class="checkbox pull-left">
						</label>
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
