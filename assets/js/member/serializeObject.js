jQuery.fn.serializeObject = function(opt){
	
	opt = $.extend({}, opt);
	if (typeof opt['disabled'] === 'undefined' || opt['disabled'] === null) {
		opt['disabled'] = false;
	}
	if (typeof opt['all'] === 'undefined' || opt['all'] === null) {
		opt['all'] = false;
	}
	if (typeof opt['empty'] === 'undefined' || opt['empty'] === null) {
		opt['empty'] = true;
	}
	
	var assign_object = function (obj, keyPath, value, create, force, as_obj, force_append) {
		if (!keyPath || !keyPath.length) {
			return false;
		}

		if ($.type(keyPath) !== 'array') {
			if ($.type(keyPath) === 'number' || $.type(keyPath) === 'string') {
				keyPath = [keyPath];
			} else {
			return false;
			}
		}

		var lastKeyIndex = keyPath.length - 1, key;

		create = (create === undefined) ? true : create;
		force = (force === undefined) ? false : force;
		as_obj = (as_obj === undefined) ? false : as_obj;
		force_append = (force_append === undefined) ? false : force_append;

		if (value !== undefined && as_obj) {
			as_obj = false;
		}

		for (var i = 0; i < lastKeyIndex; i++) {
			key = keyPath[i];

			if (key in obj) {
				obj = obj[key];
			} else {
				if (!create) {
					return false;
				}
				obj[key] = {};
				obj = obj[key];
			}
		}

		if (typeof obj[keyPath[lastKeyIndex]] !== 'undefined' && value !== undefined) {
			if ($.type(obj[keyPath[lastKeyIndex]]) === 'array' && !force && !force_append) {
				if ($.type(value) === 'array') {
					Array.prototype.push.apply(obj[keyPath[lastKeyIndex]], value);
				} else {
					obj[keyPath[lastKeyIndex]].push(value);
				}
			} else {
				if (force_append) {
					obj[keyPath[lastKeyIndex]] = Array.prototype.concat.call(obj[keyPath[lastKeyIndex]], value);
				} else {
					obj[keyPath[lastKeyIndex]] = value;
				}
			}
		} else {
			if (value !== undefined) {
				obj[keyPath[lastKeyIndex]] = value;
			}
		}

		return as_obj ? obj[keyPath[lastKeyIndex]] : [obj, keyPath[lastKeyIndex]];
	};
	
	var
		$form = $(this),
		result = {},
		formValues =
			$form
				.find('input,textarea,select,keygen')
				.filter(function () {
					var ret = true;
					if (!opt['disabled']) {
						ret = !this.disabled;
					}
					return ret && $.trim(this.name);
				})
				.map(function () {
					var
						$this = $(this),
						radios,
						options,
						value = null;
					if ($this.is('[type="radio"]') || $this.is('[type="checkbox"]')) {
						if ($this.is('[type="radio"]')) {
							radios = $form.find('[type="radio"][name="' + this.name + '"]');
							if (radios.filter('[checked]').size()) {
								value = radios.filter('[checked]').val();
							}
						} else if ($this.prop('checked')) {
							value = $this.is('[value]') ? $this.val() : 1;
						}
					} else if ($this.is('select')) {
						options = $this.find('option').filter(':selected');
						if ($this.prop('multiple')) {
							value = options.map(function () {
								return this.value || this.innerHTML;
							}).get();
						} else {
							value = options.val();
						}
					} else {
						value = $this.val();
					}
					return {
						'name':this.name || null,
						'value':value
					};
				}).get();
	if (formValues) {
		var
			i,
			value,
			name,
			$matches,
			len,
			offset,
			j,
			fields;

		for (i = 0; i < formValues.length; i++) {
			name = formValues[i].name;
			value = formValues[i].value;

			if (!opt['all']) {
				if (value === null) {
					continue;
				}
			} else {
				if (value === null) {
					value = '';
				}
			}
			if (value === '' && !opt['empty']) {
				continue;
			}
			if (!name) {
				continue;
			}
			$matches = name.split(/\[/);
			len = $matches.length;
			for (j = 1; j < len; j++) {
				$matches[j] = $matches[j].replace(/\]/g, '');
			}
			fields = [];
			for (j = 0; j < len; j++) {
				if ($matches[j] || j < len - 1) {
					fields.push($matches[j].replace("'", ''));
				}
			}
			if ($matches[len - 1] === '') {
				offset = assign_object(result, fields, [], true, false, false);
				if (value.constructor === Array) {
					offset[0][offset[1]].concat(value);
				} else {
					offset[0][offset[1]].push(value);
				}
			} else {
				assign_object(result, fields, value);
			}
		}
	}
	return result;
}