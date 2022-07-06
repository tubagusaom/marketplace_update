$.extend($.fn.validatebox.defaults.rules, {
				CHS: {
					validator: function (value, param) {
						return /^[\u0391-\uFFE5]+$/.test(value);
					},
					message: 'Please enter Chinese characters'
				},
				english : {// Test of English
			        validator : function(value) {
			            return /^[A-Za-z]+$/i.test(value);
			        },
			        message : 'Please enter English'
			    },
			    ip : {// Verify that the IP address
			        validator : function(value) {
			            return /\d+\.\d+\.\d+\.\d+/.test(value);
			        },
			        message : 'The IP address is not in the correct format'
			    },
				ZIP: {
					validator: function (value, param) {
						return /^[0-9]\d{5}$/.test(value);
					},
					message: 'Postal code does not exist'
				},
				QQ: {
					validator: function (value, param) {
						return /^[1-9]\d{4,10}$/.test(value);
					},
					message: 'The QQ number is not correct'
				},
				mobile: {
					validator: function (value, param) {
						return /^(?:13\d|15\d|18\d)-?\d{5}(\d{3}|\*{3})$/.test(value);
					},
					message: 'Mobile phone number is not correct'
				},
				tel:{
					validator:function(value,param){
						return /^(\d{3}-|\d{4}-)?(\d{8}|\d{7})?(-\d{1,6})?$/.test(value);
					},
					message:'The phone number is not correct'
				},
				mobileAndTel: {
					validator: function (value, param) {
						return /(^([0\+]\d{2,3})\d{3,4}\-\d{3,8}$)|(^([0\+]\d{2,3})\d{3,4}\d{3,8}$)|(^([0\+]\d{2,3}){0,1}13\d{9}$)|(^\d{3,4}\d{3,8}$)|(^\d{3,4}\-\d{3,8}$)/.test(value);
					},
					message: 'Please input correct phone number'
				},
				number: {
					validator: function (value, param) {
						return /^[0-9]+?[0-9]*$/.test(value);
					},
					message: 'Please enter a number'
				},
				money:{
					validator: function (value, param) {
					 	return (/^(([1-9]\d*)|\d)(\.\d{1,2})?$/).test(value);
					 },
					 message:'Please enter the correct amount'

				},
				mone:{
					validator: function (value, param) {
					 	return (/^(([1-9]\d*)|\d)(\.\d{1,2})?$/).test(value);
					 },
					 message:'Please enter an integer or decimal'

				},
				integer:{
					validator:function(value,param){
						return /^[+]?[1-9]\d*$/.test(value);
					},
					message: 'Please enter a minimum of 1 integer'
				},
				integ:{
					validator:function(value,param){
						return /^[+]?[0-9]\d*$/.test(value);
					},
					message: 'Please enter an integer'
				},
				range:{
					validator:function(value,param){
						if(/^[1-9]\d*$/.test(value)){
							return value >= param[0] && value <= param[1]
						}else{
							return false;
						}
					},
					message:'The number of input in the {0} to {1}'
				},
				minLength:{
					validator:function(value,param){
						return value.length >=param[0]
					},
					message:'Enter at least {0} words'
				},
				maxLength:{
					validator:function(value,param){
						return value.length<=param[0]
					},
					message:'Most {0} words'
				},
				//Select is the selection box verification
				selectValid:{
					validator:function(value,param){
						if(value == param[0]){
							return false;
						}else{
							return true ;
						}
					},
					message:'Please select'
				},
				idCode:{
					validator:function(value,param){
						return /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(value);
					},
					message: 'Please enter a valid identity card number'
				},
				loginName: {
					validator: function (value, param) {
						return /^[\u0391-\uFFE5\w]+$/.test(value);
					},
					message: 'The logon name only allows Chinese characters, letters, numbers and underscores English. '
				},
				equalTo: {
					validator: function (value, param) {
						return value == $(param[0]).val();
					},
					message: 'Two input character is not one to'
				},
				englishOrNum : {// English and digital input only
			        validator : function(value) {
			            return /^[a-zA-Z0-9_ ]{1,}$/.test(value);
			        },
			        message : 'Please enter English, digital, underlined or spaces'
			    },
			   xiaoshu:{ 
		        validator : function(value){ 
		        return /^(([1-9]+)|([0-9]+\.[0-9]{1,2}))$/.test(value);
		        }, 
		        message : 'Up to two decimal places！'    
		    	},
		    ddPrice:{
				validator:function(value,param){
					if(/^[1-9]\d*$/.test(value)){
						return value >= param[0] && value <= param[1];
					}else{
						return false;
					}
				},
				message:'Please enter a positive integer between 1 to 100'
			},
			jretailUpperLimit:{
				validator:function(value,param){
					if(/^[0-9]+([.]{1}[0-9]{1,2})?$/.test(value)){
						return parseFloat(value) > parseFloat(param[0]) && parseFloat(value) <= parseFloat(param[1]);
					}else{
						return false;
					}
				},
				message:'Please enter between 0 to 100 up to two decimal digits'
			},
			rateCheck:{
				validator:function(value,param){
					if(/^[0-9]+([.]{1}[0-9]{1,2})?$/.test(value)){
						return parseFloat(value) > parseFloat(param[0]) && parseFloat(value) <= parseFloat(param[1]);
					}else{
						return false;
					}
				},
				message:'Please enter between 0 to 1000 up to two decimal digits'
			}
			});