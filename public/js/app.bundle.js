/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/custom.js":
/*!**************************!*\
  !*** ./src/js/custom.js ***!
  \**************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return custom; });\nfunction custom() {\n  $(document).ready(function () {\n    $(\".submenu > a\").click(function (e) {\n      e.preventDefault();\n      var $li = $(this).parent(\"li\");\n      var $ul = $(this).next(\"ul\");\n\n      if ($li.hasClass(\"open\")) {\n        $ul.slideUp(350);\n        $li.removeClass(\"open\");\n      } else {\n        $(\".nav > li > ul\").slideUp(350);\n        $(\".nav > li\").removeClass(\"open\");\n        $ul.slideDown(350);\n        $li.addClass(\"open\");\n      }\n    });\n    /*************** CREATE NEW USER **************************************************************/\n\n    $(document).on('click', '#createUser', function (e) {\n      e.preventDefault();\n      var error_message;\n\n      if ($.trim($('#inputUser').val()).length == 0) {\n        //BootstrapDialog.alert('Въведете потребителско име');\n        return false;\n      } else if ($.trim($('#inputUser').val()).length <= 3) {\n        BootstrapDialog.alert('Прекалено кратко потребителско име. Минимална дължина 4 символа');\n        return false;\n      }\n\n      if ($.trim($('#inputEmail').val()).length == 0) {\n        BootstrapDialog.alert('Въведете поща!');\n        return false;\n      }\n\n      if ($.trim($('#inputPassword').val()).length == 0) {\n        BootstrapDialog.alert('Въведете парола');\n        return false;\n      } else if ($.trim($('#inputPasswordConfirm').val()).length == 0) {\n        BootstrapDialog.alert('Потвърдете паролата');\n        return false;\n      } else if ($.trim($('#inputPasswordConfirm').val()) !== $.trim($('#inputPassword').val())) {\n        BootstrapDialog.alert('Паролите не съвпадат');\n        return false;\n      }\n\n      $.ajax({\n        method: 'POST',\n        data: {\n          name: $('#inputUser').val(),\n          pass: $('#inputPassword').val(),\n          email: $('#inputEmail').val(),\n          action: $(this).data('value')\n        }\n      }).done(function (data) {\n        if (data) {\n          BootstrapDialog.show({\n            type: BootstrapDialog.TYPE_SUCCESS,\n            title: 'Успех',\n            message: data,\n            buttons: [{\n              label: 'Разбрах',\n              action: function action() {\n                window.location.replace('./');\n              }\n            }]\n          });\n        }\n      });\n    });\n    $('#calculate_period_amount').on('click', function (e) {\n      e.preventDefault();\n      $.ajax({\n        method: 'POST',\n        url: $(this).data('url'),\n        data: {\n          startPeriod: $('#startPeriod').val(),\n          endPeriod: $('#endPeriod').val(),\n          categoryId: $(this).data('category'),\n          type: $(\".records_type option:selected\").val()\n        }\n      }).done(function (data) {\n        console.log(data[0].amount / 100);\n\n        if (data) {\n          var amount = data[0].amount > 0 ? data[0].amount / 100 : 0;\n          var message = \"\\u0421\\u0443\\u043C\\u0430\\u0442\\u0430 \\u0437\\u0430 \\u0432\\u044A\\u0432\\u0435\\u0434\\u0435\\u043D\\u0438\\u044F \\u043E\\u0442 \\u0412\\u0430\\u0441 \\u043F\\u0435\\u0440\\u0438\\u043E\\u0434 \\u0435 \".concat(amount, \"\\u043B\\u0432.\");\n          BootstrapDialog.show({\n            type: BootstrapDialog.TYPE_SUCCESS,\n            title: 'Сума',\n            message: message // buttons: [{\n            //     label: 'Разбрах',\n            //     action: function () {\n            //         window.location.replace('./');\n            //     }\n            // }]\n\n          });\n        }\n      });\n    });\n    $('.records_type').select2({\n      placeholder: 'Select an option',\n      width: '50%'\n    });\n    $('.select-period-toggle').on('click', function () {\n      $('.select-period-wrapper').toggle();\n      console.log('Click');\n    });\n  });\n}\n\n//# sourceURL=webpack:///./src/js/custom.js?");

/***/ }),

/***/ "./src/js/main.js":
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _custom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./custom */ \"./src/js/custom.js\");\n\n\n\nObject(_custom__WEBPACK_IMPORTED_MODULE_0__[\"default\"])();\n\n//# sourceURL=webpack:///./src/js/main.js?");

/***/ }),

/***/ "./src/js/test.js":
/*!************************!*\
  !*** ./src/js/test.js ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("//alert('Hello');\n\n//# sourceURL=webpack:///./src/js/test.js?");

/***/ }),

/***/ "./src/scss/style.scss":
/*!*****************************!*\
  !*** ./src/scss/style.scss ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin\n\n//# sourceURL=webpack:///./src/scss/style.scss?");

/***/ }),

/***/ 0:
/*!****************************************************************************************!*\
  !*** multi ./src/js/custom.js ./src/js/main.js ./src/js/test.js ./src/scss/style.scss ***!
  \****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("__webpack_require__(/*! ./src/js/custom.js */\"./src/js/custom.js\");\n__webpack_require__(/*! ./src/js/main.js */\"./src/js/main.js\");\n__webpack_require__(/*! ./src/js/test.js */\"./src/js/test.js\");\nmodule.exports = __webpack_require__(/*! ./src/scss/style.scss */\"./src/scss/style.scss\");\n\n\n//# sourceURL=webpack:///multi_./src/js/custom.js_./src/js/main.js_./src/js/test.js_./src/scss/style.scss?");

/***/ })

/******/ });