$.extend($.fn.form.methods, {  
	serialize: function(jq){  
		var arrayValue = jq.serializeArray();
		var json = {};
		$.each(arrayValue, function() {
			var item = this;
			if (json[item["name"]]) {
				json[item["name"]] = json[item["name"]] + "," + item["value"];
			} else {
				json[item["name"]] = item["value"];
			}
		});
		return json; 
	},
	getValue:function(jq,name){  
		var jsonValue = $(jq[0]).form("serialize");
		return jsonValue[name]; 
	},
	setValue:function(jq,name,value){
		return jq.each(function () {
			_b(this, _29);
			var data = {};
			data[name] = value;
			$(this).form("load",data);
		});
	},
	getData: function(jq, params){
        var formArray = jq.serializeArray();
        var oRet = {};
        for (var i in formArray) {
            if (typeof(oRet[formArray[i].name]) == 'undefined') {
                if (params) {
                    oRet[formArray[i].name] = (formArray[i].value == "true" || formArray[i].value == "false") ? formArray[i].value == "true" : formArray[i].value;
                }
                else {
                    oRet[formArray[i].name] = formArray[i].value;
                }
            }
            else {
                if (params) {
                    oRet[formArray[i].name] = (formArray[i].value == "true" || formArray[i].value == "false") ? formArray[i].value == "true" : formArray[i].value;
                }
                else {
                    oRet[formArray[i].name] += "," + formArray[i].value;
                }
            }
        }
        return oRet;
    }
}); 

$.extend($.fn.validatebox.defaults.rules, {
	equals: {
		validator: function(value,param){
			return value == $(param[0]).val();
		},
		message: 'isian tidak sama.'
	},
	notequals: {
		validator: function(value,param){
			return value != $(param[0]).val();
		},
		message: 'isian harus berbeda'
	},
	phonenumber: {
		validator: function(value,param){
			var reg = /^0[1-9]{2,3}-[0-9]{4,}/i;
			return reg.test(value);
		},
		message: 'format nomor telepon yang benar (kode daerah)-(nomor telepon)'
	},
	mobile: {
		validator: function(value,param){
			var reg = /^0\d{8,15}/i;
			return reg.test(value);
		},
		message: 'format nomor mobile anda salah'
	}
});

$.fn.datebox.defaults.formatter = function(date) {
var y = date.getFullYear();
var m = date.getMonth() + 1;
var d = date.getDate();
return (d < 10 ? '0' + d : d) + '/' + (m < 10 ? '0' + m : m) + '/' + y;
};

$.fn.datebox.defaults.parser = function(s) {
if (s) {
var a = s.split('/');
var d = new Number(a[0]);
var m = new Number(a[1]);
var y = new Number(a[2]);
var dd = new Date(y, m-1, d);
return dd;
} else {
return new Date();
}
};