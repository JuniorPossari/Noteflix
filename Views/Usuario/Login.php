
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="pt-BR">
	<!--begin::Head-->
	<head><base href="../../../">
		<meta charset="utf-8" />
		<title>Noteflix</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="/Metronic/demo2/dist/assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="/Metronic/demo2/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/Metronic/demo2/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/Metronic/demo2/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="/Content/icon/noteflix.ico" />

        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<style>
			.img-auto-size {
				width: 100%;
				height: auto;
			}
		</style>


	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url(/Metronic/demo2/dist/assets/media/bg/bg-10.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
					<!--begin: Aside Container-->
					<div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
						<!--begin::Logo-->
						<a href="/Home/Index" class="text-center pt-2">
							<img src="/Content/icon/noteflix.png" class="max-h-75px" alt="" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside body-->
						<div class="d-flex flex-column-fluid flex-column flex-center">
							<!--begin::Signin-->
							<div class="login-form login-signin py-11">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_login_signin_form">
									<!--begin::Title-->
									<div class="text-center pb-8">
										<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Entrar</h2>
										<span class="text-muted font-weight-bold font-size-h4">Ou
										<a href="" class="text-primary font-weight-bolder" id="kt_login_signup">Criar Conta</a></span>
									</div>
									<!--end::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="email" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">
										<div class="d-flex justify-content-between mt-n5">
											<label class="font-size-h6 font-weight-bolder text-dark pt-5">Senha</label>
											<a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Esqueceu sua senha?</a>
										</div>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Action-->
									<div class="text-center pt-2">
										<button id="kt_login_signin_submit" class="btn btn-lg btn-light-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Entrar</button>
									</div>
									<!--end::Action-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Signin-->
							<!--begin::Signup-->
							<div class="login-form login-signup pt-11">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_login_signup_form">
									<!--begin::Title-->
									<div class="text-center pb-8">
										<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Criar conta</h2>
										<p class="text-muted font-weight-bold font-size-h4">Preencha as informações para se cadastrar.</p>
									</div>
									<!--end::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="text" placeholder="Usuário" name="username" autocomplete="off" maxlength="20" minlength="8" data-fv-string-length___message="O nome de usuário deve ter entre 8 e 20 caracteres!" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="text" placeholder="Email" name="email" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="password" placeholder="Senha" name="password" autocomplete="off" minlength="8" data-fv-string-length___message="A senha deve ter no mínimo 8 caracteres!" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirmar senha" name="cpassword" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">										
										<div class="ml-3">
											<div class="checkbox-inline">
												<label class="checkbox checkbox-primary">
													Eu concordo com os <a class="ml-2" href="#">termos de uso</a>.
													<input type="checkbox" name="agree" />
													<span class="ml-2"></span>
												</label>
											</div>
										</div>
									</div>
									
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
										<button type="button" id="kt_login_signup_submit" class="btn btn-lg btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cadastrar</button>
										<button type="button" id="kt_login_signup_cancel" class="btn btn-lg btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancelar</button>
									</div>
									<!--end::Form group-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Signup-->
							<!--begin::Forgot-->
							<div class="login-form login-forgot pt-11">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
									<!--begin::Title-->
									<div class="text-center pb-8">
										<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Esqueceu a senha ?</h2>
										<p class="text-muted font-weight-bold font-size-h4">Preencha com o Email cadastrado.</p>
									</div>
									<!--end::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="text" placeholder="Email" name="email" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
										<button type="button" id="kt_login_forgot_submit" class="btn btn-lg btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Enviar</button>
										<button type="button" id="kt_login_forgot_cancel" class="btn btn-lg btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancelar</button>
									</div>
									<!--end::Form group-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Forgot-->
						</div>
						<!--end::Aside body-->
					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-image: url(/Metronic/demo2/dist/assets/media/bg/bg-1.jpg); background-size: cover;">
					<!--begin::Title-->
					<div class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
						<h3 class="display4 font-weight-bolder my-7">Dê sua nota!</h3>
						<p class="font-weight-bolder font-size-h2-md font-size-lg opacity-80">Avalie suas obras favoritas do cinema.
						<br/>Conteúdo 100% atualizado com as séries e filmes mais recentes.</p>
					</div>
					<!--end::Title-->
					<!--begin::Image-->
					<div class="container">
                        <img class="opacity-70 img-auto-size"  src="/Content/icon/noteflix-pipoca.png" >
                    </div>
					<!--end::Image-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="/Metronic/demo2/dist/assets/plugins/global/plugins.bundle.js"></script>
		<script src="/Metronic/demo2/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="/Metronic/demo2/dist/assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="/Scripts/Usuario/Login.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>

