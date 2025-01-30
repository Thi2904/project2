function Validator(options) {

    // Lấy giá trị của phần tử cha theo selector chỉ định
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var selectorRules = {};

    // Hàm thực hiện validate
    function validate(inputElement, rule) {
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage;

        var rules = selectorRules[rule.selector];

        for (var i = 0; i < rules.length; ++i) {
            errorMessage = rules[i](inputElement.value);
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    // Lấy tất cả các form theo selector
    var formElements = document.querySelectorAll(options.form);

    // Duyệt qua tất cả các form
    formElements.forEach(function(formElement) {
        if (formElement) {
            formElement.onsubmit = function(e) {
                var isFormValid = true;

                options.rules.forEach(function(rule) {
                    var inputElement = formElement.querySelector(rule.selector);
                    var isValid = validate(inputElement, rule);
                    if (!isValid) {
                        isFormValid = false;
                    }
                });

                if (!isFormValid) {
                    e.preventDefault();
                } else {
                    if (typeof options.onSubmit === 'function') {
                        var formEnabledInputs = formElement.querySelectorAll('[name]');
                        var formValues = Array.from(formEnabledInputs).reduce(function(values, input) {
                            values[input.name] = input.value;
                            return values;
                        }, {});
                        options.onSubmit({
                            formValues: formValues
                        });
                    }
                }
            };

            options.rules.forEach(function(rule) {
                if (Array.isArray(selectorRules[rule.selector])) {
                    selectorRules[rule.selector].push(rule.test);
                } else {
                    selectorRules[rule.selector] = [rule.test];
                }

                var inputElement = formElement.querySelector(rule.selector);
                if (inputElement) {
                    inputElement.onblur = function() {
                        validate(inputElement, rule);
                    };

                    inputElement.oninput = function() {
                        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                        errorElement.innerText = '';
                        getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                    };
                }
            });
        }
    });
}

// Định nghĩa các rules
Validator.isRequired = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            return value.trim() ? undefined : message || 'Vui lòng nhập trường này';
        }
    };
};

Validator.isEmail = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return regex.test(value) ? undefined : message || 'Trường này phải là email';
        }
    };
};

Validator.minLength = function(selector, min, message) {
    return {
        selector: selector,
        test: function(value) {
            return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} ký tự`;
        }
    };
};

Validator.isConfirmed = function(selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function(value) {
            return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác';
        }
    };
};

Validator.isFileType = function(selector, allowedExtensions, message) {
    return {
        selector: selector,
        test: function(value) {
            const fileExtension = value.split('.').pop().toLowerCase();
            return allowedExtensions.includes(fileExtension) ? undefined : message || `Tệp phải có định dạng: ${allowedExtensions.join(', ')}`;
        }
    };
};
