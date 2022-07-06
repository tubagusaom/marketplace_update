function addTab(title, content){  
	$('#tt').tabs('add',{  
		title:title,  
		content: content,
		closable:true,
		onLoad: function(panel){
			if(panel[0] == '{"failed":"Operation Not Allowed"}'){
				$.messager.confirm('Koneksi bermasalah','Sepertinya koneksi anda ke server bermasalah, ulangi koneksi ?',function(r){
					if(r){
						window.location.reload();
					}
				})
			};
		}
	});  
}

$('body').on('click', ".sidebar-group-menu>li>a", function(e){	
	var title = $(this).text();
	var address = $(this).attr('href');
	if(address.indexOf('index') != -1)
	{
		if ($('#tt').tabs('exists', title))
		{  
			$('#tt').tabs('select', title);  
		}
		else
		{
			var link_href = $(this).attr('href');
			var link_url = "";
			if(link_href.charAt(link_href.length -1) == "/")
			{
				link_url = link_href;
			}
			else
			{
				link_url = link_href + '/';
			}
			$.ajax({
				url: link_url,
				dataType: 'json',
				type: 'GET',
				success: function(result){
					if(result.msgType == 'error')
					{
						$.messager.alert('Error', result.msgValue);
					}			
					else
					{
						addTab(title, '<div>' + result.msgValue + '</div>');
					}
				}
			})
		}
	}
	else
	{
		modal_({url: address});
	}	
	e.preventDefault();
})
var base_url = "<?php echo base_url() ?>";

function detail_pesan(){
    var title = 'Ticket Support';
    
	var address = base_url+'pesan/index';
	if(address.indexOf('index') != -1)
	{
		if ($('#tt').tabs('exists', title))
		{  
			$('#tt').tabs('select', title);  
		}
		else
		{
			var link_href = 'pesan/index';
			var link_url = "";
			if(link_href.charAt(link_href.length -1) == "/")
			{
				link_url = link_href;
			}
			else
			{
				link_url = link_href + '/';
			}
			$.ajax({
				url: link_url,
				dataType: 'json',
				type: 'GET',
				success: function(result){
					if(result.msgType == 'error')
					{
						$.messager.alert('Error', result.msgValue);
					}			
					else
					{
						addTab(title, '<div>' + result.msgValue + '</div>');
					}
				}
			})
		}
	}
	else
	{
		modal_({url: address});
	}	
	//e.preventDefault();
}
function change_pwd()
{
	var link_href = 'users/change_password';
			var link_url = "";
			if(link_href.charAt(link_href.length -1) == "/")
			{
				link_url = link_href;
			}
			else
			{
				link_url = link_href + '/';
			}
	url_ = link_url;
	
	$.ajax({
		url: link_url,
		dataType: 'json',
		type: 'GET',		
		success: function(result){
			if(result.msgType == 'error')
			{
				$.messager.alert('Error', result.msgValue);
			}
			else
			{
				var heigth = ($('body').height() - 250)/2;
				$('#dlg').dialog({
					title: 'Ganti Password',
					width: 400,
					height: 250,
					content: result.msgValue,
					top: heigth,
					modal: true,
					cache: false,
					buttons:[{
						text:'Simpan',
						iconCls: 'icon-save',
						handler:function(){
							sendIt_();
						}
					},{
						text:'Batal',
						iconCls: 'icon-cancel',
						handler:function(){
							$('#dlg').dialog('close');
						}
					}]
				})
				$('#dlg').show();
				$('#dialog-content').html(result.msgValue);
			}
		}
	})
}

$.extend($.fn.validatebox.defaults.rules, {
	NIP: {
		validator: function (value, param) {
			return /^((\d{8} \d{6} \d{1} \d{3}))$/.test(value);
		},
		message: 'Format NIP salah'
	}
});