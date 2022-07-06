<div id="dlg" style="display: none;margin: auto;"><div id="dialog-content"></div></div>
<div class="easyui-layout" data-options="fit:'true'">
	<div data-options="region:'north'" style="height:50px">
		<div class="easyui-layout" data-options="fit:true, border: false">
			<div data-options="region:'west', border: false, fit: true" style="width: 30%;background-color: #fff;">
				<table border="0" cellpadding="0" cellspacing="0" style="margin: 0;">
					<tr>
						<td>
							<a href="">
								<img src="<?=base_url()?>assets/img/logo_transparent.png" style="width:43px;margin:0px; padding: 0px; margin-top: 10px;margin-left: 15px; float: left;border:0px;"/>
							</a>
						</td>
					</tr>
				</table>
			</div>
			<div data-options="region:'east', border: false" style="width: 70%;background-color: #fff;">
				<div style="float: right; margin: 10px;">
					<a href="javascript: void(0);" class="easyui-menubutton" iconCls="icon-person" menu="#mm1"><?php echo $nama_user ?></a>
					<a href="<?php echo base_url() ?>home/about" class="easyui-menubutton" iconCls="icon-help" menu="#help-menu"> Bantuan</a>
					<a href="javascript: void(0);" onclick="detail_pesan()" class="easyui-linkbutton" iconCls="icon-email"> <?=$unread_message?> Pesan</a>
          <a href="<?php echo base_url() ?>users/logout" class="easyui-linkbutton" iconCls="icon-logout"> Logout&nbsp;&nbsp;</a>
					<div id="mm1" style="width:150px;">
						<div id="role-btn">Role: <?php echo $rolename ?></div>
						<div class="menu-sep"></div>
						<div data-options="name:'change_pwd',iconCls:'icon-password'" onclick="change_pwd();">Ganti Password</div>
					</div>
					<div id="help-menu" style="width:150px;">
						<div>FAQ</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div data-options="region:'south',split:true" style="height:50px;">
		<div class="x-form-copyright" style="bottom: 10px;"> &copy;2021 <?=$aplikasi->singkatan_unit?>, Developed By <a href="http://aom.my.id" target="_blank">TB</a> Team </div>
	</div>
	<div data-options="region:'west',split:true" title="" style="width:250px;" id="west-layout">
		<div class="easyui-accordion" id="accordion-menu" data-options="fit:true,border:false">
			<div class="easyui-accordion" style="width:100%;height:100%;">
				<?php if(isset($menus)) echo $menus ?>
			</div>
		</div>
	</div>
	<div data-options="region:'center', iconCls:'icon-ok'" style="height: 100%;">
		<div class="easyui-tabs" data-options="fit:true,border:false,plain:false" id="tt">
			<div title="Selamat Datang">
				<div  style="width: 100%; margin: 0; position: relative; padding-top: 75px;">
					<div style="width: 490px; margin: auto;padding:0;">
						<div id="win" class="easyui-panel" style="width:480px; height:320px;padding: 0;" data-options="minimizable: false, maximizable: false, closable: false, collapsible: false, border: false">
							<div class="x-window-body" style="height: 300px; width: 464px; padding:0; background-position: center bottom">
								<div class="form-intro">
									<div class="form-intro-container">
										<div class="form-intro-label"><?=$aplikasi->singkatan_unit?></div>
										<div class="form-intro-outersep">
											<div class="form-intro-sepx"> </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
