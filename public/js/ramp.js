/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/ramp.js":
/*!******************************!*\
  !*** ./resources/js/ramp.js ***!
  \******************************/
/***/ (() => {

eval("//Get all ramps\n$('#ramps-all').DataTable({\n  processing: true,\n  info: true,\n  ajax: rampAllUrl,\n  columns: [{\n    data: 'DT_RowIndex',\n    name: 'DT_RowIndex'\n  }, {\n    data: 'name',\n    name: 'name'\n  }, {\n    data: 'status',\n    name: 'status'\n  }, {\n    data: 'power',\n    name: 'power'\n  }, {\n    data: 'actions',\n    name: 'actions'\n  }]\n}); //Create new ramp\n\n$('#create-ramp-form').on('submit', function (e) {\n  e.preventDefault();\n  var form = this;\n  $.ajax({\n    url: $(form).attr('action'),\n    method: $(form).attr('method'),\n    data: new FormData(form),\n    processData: false,\n    dataType: 'json',\n    contentType: false,\n    beforeSend: function beforeSend() {\n      $(form).find('span.error-text').text('');\n    },\n    success: function success(data) {\n      if (data.code == 0) {\n        $.each(data.error, function (prefix, val) {\n          $(form).find('span.' + prefix + '_error').text(val[0]);\n        });\n      } else {\n        $('#ramps-all').DataTable().ajax.reload(null, false);\n        $('.createRamp').modal('hide');\n        $('.createRamp').find('form')[0].reset();\n        Swal.fire(data.msg);\n      }\n    }\n  });\n}); //Delete ramp\n\n$(document).on('click', '#deleteRampBtn', function () {\n  var ramp_id = $(this).data('id');\n  var url = rampDeleteUrl;\n  Swal.fire({\n    title: 'Czy na pewno chcesz ususnąć rampę z bazy danych?',\n    showDenyButton: true,\n    confirmButtonText: 'Tak, usuń',\n    denyButtonText: \"Anuluj\",\n    allowOutsideClick: false\n  }).then(function (result) {\n    if (result.value) {\n      $.post(url, {\n        ramp_id: ramp_id\n      }, function (data) {\n        if (data.code == 1) {\n          $('#ramps-all').DataTable().ajax.reload(null, false);\n          Swal.fire(data.msg);\n        } else {\n          Swal.fire(data.msg);\n        }\n      }, 'json');\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcmFtcC5qcz9mMzRkIl0sIm5hbWVzIjpbIiQiLCJEYXRhVGFibGUiLCJwcm9jZXNzaW5nIiwiaW5mbyIsImFqYXgiLCJyYW1wQWxsVXJsIiwiY29sdW1ucyIsImRhdGEiLCJuYW1lIiwib24iLCJlIiwicHJldmVudERlZmF1bHQiLCJmb3JtIiwidXJsIiwiYXR0ciIsIm1ldGhvZCIsIkZvcm1EYXRhIiwicHJvY2Vzc0RhdGEiLCJkYXRhVHlwZSIsImNvbnRlbnRUeXBlIiwiYmVmb3JlU2VuZCIsImZpbmQiLCJ0ZXh0Iiwic3VjY2VzcyIsImNvZGUiLCJlYWNoIiwiZXJyb3IiLCJwcmVmaXgiLCJ2YWwiLCJyZWxvYWQiLCJtb2RhbCIsInJlc2V0IiwiU3dhbCIsImZpcmUiLCJtc2ciLCJkb2N1bWVudCIsInJhbXBfaWQiLCJyYW1wRGVsZXRlVXJsIiwidGl0bGUiLCJzaG93RGVueUJ1dHRvbiIsImNvbmZpcm1CdXR0b25UZXh0IiwiZGVueUJ1dHRvblRleHQiLCJhbGxvd091dHNpZGVDbGljayIsInRoZW4iLCJyZXN1bHQiLCJ2YWx1ZSIsInBvc3QiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0FBLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JDLFNBQWhCLENBQTBCO0FBQ3RCQyxFQUFBQSxVQUFVLEVBQUMsSUFEVztBQUV0QkMsRUFBQUEsSUFBSSxFQUFDLElBRmlCO0FBR3RCQyxFQUFBQSxJQUFJLEVBQUVDLFVBSGdCO0FBSXRCQyxFQUFBQSxPQUFPLEVBQUMsQ0FDSjtBQUFDQyxJQUFBQSxJQUFJLEVBQUMsYUFBTjtBQUFxQkMsSUFBQUEsSUFBSSxFQUFDO0FBQTFCLEdBREksRUFFSjtBQUFDRCxJQUFBQSxJQUFJLEVBQUMsTUFBTjtBQUFjQyxJQUFBQSxJQUFJLEVBQUM7QUFBbkIsR0FGSSxFQUdKO0FBQUNELElBQUFBLElBQUksRUFBQyxRQUFOO0FBQWdCQyxJQUFBQSxJQUFJLEVBQUM7QUFBckIsR0FISSxF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LEdBQVAsRUFBVztBQUFDdUIsUUFBQUEsT0FBTyxFQUFDQTtBQUFULE9BQVgsRUFBOEIsVUFBUzdCLElBQVQsRUFBYztBQUN4QyxZQUFHQSxJQUFJLENBQUNpQixJQUFMLElBQWEsQ0FBaEIsRUFBa0I7QUFDZHhCLFVBQUFBLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JDLFNBQWhCLEdBQTRCRyxJQUE1QixDQUFpQ3lCLE1BQWpDLENBQXdDLElBQXhDLEVBQThDLEtBQTlDO0FBQ0FHLFVBQUFBLElBQUksQ0FBQ0MsSUFBTCxDQUFVMUIsSUFBSSxDQUFDMkIsR0FBZjtBQUNILFNBSEQsTUFHSztBQUNERixVQUFBQSxJQUFJLENBQUNDLElBQUwsQ0FBVTFCLElBQUksQ0FBQzJCLEdBQWY7QUFDSDtBQUNKLE9BUEQsRUFPRSxNQVBGO0FBUUg7QUFDSixHQWpCRDtBQWtCSCxDQXJCRCIsInNvdXJjZXNDb250ZW50IjpbIi8vR2V0IGFsbCByYW1wc1xuJCgnI3JhbXBzLWFsbCcpLkRhdGFUYWJsZSh7XG4gICAgcHJvY2Vzc2luZzp0cnVlLFxuICAgIGluZm86dHJ1ZSxcbiAgICBhamF4OiByYW1wQWxsVXJsLFxuICAgIGNvbHVtbnM6W1xuICAgICAgICB7ZGF0YTonRFRfUm93SW5kZXgnLCBuYW1lOidEVF9Sb3dJbmRleCd9LFxuICAgICAgICB7ZGF0YTonbmFtZScsIG5hbWU6J25hbWUnfSxcbiAgICAgICAge2RhdGE6J3N0YXR1cycsIG5hbWU6J3N0YXR1cyd9LFxuICAgICAgICB7ZGF0YToncG93ZXInLCBuYW1lOidwb3dlcid9LFxuICAgICAgICB7ZGF0YTonYWN0aW9ucycsIG5hbWU6J2FjdGlvbnMnfSxcbiAgICBdXG59KTtcbi8vQ3JlYXRlIG5ldyByYW1wXG4kKCcjY3JlYXRlLXJhbXAtZm9ybScpLm9uKCdzdWJtaXQnLCBmdW5jdGlvbiAoZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpXG4gICAgdmFyIGZvcm0gPSB0aGlzO1xuICAgICQuYWpheCh7XG4gICAgICAgIHVybDokKGZvcm0pLmF0dHIoJ2FjdGlvbicpLFxuICAgICAgICBtZXRob2Q6JChmb3JtKS5hdHRyKCdtZXRob2QnKSxcbiAgICAgICAgZGF0YTpuZXcgRm9ybURhdGEoZm9ybSksXG4gICAgICAgIHByb2Nlc3NEYXRhOmZhbHNlLFxuICAgICAgICBkYXRhVHlwZTonanNvbicsXG4gICAgICAgIGNvbnRlbnRUeXBlOmZhbHNlLFxuICAgICAgICBiZWZvcmVTZW5kOmZ1bmN0aW9uICgpe1xuICAgICAgICAgICAgJChmb3JtKS5maW5kKCdzcGFuLmVycm9yLXRleHQnKS50ZXh0KCcnKVxuICAgICAgICB9LFxuICAgICAgICBzdWNjZXNzOmZ1bmN0aW9uIChkYXRhKXtcbiAgICAgICAgICAgIGlmKGRhdGEuY29kZSA9PSAwKXtcbiAgICAgICAgICAgICAgICAkLmVhY2goZGF0YS5lcnJvciwgZnVuY3Rpb24gKHByZWZpeCwgdmFsKXtcbiAgICAgICAgICAgICAgICAgICAgJChmb3JtKS5maW5kKCdzcGFuLicrcHJlZml4KydfZXJyb3InKS50ZXh0KHZhbFswXSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9ZWxzZXtcbiAgICAgICAgICAgICAgICAkKCcjcmFtcHMtYWxsJykuRGF0YVRhYmxlKCkuYWpheC5yZWxvYWQobnVsbCxmYWxzZSk7XG4gICAgICAgICAgICAgICAgJCgnLmNyZWF0ZVJhbXAnKS5tb2RhbCgnaGlkZScpO1xuICAgICAgICAgICAgICAgICQoJy5jcmVhdGVSYW1wJykuZmluZCgnZm9ybScpWzBdLnJlc2V0KCk7XG4gICAgICAgICAgICAgICAgU3dhbC5maXJlKGRhdGEubXNnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH0pO1xufSk7XG4vL0RlbGV0ZSByYW1wXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCcjZGVsZXRlUmFtcEJ0bicsIGZ1bmN0aW9uICgpe1xuICAgIHZhciByYW1wX2lkID0gJCh0aGlzKS5kYXRhKCdpZCcpO1xuICAgIHZhciB1cmwgPSByYW1wRGVsZXRlVXJsO1xuICAgIFN3YWwuZmlyZSh7XG4gICAgICAgIHRpdGxlOiAnQ3p5IG5hIHBld25vIGNoY2VzeiB1c3VzbsSFxIcgcmFtcMSZIHogYmF6eSBkYW55Y2g/JyxcbiAgICAgICAgc2hvd0RlbnlCdXR0b246IHRydWUsXG4gICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiAnVGFrLCB1c3XFhCcsXG4gICAgICAgIGRlbnlCdXR0b25UZXh0OiBgQW51bHVqYCxcbiAgICAgICAgYWxsb3dPdXRzaWRlQ2xpY2s6ZmFsc2UsXG4gICAgfSkudGhlbihmdW5jdGlvbiAocmVzdWx0KXtcbiAgICAgICAgaWYocmVzdWx0LnZhbHVlKXtcbiAgICAgICAgICAgICQucG9zdCh1cmwse3JhbXBfaWQ6cmFtcF9pZH0sIGZ1bmN0aW9uKGRhdGEpe1xuICAgICAgICAgICAgICAgIGlmKGRhdGEuY29kZSA9PSAxKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnI3JhbXBzLWFsbCcpLkRhdGFUYWJsZSgpLmFqYXgucmVsb2FkKG51bGwsIGZhbHNlKTtcbiAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKGRhdGEubXNnKTtcbiAgICAgICAgICAgICAgICB9ZWxzZXtcbiAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKGRhdGEubXNnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LCdqc29uJyk7XG4gICAgICAgIH1cbiAgICB9KTtcbn0pO1xuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9yYW1wLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/ramp.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/ramp.js"]();
/******/ 	
/******/ })()
;