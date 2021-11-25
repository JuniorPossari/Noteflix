<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
	<!--begin::Header-->
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">Perfil do usuário</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>
	<!--end::Header-->
	<!--begin::Content-->
	<div class="offcanvas-content pr-5 mr-n5">
		<!--begin::Header-->
		<div class="d-flex align-items-center mt-5">
			<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(<?php if(isset($Foto) && $Foto != ""){ echo 'data:image;base64,'.base64_encode($Foto); }else{ echo '/Noteflix/Content/img/sem-foto.png'; } ?>)">
				<div class="image-input-wrapper border border-dark" style="border-width:2px !important;"></div>
				<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Alterar">
					<i class="fa fa-edit icon-md text-muted"></i>
					<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
					<input type="hidden" name="profile_avatar_remove" />
					<input type="hidden" class="d-none" id="HdnNovaFoto" />
					<input type="hidden" class="d-none" id="HdnVelhaFoto" value="<?php if(isset($Foto) && $Foto != ""){ echo 'data:image;base64,'.base64_encode($Foto); }else{ echo ''; } ?>" />
					<input type="hidden" class="d-none" id="HdnIdUsuario" value="<?php if(isset($Id)){ echo $Id; }else{ echo ''; } ?>">
				</label>
				<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Voltar">
					<i class="ki ki-bold-close icon-xs text-muted"></i>
				</span>
				<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Excluir">
					<i class="ki ki-bold-close icon-xs text-muted"></i>
				</span>
			</div>
			<div class="d-flex flex-column ml-2">
				<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $Nome; ?></a>
				<div class="navi mt-2">
					<a href="#" class="navi-item">
						<span class="navi-link p-0 pb-2">
							<span class="navi-icon mr-1">
								<span class="svg-icon svg-icon-lg svg-icon-primary">
									<!--begin::Svg Icon | path:Metronic/demo2/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
											<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</span>
							<span class="navi-text text-muted text-hover-primary"><?php echo $Email; ?></span>
						</span>
					</a>
					<a href="/Noteflix/Usuario/Sair" class="btn btn-sm btn-light-danger font-weight-bolder py-2 px-5">Sair</a>
				</div>
			</div>
		</div>
		<!--end::Header-->
		<!--begin::Separator-->
		<div class="separator separator-dashed mt-8 mb-5"></div>
		<!--end::Separator-->
		<!--begin::Nav-->
		<div class="navi navi-spacer-x-0 p-0">			
			<!--begin::Item-->
			<a href="Metronic/demo2/dist/custom/apps/user/profile-3.html" class="navi-item">
				<div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
							<span class="svg-icon svg-icon-md svg-icon-warning">
								<!--begin::Svg Icon | path:Metronic/demo2/dist/assets/media/svg/icons/Shopping/Chart-bar1.svg-->
								<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/General/Star.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#000000"/>
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
						</div>
					</div>
					<div class="navi-text">
						<div class="font-weight-bold">Favoritos</div>
						<div class="text-muted">Séries e filmes favoritos</div>
					</div>
				</div>
			</a>
			<!--end:Item-->
			<!--begin::Item-->
			<a href="Metronic/demo2/dist/custom/apps/user/profile-2.html" class="navi-item">
				<div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
							<span class="svg-icon svg-icon-md svg-icon-danger">
								<!--begin::Svg Icon | path:Metronic/demo2/dist/assets/media/svg/icons/Files/Selected-file.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
						</div>
					</div>
					<div class="navi-text">
						<div class="font-weight-bold">Atividades</div>
						<div class="text-muted">Atividades recentes</div>
					</div>
				</div>
			</a>
			<!--end:Item-->				
		</div>
		<!--end::Nav-->
		<!--begin::Separator-->
		<div class="separator separator-dashed my-7"></div>
		<!--end::Separator-->
		<!--begin::Notifications-->
		<div>
			<!--begin:Heading-->
			<h5 class="mb-3">Notificações</h5>
			<!--end:Heading-->

			<!--begin::Item-->
			<div class="bg-hover-light-secondary p-2 mb-1">
				<div class="row">
					<div class="col-md-3 d-flex align-items-center justify-content-center">
						<img class="ml-4" src="/Noteflix/Content/img/uma-noite-alucinante.jpg" style="height: 70px; width: auto;">
					</div>
					<div class="col-md-9">
						<div class="text-left font-weight-bold">Uma noite alucinante!!</div>
											
						<div class="d-flex flex-column mt-2">
							<div>Acabamos de adicionar "Uma noite alucinante" a lista de filmes para avaliar, dê sua nota agora para esse clássico do cinema! :D</div>
							<span class="text-right text-muted font-size-sm">13:35 08/06/2021</span>
						</div>
					</div>
				</div>							
			</div>			
			<!--end::Item-->
			
			<!--begin::Item-->
			<div class="bg-hover-light-secondary p-2 mb-1">
				<div class="row">
					<div class="col-md-3 d-flex align-items-center justify-content-center">
						<div class="ml-4">
							<span class="svg-icon svg-icon-dark">
								<span class="svg-icon svg-icon-lg">
									<!--begin::Svg Icon | path:Metronic/demo2/dist/assets/media/svg/icons/Home/Library.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
											<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</span>
						</div>
					</div>
					<div class="col-md-9">
						<div class="text-left font-weight-bold">Bem vindo!</div>
											
						<div class="d-flex flex-column mt-2">
							<div>Seja bem vindo ao Noteflix, o melhor site de avaliação de filmes e séries!</div>
							<span class="text-right text-muted font-size-sm">23:44 04/06/2021</span>
						</div>
					</div>
				</div>							
			</div>			
			<!--end::Item-->

			<!--begin::Item-->
			<div class="bg-hover-light-secondary p-2 mb-1">
				<div class="row">
					<div class="col-md-3 d-flex align-items-center justify-content-center">
						<img class="ml-4" src="/Noteflix/Content/img/uma-noite-alucinante.jpg" style="height: 70px; width: auto;">
					</div>
					<div class="col-md-9">
						<div class="text-left font-weight-bold">Uma noite alucinante!!</div>
											
						<div class="d-flex flex-column mt-2">
							<div>Acabamos de adicionar "Uma noite alucinante" a lista de filmes para avaliar, dê sua nota agora para esse clássico do cinema! :D</div>
							<span class="text-right text-muted font-size-sm">13:35 08/06/2021</span>
						</div>
					</div>
				</div>							
			</div>			
			<!--end::Item-->
			
			<!--begin::Item-->
			<div class="bg-hover-light-secondary p-2 mb-1">
				<div class="row">
					<div class="col-md-3 d-flex align-items-center justify-content-center">
						<div class="ml-4">
							<span class="svg-icon svg-icon-dark">
								<span class="svg-icon svg-icon-lg">
									<!--begin::Svg Icon | path:Metronic/demo2/dist/assets/media/svg/icons/Home/Library.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
											<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</span>
						</div>
					</div>
					<div class="col-md-9">
						<div class="text-left font-weight-bold">Bem vindo!</div>
											
						<div class="d-flex flex-column mt-2">
							<div>Seja bem vindo ao Noteflix, o melhor site de avaliação de filmes e séries!</div>
							<span class="text-right text-muted font-size-sm">23:44 04/06/2021</span>
						</div>
					</div>
				</div>							
			</div>			
			<!--end::Item-->

			<!--begin::Item-->
			<div class="bg-hover-light-secondary p-2 mb-1">
				<div class="row">
					<div class="col-md-3 d-flex align-items-center justify-content-center">
						<img class="ml-4" src="/Noteflix/Content/img/uma-noite-alucinante.jpg" style="height: 70px; width: auto;">
					</div>
					<div class="col-md-9">
						<div class="text-left font-weight-bold">Uma noite alucinante!!</div>
											
						<div class="d-flex flex-column mt-2">
							<div>Acabamos de adicionar "Uma noite alucinante" a lista de filmes para avaliar, dê sua nota agora para esse clássico do cinema! :D</div>
							<span class="text-right text-muted font-size-sm">13:35 08/06/2021</span>
						</div>
					</div>
				</div>							
			</div>			
			<!--end::Item-->
			
			<!--begin::Item-->
			<div class="bg-hover-light-secondary p-2 mb-1">
				<div class="row">
					<div class="col-md-3 d-flex align-items-center justify-content-center">
						<div class="ml-4">
							<span class="svg-icon svg-icon-dark">
								<span class="svg-icon svg-icon-lg">
									<!--begin::Svg Icon | path:Metronic/demo2/dist/assets/media/svg/icons/Home/Library.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
											<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</span>
						</div>
					</div>
					<div class="col-md-9">
						<div class="text-left font-weight-bold">Bem vindo!</div>
											
						<div class="d-flex flex-column mt-2">
							<div>Seja bem vindo ao Noteflix, o melhor site de avaliação de filmes e séries!</div>
							<span class="text-right text-muted font-size-sm">23:44 04/06/2021</span>
						</div>
					</div>
				</div>							
			</div>			
			<!--end::Item-->
			
		</div>
		<!--end::Notifications-->
	</div>
	<!--end::Content-->
</div>
<!-- end::User Panel-->

<script src="/Noteflix/Scripts/Home/Foto.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        FotoAPI.init();
    });
</script>