<div class="form-panel" style="margin-left: 50px;margin-top: 50px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<div class="x-form-item">
				<div class="x-form-item-label" style="width: 100px;">Password lama : </div>
				<div class="x-form-element">
					<input class="x-form-input" style="margin-left: 10px;" name="old_pwd" id="old_pwd" type="password" autocomplete="off">
				</div>
			</div>
			<div class="x-form-item">
				<div class="x-form-item-label" style="width: 100px;">Password baru : </div>
				<div class="x-form-element">
					<input class="x-form-input" style="margin-left: 10px;" name="new_pwd" id="new_pwd" type="password" autocomplete="off">
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$('.x-form-input').textbox({
		iconCls: 'icon-password',
		width: 200,
		required: true
	});
	$("#new_pwd").textbox({
		validType: "notequals['#old_pwd']"
	})
</script>