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

eval("//Get all tracks\n$('#tracks-all').DataTable({\n  processing: true,\n  info: true,\n  ajax: trackAllUrl,\n  columns: [{\n    data: 'checkbox',\n    name: 'checkbox',\n    orderable: false,\n    searchable: false\n  }, {\n    data: 'DT_RowIndex',\n    name: 'DT_RowIndex'\n  }, {\n    data: 'vehicle_id',\n    name: 'vehicle_id'\n  }, {\n    data: 'track_id',\n    name: 'track_id'\n  }, {\n    data: 'track_type',\n    name: 'track_type'\n  }, {\n    data: 'freight',\n    name: 'freight'\n  }, {\n    data: 'eta',\n    name: 'eta'\n  }, {\n    data: 'docking_plan',\n    name: 'docking_plan'\n  }, {\n    data: 'docked_at',\n    name: 'docked_at'\n  }, {\n    data: 'ramp',\n    name: 'ramp'\n  }, {\n    data: 'worker_id',\n    name: 'worker_id'\n  }, {\n    data: 'task_start',\n    name: 'task_start'\n  }, {\n    data: 'task_end_exp',\n    name: 'task_end_exp'\n  }, {\n    data: 'doc_return_exp',\n    name: 'doc_return_exp'\n  }, {\n    data: 'task_end',\n    name: 'task_end'\n  }, {\n    data: 'doc_ready',\n    name: 'doc_ready'\n  }, {\n    data: 'comment',\n    name: 'comment'\n  }, {\n    data: 'actions',\n    name: 'actions',\n    orderable: false,\n    searchable: false\n  }]\n}); //Create new track\n\n$('#create-track-form').on('submit', function (e) {\n  e.preventDefault();\n  var form = this;\n  $.ajax({\n    url: $(form).attr('action'),\n    method: $(form).attr('method'),\n    data: new FormData(form),\n    processData: false,\n    dataType: 'json',\n    contentType: false,\n    beforeSend: function beforeSend() {\n      $(form).find('span.error-text').text('');\n    },\n    success: function success(data) {\n      if (data.code == 0) {\n        $.each(data.error, function (prefix, val) {\n          $(form).find('span.' + prefix + '_error').text(val[0]);\n        });\n      } else {\n        $('#tracks-all').DataTable().ajax.reload(null, false);\n        $('.createTrack').modal('hide');\n        $('.createTrack').find('form')[0].reset();\n        Swal.fire(data.msg);\n      }\n    }\n  });\n}); //Edit track - get details\n\n$(document).on('click', '#editTrackBtn', function () {\n  var track_id = $(this).data('id');\n  $('.editTrack').find('form')[0].reset();\n  $('.editTrack').find('span.error-text').text('');\n  $.post(trackGetUrl, {\n    track_id: track_id\n  }, function (data) {\n    $('.editTrack').find('input[name=\"cid_track\"]').val(data.details.id);\n    $('.editTrack').find('input[name=\"vehicle_id\"]').val(data.details.vehicle_id);\n    $('.editTrack').find('input[name=\"track_id\"]').val(data.details.track_id);\n    $('.editTrack').find('input[name=\"track_type\"]').val(data.details.track_type);\n    $('.editTrack').find('input[name=\"freight\"]').val(data.details.freight);\n    $('.editTrack').find('input[name=\"eta\"]').val(data.details.eta);\n    $('.editTrack').modal('show');\n  }, 'json');\n}); //Update depot details\n\n$('#update-track-form').on('submit', function (e) {\n  e.preventDefault();\n  var form = this;\n  $.ajax({\n    url: $(form).attr('action'),\n    method: $(form).attr('method'),\n    data: new FormData(form),\n    processData: false,\n    dataType: 'json',\n    contentType: false,\n    beforeSend: function beforeSend() {\n      $(form).find('span.error-text').text('');\n    },\n    success: function success(data) {\n      if (data.code == 0) {\n        $.each(data.error, function (prefix, val) {\n          $(form).find('span.' + prefix + '_error').text(val[0]);\n        });\n      } else {\n        $('#tracks-all').DataTable().ajax.reload(null, false);\n        $('.editTrack').modal('hide');\n        $('.editTrack').find('form')[0].reset();\n        Swal.fire(data.msg);\n      }\n    }\n  });\n}); //Delete track\n\n$(document).on('click', '#deleteTrackBtn', function () {\n  var track_id = $(this).data('id');\n  var url = trackDeleteUrl;\n  Swal.fire({\n    title: 'Czy na pewno chcesz ususnąć trasę z bazy danych?',\n    showDenyButton: true,\n    confirmButtonText: 'Tak, usuń',\n    denyButtonText: \"Anuluj\",\n    allowOutsideClick: false\n  }).then(function (result) {\n    if (result.value) {\n      $.post(url, {\n        track_id: track_id\n      }, function (data) {\n        if (data.code == 1) {\n          $('#tracks-all').DataTable().ajax.reload(null, false);\n          Swal.fire(data.msg);\n        } else {\n          Swal.fire(data.msg);\n        }\n      }, 'json');\n    }\n  });\n}); //Checkbox marking\n\n$(document).on('click', 'input[name=\"tracks-checkbox\"]', function () {\n  if (this.checked) {\n    $('input[name=\"track-checkbox\"]').each(function () {\n      this.checked = true;\n    });\n  } else {\n    $('input[name=\"track-checkbox\"]').each(function () {\n      this.checked = false;\n    });\n  }\n});\n$(document).on('change', 'input[name=\"track-checkbox\"]', function () {\n  if ($('input[name=\"track-checkbox\"]').length == $('input[name=\"track-checkbox\"]:checked').length) {\n    $('input[name=\"tracks-checkbox\"]').prop('checked', true);\n  } else {\n    $('input[name=\"tracks-checkbox\"]').prop('checked', false);\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvdHJhY2suanM/MTgwZiJdLCJuYW1lcyI6WyIkIiwiRGF0YVRhYmxlIiwicHJvY2Vzc2luZyIsImluZm8iLCJhamF4IiwidHJhY2tBbGxVcmwiLCJjb2x1bW5zIiwiZGF0YSIsIm5hbWUiLCJvcmRlcmFibGUiLCJzZWFyY2hhYmxlIiwib24iLCJlIiwicHJldmVudERlZmF1bHQiLCJmb3JtIiwidXJsIiwiYXR0ciIsIm1ldGhvZCIsIkZvcm1EYXRhIiwicHJvY2Vzc0RhdGEiLCJkYXRhVHlwZSIsImNvbnRlbnRUeXBlIiwiYmVmb3JlU2VuZCIsImZpbmQiLCJ0ZXh0Iiwic3VjY2VzcyIsImNvZGUiLCJlYWNoIiwiZXJyb3IiLCJwcmVmaXgiLCJ2YWwiLCJyZWxvYWQiLCJtb2RhbCIsInJlc2V0IiwiU3dhbCIsImZpcmUiLCJtc2ciLCJkb2N1bWVudCIsInRyYWNrX2lkIiwicG9zdCIsInRyYWNrR2V0VXJsIiwiZGV0YWlscyIsImlkIiwidmVoaWNsZV9pZCIsInRyYWNrX3R5cGUiLCJmcmVpZ2h0IiwiZXRhIiwidHJhY2tEZWxldGVVcmwiLCJ0aXRsZSIsInNob3dEZW55QnV0dG9uIiwiY29uZmlybUJ1dHRvblRleHQiLCJkZW55QnV0dG9uVGV4dCIsImFsbG93T3V0c2lkZUNsaWNrIiwidGhlbiIsInJlc3VsdCIsInZhbHVlIiwiY2hlY2tlZCIsImxlbmd0aCIsInByb3AiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0FBLENBQUMsQ0FBQyxhQUFELENBQUQsQ0FBaUJDLFNBQWpCLENBQTJCO0FBQ3hCQyxFQUFBQSxVQUFVLEVBQUMsSUFEYTtBQUV4QkMsRUFBQUEsSUFBSSxFQUFDLElBRm1CO0FBR3hCQyxFQUFBQSxJQUFJLEVBQUVDLFdBSGtCO0FBSXhCQyxFQUFBQSxPQUFPLEVBQUMsQ0FDSjtBQUFDQyxJQUFBQSxJQUFJLEVBQUMsVUFBTjtBQUFrQkMsSUFBQUEsSUFBSSxFQUFDLFVBQXZCO0FBQWtDQyxJQUFB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Q0FBbUMwRCxJQUFuQyxDQUF3QyxTQUF4QyxFQUFrRCxLQUFsRDtBQUNIO0FBQ0gsQ0FORCIsInNvdXJjZXNDb250ZW50IjpbIi8vR2V0IGFsbCB0cmFja3NcbiQoJyN0cmFja3MtYWxsJykuRGF0YVRhYmxlKHtcbiAgIHByb2Nlc3Npbmc6dHJ1ZSxcbiAgIGluZm86dHJ1ZSxcbiAgIGFqYXg6IHRyYWNrQWxsVXJsLFxuICAgY29sdW1uczpbXG4gICAgICAge2RhdGE6J2NoZWNrYm94JywgbmFtZTonY2hlY2tib3gnLG9yZGVyYWJsZTpmYWxzZSwgc2VhcmNoYWJsZTpmYWxzZX0sXG4gICAgICAge2RhdGE6J0RUX1Jvd0luZGV4JywgbmFtZTonRFRfUm93SW5kZXgnfSxcbiAgICAgICB7ZGF0YTondmVoaWNsZV9pZCcsIG5hbWU6J3ZlaGljbGVfaWQnfSxcbiAgICAgICB7ZGF0YTondHJhY2tfaWQnLCBuYW1lOid0cmFja19pZCd9LFxuICAgICAgIHtkYXRhOid0cmFja190eXBlJywgbmFtZTondHJhY2tfdHlwZSd9LFxuICAgICAgIHtkYXRhOidmcmVpZ2h0JywgbmFtZTonZnJlaWdodCd9LFxuICAgICAgIHtkYXRhOidldGEnLCBuYW1lOidldGEnfSxcbiAgICAgICB7ZGF0YTonZG9ja2luZ19wbGFuJywgbmFtZTonZG9ja2luZ19wbGFuJ30sXG4gICAgICAge2RhdGE6J2RvY2tlZF9hdCcsIG5hbWU6J2RvY2tlZF9hdCd9LFxuICAgICAgIHtkYXRhOidyYW1wJywgbmFtZToncmFtcCd9LFxuICAgICAgIHtkYXRhOid3b3JrZXJfaWQnLCBuYW1lOid3b3JrZXJfaWQnfSxcbiAgICAgICB7ZGF0YTondGFza19zdGFydCcsIG5hbWU6J3Rhc2tfc3RhcnQnfSxcbiAgICAgICB7ZGF0YTondGFza19lbmRfZXhwJywgbmFtZTondGFza19lbmRfZXhwJ30sXG4gICAgICAge2RhdGE6J2RvY19yZXR1cm5fZXhwJywgbmFtZTonZG9jX3JldHVybl9leHAnfSxcbiAgICAgICB7ZGF0YTondGFza19lbmQnLCBuYW1lOid0YXNrX2VuZCd9LFxuICAgICAgIHtkYXRhOidkb2NfcmVhZHknLCBuYW1lOidkb2NfcmVhZHknfSxcbiAgICAgICB7ZGF0YTonY29tbWVudCcsIG5hbWU6J2NvbW1lbnQnfSxcbiAgICAgICB7ZGF0YTonYWN0aW9ucycsbmFtZTonYWN0aW9ucycsb3JkZXJhYmxlOmZhbHNlLCBzZWFyY2hhYmxlOmZhbHNlfSxcbiAgIF1cbn0pO1xuLy9DcmVhdGUgbmV3IHRyYWNrXG4kKCcjY3JlYXRlLXRyYWNrLWZvcm0nKS5vbignc3VibWl0JywgZnVuY3Rpb24gKGUpe1xuICAgIGUucHJldmVudERlZmF1bHQoKVxuICAgIHZhciBmb3JtID0gdGhpcztcbiAgICAkLmFqYXgoe1xuICAgICAgICB1cmw6JChmb3JtKS5hdHRyKCdhY3Rpb24nKSxcbiAgICAgICAgbWV0aG9kOiQoZm9ybSkuYXR0cignbWV0aG9kJyksXG4gICAgICAgIGRhdGE6bmV3IEZvcm1EYXRhKGZvcm0pLFxuICAgICAgICBwcm9jZXNzRGF0YTpmYWxzZSxcbiAgICAgICAgZGF0YVR5cGU6J2pzb24nLFxuICAgICAgICBjb250ZW50VHlwZTpmYWxzZSxcbiAgICAgICAgYmVmb3JlU2VuZDpmdW5jdGlvbiAoKXtcbiAgICAgICAgICAgICQoZm9ybSkuZmluZCgnc3Bhbi5lcnJvci10ZXh0JykudGV4dCgnJylcbiAgICAgICAgfSxcbiAgICAgICAgc3VjY2VzczpmdW5jdGlvbiAoZGF0YSl7XG4gICAgICAgICAgICBpZihkYXRhLmNvZGUgPT0gMCl7XG4gICAgICAgICAgICAgICAgJC5lYWNoKGRhdGEuZXJyb3IsIGZ1bmN0aW9uIChwcmVmaXgsIHZhbCl7XG4gICAgICAgICAgICAgICAgICAgICQoZm9ybSkuZmluZCgnc3Bhbi4nK3ByZWZpeCsnX2Vycm9yJykudGV4dCh2YWxbMF0pO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfWVsc2V7XG4gICAgICAgICAgICAgICAgJCgnI3RyYWNrcy1hbGwnKS5EYXRhVGFibGUoKS5hamF4LnJlbG9hZChudWxsLGZhbHNlKTtcbiAgICAgICAgICAgICAgICAkKCcuY3JlYXRlVHJhY2snKS5tb2RhbCgnaGlkZScpO1xuICAgICAgICAgICAgICAgICQoJy5jcmVhdGVUcmFjaycpLmZpbmQoJ2Zvcm0nKVswXS5yZXNldCgpO1xuICAgICAgICAgICAgICAgIFN3YWwuZmlyZShkYXRhLm1zZyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9KTtcbn0pO1xuLy9FZGl0IHRyYWNrIC0gZ2V0IGRldGFpbHNcbiQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcjZWRpdFRyYWNrQnRuJywgZnVuY3Rpb24gKCl7XG4gICAgdmFyIHRyYWNrX2lkID0gJCh0aGlzKS5kYXRhKCdpZCcpO1xuICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdmb3JtJylbMF0ucmVzZXQoKTtcbiAgICAkKCcuZWRpdFRyYWNrJykuZmluZCgnc3Bhbi5lcnJvci10ZXh0JykudGV4dCgnJyk7XG4gICAgJC5wb3N0KHRyYWNrR2V0VXJsLHt0cmFja19pZDp0cmFja19pZH0sIGZ1bmN0aW9uKGRhdGEpe1xuICAgICAgICAkKCcuZWRpdFRyYWNrJykuZmluZCgnaW5wdXRbbmFtZT1cImNpZF90cmFja1wiXScpLnZhbChkYXRhLmRldGFpbHMuaWQpO1xuICAgICAgICAkKCcuZWRpdFRyYWNrJykuZmluZCgnaW5wdXRbbmFtZT1cInZlaGljbGVfaWRcIl0nKS52YWwoZGF0YS5kZXRhaWxzLnZlaGljbGVfaWQpO1xuICAgICAgICAkKCcuZWRpdFRyYWNrJykuZmluZCgnaW5wdXRbbmFtZT1cInRyYWNrX2lkXCJdJykudmFsKGRhdGEuZGV0YWlscy50cmFja19pZCk7XG4gICAgICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdpbnB1dFtuYW1lPVwidHJhY2tfdHlwZVwiXScpLnZhbChkYXRhLmRldGFpbHMudHJhY2tfdHlwZSk7XG4gICAgICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdpbnB1dFtuYW1lPVwiZnJlaWdodFwiXScpLnZhbChkYXRhLmRldGFpbHMuZnJlaWdodCk7XG4gICAgICAgICQoJy5lZGl0VHJhY2snKS5maW5kKCdpbnB1dFtuYW1lPVwiZXRhXCJdJykudmFsKGRhdGEuZGV0YWlscy5ldGEpO1xuICAgICAgICAkKCcuZWRpdFRyYWNrJykubW9kYWwoJ3Nob3cnKTtcbiAgICB9LCdqc29uJyk7XG59KTtcbi8vVXBkYXRlIGRlcG90IGRldGFpbHNcbiQoJyN1cGRhdGUtdHJhY2stZm9ybScpLm9uKCdzdWJtaXQnLCBmdW5jdGlvbiAoZSl7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIHZhciBmb3JtID0gdGhpcztcbiAgICAkLmFqYXgoe1xuICAgICAgICB1cmw6JChmb3JtKS5hdHRyKCdhY3Rpb24nKSxcbiAgICAgICAgbWV0aG9kOiQoZm9ybSkuYXR0cignbWV0aG9kJyksXG4gICAgICAgIGRhdGE6bmV3IEZvcm1EYXRhKGZvcm0pLFxuICAgICAgICBwcm9jZXNzRGF0YTpmYWxzZSxcbiAgICAgICAgZGF0YVR5cGU6J2pzb24nLFxuICAgICAgICBjb250ZW50VHlwZTpmYWxzZSxcbiAgICAgICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gKCl7XG4gICAgICAgICAgICAkKGZvcm0pLmZpbmQoJ3NwYW4uZXJyb3ItdGV4dCcpLnRleHQoJycpO1xuICAgICAgICB9LFxuICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAoZGF0YSl7XG4gICAgICAgICAgICBpZiAoZGF0YS5jb2RlID09IDApe1xuICAgICAgICAgICAgICAgICQuZWFjaChkYXRhLmVycm9yLCBmdW5jdGlvbiAocHJlZml4LCB2YWwpe1xuICAgICAgICAgICAgICAgICAgICAkKGZvcm0pLmZpbmQoJ3NwYW4uJytwcmVmaXgrJ19lcnJvcicpLnRleHQodmFsWzBdKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1lbHNle1xuICAgICAgICAgICAgICAgICQoJyN0cmFja3MtYWxsJykuRGF0YVRhYmxlKCkuYWpheC5yZWxvYWQobnVsbCxmYWxzZSk7XG4gICAgICAgICAgICAgICAgJCgnLmVkaXRUcmFjaycpLm1vZGFsKCdoaWRlJyk7XG4gICAgICAgICAgICAgICAgJCgnLmVkaXRUcmFjaycpLmZpbmQoJ2Zvcm0nKVswXS5yZXNldCgpO1xuICAgICAgICAgICAgICAgIFN3YWwuZmlyZShkYXRhLm1zZyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9KVxufSk7XG4vL0RlbGV0ZSB0cmFja1xuJChkb2N1bWVudCkub24oJ2NsaWNrJywnI2RlbGV0ZVRyYWNrQnRuJywgZnVuY3Rpb24gKCl7XG4gICAgdmFyIHRyYWNrX2lkID0gJCh0aGlzKS5kYXRhKCdpZCcpO1xuICAgIHZhciB1cmwgPSB0cmFja0RlbGV0ZVVybDtcbiAgICBTd2FsLmZpcmUoe1xuICAgICAgICB0aXRsZTogJ0N6eSBuYSBwZXdubyBjaGNlc3ogdXN1c27EhcSHIHRyYXPEmSB6IGJhenkgZGFueWNoPycsXG4gICAgICAgIHNob3dEZW55QnV0dG9uOiB0cnVlLFxuICAgICAgICBjb25maXJtQnV0dG9uVGV4dDogJ1RhaywgdXN1xYQnLFxuICAgICAgICBkZW55QnV0dG9uVGV4dDogYEFudWx1amAsXG4gICAgICAgIGFsbG93T3V0c2lkZUNsaWNrOmZhbHNlLFxuICAgIH0pLnRoZW4oZnVuY3Rpb24gKHJlc3VsdCl7XG4gICAgICAgIGlmKHJlc3VsdC52YWx1ZSl7XG4gICAgICAgICAgICAkLnBvc3QodXJsLHt0cmFja19pZDp0cmFja19pZH0sIGZ1bmN0aW9uKGRhdGEpe1xuICAgICAgICAgICAgICAgIGlmKGRhdGEuY29kZSA9PSAxKXtcbiAgICAgICAgICAgICAgICAgICAgJCgnI3RyYWNrcy1hbGwnKS5EYXRhVGFibGUoKS5hamF4LnJlbG9hZChudWxsLCBmYWxzZSk7XG4gICAgICAgICAgICAgICAgICAgIFN3YWwuZmlyZShkYXRhLm1zZyk7XG4gICAgICAgICAgICAgICAgfWVsc2V7XG4gICAgICAgICAgICAgICAgICAgIFN3YWwuZmlyZShkYXRhLm1zZyk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSwnanNvbicpO1xuICAgICAgICB9XG4gICAgfSk7XG59KTtcbi8vQ2hlY2tib3ggbWFya2luZ1xuJChkb2N1bWVudCkub24oJ2NsaWNrJywnaW5wdXRbbmFtZT1cInRyYWNrcy1jaGVja2JveFwiXScsIGZ1bmN0aW9uICgpe1xuICAgaWYgKHRoaXMuY2hlY2tlZCl7XG4gICAgICAgJCgnaW5wdXRbbmFtZT1cInRyYWNrLWNoZWNrYm94XCJdJykuZWFjaChmdW5jdGlvbiAoKXtcbiAgICAgICAgICAgdGhpcy5jaGVja2VkPXRydWU7XG4gICAgICAgfSk7XG4gICB9ZWxzZXtcbiAgICAgICAkKCdpbnB1dFtuYW1lPVwidHJhY2stY2hlY2tib3hcIl0nKS5lYWNoKGZ1bmN0aW9uICgpe1xuICAgICAgICAgICB0aGlzLmNoZWNrZWQ9ZmFsc2U7XG4gICAgICAgfSlcbiAgIH1cbn0pO1xuJChkb2N1bWVudCkub24oJ2NoYW5nZScsJ2lucHV0W25hbWU9XCJ0cmFjay1jaGVja2JveFwiXScsZnVuY3Rpb24gKCl7XG4gICBpZiAoJCgnaW5wdXRbbmFtZT1cInRyYWNrLWNoZWNrYm94XCJdJykubGVuZ3RoID09ICQoJ2lucHV0W25hbWU9XCJ0cmFjay1jaGVja2JveFwiXTpjaGVja2VkJykubGVuZ3RoKXtcbiAgICAgICAkKCdpbnB1dFtuYW1lPVwidHJhY2tzLWNoZWNrYm94XCJdJykucHJvcCgnY2hlY2tlZCcsdHJ1ZSk7XG4gICB9ZWxzZXtcbiAgICAgICAkKCdpbnB1dFtuYW1lPVwidHJhY2tzLWNoZWNrYm94XCJdJykucHJvcCgnY2hlY2tlZCcsZmFsc2UpO1xuICAgfVxufSk7XG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3RyYWNrLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/track.js\n");

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