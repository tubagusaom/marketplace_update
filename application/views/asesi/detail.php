
				<section class="page-header">
				    <div class="container">
				        <div class="row">
				            <div class="col-md-12">
				                <ul class="breadcrumb">
				                    <li><a href="<?=base_url()?>">Home</a></li>
				                    <li class="active">Pemegang Sertifikat</li>
				                </ul>
				            </div>
				        </div>
				        <div class="row">
				            <div class="col-md-12">
				                <h1>Profile Pemegang Sertifikat</h1>
				                </div>
				            </div>
				        </div>
				</section>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-9" style="margin-top: 25px;">
							<?php foreach ($asesi as $value) { ?>
								<div class="col-md-3">
									<span class="img-thumbnail-profile">
										<img alt="" class="img-responsive" src="http://www.redcarpetsystems.com/wp-content/uploads/2014/05/fashion-runway-rental-redcarpetsystems-dot-com-03-535x535.jpg" style="width: 400px; height: 150px; border: 1px solid #ddd; padding: 4px; 
										border-radius: 10px;">
									</span>									
								</div>
								<div class="col-md-6" style="margin-top: 30px; border-bottom: 1px solid #ddd;">
									<h2 class="mb-none">
										<strong>
										<?= $value->nama_lengkap ?>
										</strong>
									</h2>
									<h4 class="heading-tertiary">
										Auditor Hukum
									</h4>
								</div>
								<table class="table table-user-information" style="color: black; font-size: 15px;">

									<thead>
										<tr>
											<td colspan="2" style="text-align: center; font-size: 30px;">Infomasi Pribadi</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Nama Lengkap :</td>
											<td ><?= $value->nama_lengkap ?></td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir :</td>
											<td>
												<?php 
												$tgl_lahir = $value->tgl_lahir;
												echo $value->tempat_lahir.','.tgl_indo($tgl_lahir); 
												?>
											</td>
										</tr>
										<tr>
											<td>
												Jenis Kelamin : 
											</td>
											<td><?= $value->jenis_kelamin ?></td>
										</tr>
										<tr>
											<td>Email :</td>
											<td><?= $value->email ?></td>
										</tr>
										<tr>
											<td>Komentar: </td>
											<td></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-user-information" style="color: black; font-size: 15px;">
									<thead>
										<tr>
											<td colspan="2" style="text-align: center; font-size: 30px;">Informasi Sertifikasi Kompetensi</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>No. Identitas :</td>
											<td></td>
										</tr>
										<tr>
											<td>Skema Sertifikasi :</td>
											<td>Auditor Hukum</td>
										</tr>
										<tr>
											<td>Asesor Kompetensi :</td>
											<td></td>
										</tr>
										<tr>
											<td>Tempat Uji Kompetensi :</td>
											<td>TUK Jimmy School</td>
										</tr>
										<tr>
											<td>Sertifikat :</td>
											<td>Sertifikat berlaku dari ... s/d ...</td>
										</tr>
									</tbody>
								</table>
							<?php } ?>
							</div>
							<div class="col-md-3">
								<?php $this->load->view('profile/left_menu_profile'); ?>
							</div>							
						</div>
					</div>
				</div>