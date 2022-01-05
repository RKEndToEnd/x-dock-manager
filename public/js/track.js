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

/***/ "./resources/js/track.js":
/*!*******************************!*\
  !*** ./resources/js/track.js ***!
  \*******************************/
/***/ (() => {

eval("//Get all tracks\n$('#tracks-all').DataTable({\n  processing: true,\n  info: true,\n  ajax: trackAllUrl,\n  columns: [{\n    data: 'id',\n    name: 'id'\n  }, {\n    data: 'vehicle_id',\n    name: 'vehicle_id'\n  }, {\n    data: 'track_id',\n    name: 'track_id'\n  }, {\n    data: 'track_type',\n    name: 'track_type'\n  }, {\n    data: 'freight',\n    name: 'freight'\n  }, {\n    data: 'eta',\n    name: 'eta'\n  }, {\n    data: 'docking_plan',\n    name: 'docking_plan'\n  }, {\n    data: 'docked_at',\n    name: 'docked_at'\n  }, {\n    data: 'ramp',\n    name: 'ramp'\n  }, {\n    data: 'worker_id',\n    name: 'worker_id'\n  }, {\n    data: 'task_start',\n    name: 'task_start'\n  }, {\n    data: 'task_end_exp',\n    name: 'task_end_exp'\n  }, {\n    data: 'doc_return_exp',\n    name: 'doc_return_exp'\n  }, {\n    data: 'task_end',\n    name: 'task_end'\n  }, {\n    data: 'doc_ready',\n    name: 'doc_ready'\n  }, {\n    data: 'comment',\n    name: 'comment'\n  }, {\n    data: 'actions',\n    name: 'actions'\n  }]\n}); //Create new track\n\n$('#create-track-form').on('submit', function (e) {\n  e.preventDefault();\n  var form = this;\n  $.ajax({\n    url: $(form).attr('action'),\n    method: $(form).attr('method'),\n    data: new FormData(form),\n    processData: false,\n    dataType: 'json',\n    contentType: false,\n    beforeSend: function beforeSend() {\n      $(form).find('span.error-text').text('');\n    },\n    success: function success(data) {\n      if (data.code == 0) {\n        $.each(data.error, function (prefix, val) {\n          $(form).find('span.' + prefix + '_error').text(val[0]);\n        });\n      } else {\n        $('#tracks-all').DataTable().ajax.reload(null, false);\n        $('.createTrack').modal('hide');\n        $('.createTrack').find('form')[0].reset();\n        Swal.fire(data.msg);\n      }\n    }\n  });\n}); //Edit track - get details\n\n$(document).on('click', '#editTrackBtn', function () {\n  var track_id = $(this).data('id');\n  $('.editTrack').find('form')[0].reset();\n  $('.editTrack').find('span.error-text').text('');\n  $.post(trackGetUrl, {\n    track_id: track_id\n  }, function (data) {\n    $('.editTrack').find('input[name=\"cid_track\"]').val(data.details.id);\n    $('.editTrack').find('input[name=\"vehicle_id\"]').val(data.details.vehicle_id);\n    $('.editTrack').find('input[name=\"track_id\"]').val(data.details.track_id);\n    $('.editTrack').find('input[name=\"track_type\"]').val(data.details.track_type);\n    $('.editTrack').find('input[name=\"freight\"]').val(data.details.freight);\n    $('.editTrack').find('input[name=\"eta\"]').val(data.details.eta);\n    $('.editTrack').modal('show');\n  }, 'json');\n}); //Update depot details\n\n$('#update-track-form').on('submit', function (e) {\n  e.preventDefault();\n  var form = this;\n  $.ajax({\n    url: $(form).attr('action'),\n    method: $(form).attr('method'),\n    data: new FormData(form),\n    processData: false,\n    dataType: 'json',\n    contentType: false,\n    beforeSend: function beforeSend() {\n      $(form).find('span.error-text').text('');\n    },\n    success: function success(data) {\n      if (data.code == 0) {\n        $.each(data.error, function (prefix, val) {\n          $(form).find('span.' + prefix + '_error').text(val[0]);\n        });\n      } else {\n        $('#tracks-all').DataTable().ajax.reload(null, false);\n        $('.editTrack').modal('hide');\n        $('.editTrack').find('form')[0].reset();\n        Swal.fire(data.msg);\n      }\n    }\n  });\n}); //Delete track\n\n$(document).on('click', '#deleteTrackBtn', function () {\n  var track_id = $(this).data('id');\n  var url = trackDeleteUrl;\n  Swal.fire({\n    title: 'Czy na pewno chcesz ususnąć trasę z bazy danych?',\n    showDenyButton: true,\n    confirmButtonText: 'Tak, usuń',\n    denyButtonText: \"Anuluj\",\n    allowOutsideClick: false\n  }).then(function (result) {\n    if (result.value) {\n      $.post(url, {\n        track_id: track_id\n      }, function (data) {\n        if (data.code == 1) {\n          $('#tracks-all').DataTable().ajax.reload(null, false);\n          Swal.fire(data.msg);\n        } else {\n          Swal.fire(data.msg);\n        }\n      }, 'json');\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvdHJhY2suanM/MTgwZiJdLCJuYW1lcyI6WyIkIiwiRGF0YVRhYmxlIiwicHJvY2Vzc2luZyIsImluZm8iLCJhamF4IiwidHJhY2tBbGxVcmwiLCJjb2x1bW5zIiwiZGF0YSIsIm5hbWUiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImZvcm0iLCJ1cmwiLCJhdHRyIiwibWV0aG9kIiwiRm9ybURhdGEiLCJwcm9jZXNzRGF0YSIsImRhdGFUeXBlIiwiY29udGVudFR5cGUiLCJiZWZvcmVTZW5kIiwiZmluZCIsInRleHQiLCJzdWNjZXNzIiwiY29kZSIsImVhY2giLCJlcnJvciIsInByZWZpeCIsInZhbCIsInJlbG9hZCIsIm1vZGFsIiwicmVzZXQiLCJTd2FsIiwiZmlyZSIsIm1zZyIsImRvY3VtZW50IiwidHJhY2tfaWQiLCJwb3N0IiwidHJhY2tHZXRVcmwiLCJkZXRhaWxzIiwiaWQiLCJ2ZWhpY2xlX2lkIiwidHJhY2tfdHlwZSIsImZyZWlnaHQiLCJldGEiLCJ0cmFja0RlbGV0ZVVybCIsInRpdGxlIiwic2hvd0RlbnlCdXR0b24iLCJjb25maXJtQnV0dG9uVGV4dCIsImRlbnlCdXR0b25UZXh0IiwiYWxsb3dPdXRzaWRlQ2xpY2siLCJ0aGVuIiwicmVzdWx0IiwidmFsdWUiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0FBLENBQUMsQ0FBQyxhQUFELENBQUQsQ0FBaUJDLFNBQWpCLENBQTJCO0FBQ3hCQyxFQUFBQSxVQUFVLEVBQUMsSUFEYTtBQUV4QkMsRUFBQUEsSUFBSSxFQUFDLElBRm1CO0FBR3hCQyxFQUFBQSxJQUFJLEVBQUVDLFdBSGtCO0FBSXhCQyxFQUFBQSxPQUFPLEVBQUMsQ0FDSjtBQUFDQyxJQUFBQSxJQUFJLEVBQUMsSUFBTjtBQUFZQyxJQUFBQSxJQUFJLEVBQUM7QUFBakIsR0FESSxFQUVKO0FBQUNELElBQUFBLElBQUksRUFBQyxZQUFOO0FBQW9CQyxJQUFBQSxJQUFJLEVBQUM7QUFB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QVBGO0FBUUg7QUFDSixHQWpCRDtBQWtCSCxDQXJCRCIsInNvdXJjZXNDb250ZW50IjpbIi8vR2V0IGFsbCB0cmFja3NcbiQoJyN0cmFja3MtYWxsJykuRGF0YVRhYmxlKHtcbiAgIHByb2Nlc3Npbmc6dHJ1ZSxcbiAgIGluZm86dHJ1ZSxcbiAgIGFqYXg6IHRyYWNrQWxsVXJsLFxuICAgY29sdW1uczpbXG4gICAgICAge2RhdGE6J2lkJywgbmFtZTonaWQnfSxcbiAgICAgICB7ZGF0YTondmVoaWNsZV9pZCcsIG5hbWU6J3ZlaGljbGVfaWQnfSxcbiAgICAgICB7ZGF0YTondHJhY2tfaWQnLCBuYW1lOid0cmFja19pZCd9LFxuICAgICAgIHtkYXRhOid0cmFja190eXBlJywgbmFtZTondHJhY2tfdHlwZSd9LFxuICAgICAgIHtkYXRhOidmcmVpZ2h0JywgbmFtZTonZnJlaWdodCd9LFxuICAgICAgIHtkYXRhOidldGEnLCBuYW1lOidldGEnfSxcbiAgICAgICB7ZGF0YTonZG9ja2luZ19wbGFuJywgbmFtZTonZG9ja2luZ19wbGFuJ30sXG4gICAgICAge2RhdGE6J2RvY2tlZF9hdCcsIG5hbWU6J2RvY2tlZF9hdCd9LFxuICAgICAgIHtkYXRhOidyYW1wJywgbmFtZToncmFtcCd9LFxuICAgICAgIHtkYXRhOid3b3JrZXJfaWQnLCBuYW1lOid3b3JrZXJfaWQnfSxcbiAgICAgICB7ZGF0YTondGFza19zdGFydCcsIG5hbWU6J3Rhc2tfc3RhcnQnfSxcbiAgICAgICB7ZGF0YTondGFza19lbmRfZXhwJywgbmFtZTondGFza19lbmRfZXhwJ30sXG4gICAgICAge2RhdGE6J2RvY19yZXR1cm5fZXhwJywgbmFtZTonZG9jX3JldHVybl9leHAnfSxcbiAgICAgICB7ZGF0YTondGFza19lbmQnLCBuYW1lOid0YXNrX2VuZCd9LFxuICAgICAgIHtkYXRhOidkb2NfcmVhZHknLCBuYW1lOidkb2NfcmVhZHknfSxcbiAgICAgICB7ZGF0YTonY29tbWVudCcsIG5hbWU6J2NvbW1lbnQnfSxcbiAgICAgICB7ZGF0YTonYWN0aW9ucycsbmFtZTonYWN0aW9ucyd9LFxuICAgXVxufSk7XG4vL0NyZWF0ZSBuZXcgdHJhY2tcbiQoJyNjcmVhdGUtdHJhY2stZm9ybScpLm9uKCdzdWJtaXQnLCBmdW5jdGlvbiAoZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpXG4gICAgdmFyIGZvcm0gPSB0aGlzO1xuICAgICQuYWpheCh7XG4gICAgICAgIHVybDokKGZvcm0pLmF0dHIoJ2FjdGlvbicpLFxuICAgICAgICBtZXRob2Q6JChmb3JtKS5hdHRyKCdtZXRob2QnKSxcbiAgICAgICAgZGF0YTpuZXcgRm9ybURhdGEoZm9ybSksXG4gICAgICAgIHByb2Nlc3NEYXRhOmZhbHNlLFxuICAgICAgICBkYXRhVHlwZTonanNvbicsXG4gICAgICAgIGNvbnRlbnRUeXBlOmZhbHNlLFxuICAgICAgICBiZWZvcmVTZW5kOmZ1bmN0aW9uICgpe1xuICAgICAgICAgICAgJChmb3JtKS5maW5kKCdzcGFuLmVycm9yLXRleHQnKS50ZXh0KCcnKVxuICAgICAgICB9LFxuICAgICAgICBzdWNjZXNzOmZ1bmN0aW9uIChkYXRhKXtcbiAgICAgICAgICAgIGlmKGRhdGEuY29kZSA9PSAwKXtcbiAgICAgICAgICAgICAgICAkLmVhY2goZGF0YS5lcnJvciwgZnVuY3Rpb24gKHByZWZpeCwgdmFsKXtcbiAgICAgICAgICAgICAgICAgICAgJChmb3JtKS5maW5kKCdzcGFuLicrcHJlZml4KydfZXJyb3InKS50ZXh0KHZhbFswXSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9ZWxzZXtcbiAgICAgICAgICAgICAgICAkKCcjdHJhY2tzLWFsbCcpLkRhdGFUYWJsZSgpLmFqYXgucmVsb2FkKG51bGwsZmFsc2UpO1xuICAgICAgICAgICAgICAgICQoJy5jcmVhdGVUcmFjaycpLm1vZGFsKCdoaWRlJyk7XG4gICAgICAgICAgICAgICAgJCgnLmNyZWF0ZVRyYWNrJykuZmluZCgnZm9ybScpWzBdLnJlc2V0KCk7XG4gICAgICAgICAgICAgICAgU3dhbC5maXJlKGRhdGEubXNnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH0pO1xufSk7XG4vL0VkaXQgdHJhY2sgLSBnZXQgZGV0YWlsc1xuJChkb2N1bWVudCkub24oJ2NsaWNrJywgJyNlZGl0VHJhY2tCdG4nLCBmdW5jdGlvbiAoKXtcbiAgICB2YXIgdHJhY2tfaWQgPSAkKHRoaXMpLmRhdGEoJ2lkJyk7XG4gICAgJCgnLmVkaXRUcmFjaycpLmZpbmQoJ2Zvcm0nKVswXS5yZXNldCgpO1xuICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdzcGFuLmVycm9yLXRleHQnKS50ZXh0KCcnKTtcbiAgICAkLnBvc3QodHJhY2tHZXRVcmwse3RyYWNrX2lkOnRyYWNrX2lkfSwgZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdpbnB1dFtuYW1lPVwiY2lkX3RyYWNrXCJdJykudmFsKGRhdGEuZGV0YWlscy5pZCk7XG4gICAgICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdpbnB1dFtuYW1lPVwidmVoaWNsZV9pZFwiXScpLnZhbChkYXRhLmRldGFpbHMudmVoaWNsZV9pZCk7XG4gICAgICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdpbnB1dFtuYW1lPVwidHJhY2tfaWRcIl0nKS52YWwoZGF0YS5kZXRhaWxzLnRyYWNrX2lkKTtcbiAgICAgICAgJCgnLmVkaXRUcmFjaycpLmZpbmQoJ2lucHV0W25hbWU9XCJ0cmFja190eXBlXCJdJykudmFsKGRhdGEuZGV0YWlscy50cmFja190eXBlKTtcbiAgICAgICAgJCgnLmVkaXRUcmFjaycpLmZpbmQoJ2lucHV0W25hbWU9XCJmcmVpZ2h0XCJdJykudmFsKGRhdGEuZGV0YWlscy5mcmVpZ2h0KTtcbiAgICAgICAgJCgnLmVkaXRUcmFjaycpLmZpbmQoJ2lucHV0W25hbWU9XCJldGFcIl0nKS52YWwoZGF0YS5kZXRhaWxzLmV0YSk7XG4gICAgICAgICQoJy5lZGl0VHJhY2snKS5tb2RhbCgnc2hvdycpO1xuICAgIH0sJ2pzb24nKTtcbn0pO1xuLy9VcGRhdGUgZGVwb3QgZGV0YWlsc1xuJCgnI3VwZGF0ZS10cmFjay1mb3JtJykub24oJ3N1Ym1pdCcsIGZ1bmN0aW9uIChlKXtcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgdmFyIGZvcm0gPSB0aGlzO1xuICAgICQuYWpheCh7XG4gICAgICAgIHVybDokKGZvcm0pLmF0dHIoJ2FjdGlvbicpLFxuICAgICAgICBtZXRob2Q6JChmb3JtKS5hdHRyKCdtZXRob2QnKSxcbiAgICAgICAgZGF0YTpuZXcgRm9ybURhdGEoZm9ybSksXG4gICAgICAgIHByb2Nlc3NEYXRhOmZhbHNlLFxuICAgICAgICBkYXRhVHlwZTonanNvbicsXG4gICAgICAgIGNvbnRlbnRUeXBlOmZhbHNlLFxuICAgICAgICBiZWZvcmVTZW5kOiBmdW5jdGlvbiAoKXtcbiAgICAgICAgICAgICQoZm9ybSkuZmluZCgnc3Bhbi5lcnJvci10ZXh0JykudGV4dCgnJyk7XG4gICAgICAgIH0sXG4gICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIChkYXRhKXtcbiAgICAgICAgICAgIGlmIChkYXRhLmNvZGUgPT0gMCl7XG4gICAgICAgICAgICAgICAgJC5lYWNoKGRhdGEuZXJyb3IsIGZ1bmN0aW9uIChwcmVmaXgsIHZhbCl7XG4gICAgICAgICAgICAgICAgICAgICQoZm9ybSkuZmluZCgnc3Bhbi4nK3ByZWZpeCsnX2Vycm9yJykudGV4dCh2YWxbMF0pO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfWVsc2V7XG4gICAgICAgICAgICAgICAgJCgnI3RyYWNrcy1hbGwnKS5EYXRhVGFibGUoKS5hamF4LnJlbG9hZChudWxsLGZhbHNlKTtcbiAgICAgICAgICAgICAgICAkKCcuZWRpdFRyYWNrJykubW9kYWwoJ2hpZGUnKTtcbiAgICAgICAgICAgICAgICAkKCcuZWRpdFRyYWNrJykuZmluZCgnZm9ybScpWzBdLnJlc2V0KCk7XG4gICAgICAgICAgICAgICAgU3dhbC5maXJlKGRhdGEubXNnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH0pXG59KTtcbi8vRGVsZXRlIHRyYWNrXG4kKGRvY3VtZW50KS5vbignY2xpY2snLCcjZGVsZXRlVHJhY2tCdG4nLCBmdW5jdGlvbiAoKXtcbiAgICB2YXIgdHJhY2tfaWQgPSAkKHRoaXMpLmRhdGEoJ2lkJyk7XG4gICAgdmFyIHVybCA9IHRyYWNrRGVsZXRlVXJsO1xuICAgIFN3YWwuZmlyZSh7XG4gICAgICAgIHRpdGxlOiAnQ3p5IG5hIHBld25vIGNoY2VzeiB1c3VzbsSFxIcgdHJhc8SZIHogYmF6eSBkYW55Y2g/JyxcbiAgICAgICAgc2hvd0RlbnlCdXR0b246IHRydWUsXG4gICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiAnVGFrLCB1c3XFhCcsXG4gICAgICAgIGRlbnlCdXR0b25UZXh0OiBgQW51bHVqYCxcbiAgICAgICAgYWxsb3dPdXRzaWRlQ2xpY2s6ZmFsc2UsXG4gICAgfSkudGhlbihmdW5jdGlvbiAocmVzdWx0KXtcbiAgICAgICAgaWYocmVzdWx0LnZhbHVlKXtcbiAgICAgICAgICAgICQucG9zdCh1cmwse3RyYWNrX2lkOnRyYWNrX2lkfSwgZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICAgICAgICAgaWYoZGF0YS5jb2RlID09IDEpe1xuICAgICAgICAgICAgICAgICAgICAkKCcjdHJhY2tzLWFsbCcpLkRhdGFUYWJsZSgpLmFqYXgucmVsb2FkKG51bGwsIGZhbHNlKTtcbiAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKGRhdGEubXNnKTtcbiAgICAgICAgICAgICAgICB9ZWxzZXtcbiAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKGRhdGEubXNnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LCdqc29uJyk7XG4gICAgICAgIH1cbiAgICB9KTtcbn0pO1xuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy90cmFjay5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/track.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/track.js"]();
/******/ 	
/******/ })()
;