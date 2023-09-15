(function ($) {
	'use strict';
	var startRow = 1;
	var statusBarWrapper = $('.statusBar-wrapper');
	var statusBar = $('.statusBar');
	var sim_importer_form = $('#sim-importer-form');
	var api_sim_importer_form = $('#api-sim-importer-form');
	var sim_super_data_importer_form = $('#sim-super-data-importer-form');
	var sim_sold_out_importer_form = $('#sim-sold-out-importer-form');
	var package_importer_form = $('#package-importer-form');
	var import_results = $('#import-results');
	var batchSize = 100;
	var history = 0;
	var task = 'price_sync';
	var api_page = 1;
	var count = 0;

	// Lấy ID sản phẩm
	$('#get-ids-form').submit(function (e) {
		e.preventDefault();
		get_ids_form();
		return false;
	});

	function get_ids_form() {
		$.ajax({
			type: "post",
			dataType: "json",
			url: _n_framework_admin.admin_ajax_url,
			data: {
				action: "get_product_ids",
			},
			beforeSend: function () {

			},
			success: function (response) {
				var is_finished = response.data.is_finished;
				if (!is_finished) {
					$('#get-ids-form').submit();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
		return false;
	}

	// Nhập sim từ file excel
	sim_importer_form.submit(function (e) {
		e.preventDefault();
		var fileInput = $('#file');
		var formData = new FormData($(this)[0]);

		formData.append('action', 'sim_importer');
		formData.append('start_row', startRow);
		formData.append('history', history);

		if (fileInput[0].files.length === 0) {
			alert('Vui lòng chọn tệp Excel để import');
		} else {
			sim_importer(formData);
		}

		return false;
	});

	function sim_importer(formData) {
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				statusBarWrapper.show();
			},
			success: function (response) {
				console.log(response);
				var status = response.data.status;
				var end_row = response.data.end_row;
				history = response.data.history;
				import_results.html('Đã nhập được ' + end_row + ' sim');

				if (status === "continue") {
					startRow += batchSize;
					sim_importer_form.submit();
				} else {
					import_results.html('Đã hoàn thành!');
					statusBar.addClass('done');
					statusBarWrapper.hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				statusBarWrapper.hide();
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});

		return false;
	}

	// Nhập sim từ API
	api_sim_importer_form.submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'api_import_sim');
		formData.append('page', api_page);
		formData.append('task', task);
		formData.append('count', count);
		api_sim_importer(formData);
		return false;
	});

	function api_sim_importer(formData) {
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				statusBarWrapper.show();
			},
			success: function (response) {
				console.log(response);
				var status = response.data.status;
				if (status === "continue") {
					api_page = response.data.page + 1;
					task = response.data.task;
					count = response.data.count;
					import_results.html('Đã nhập được ' + count + ' sim');
					api_sim_importer_form.submit();
				} else {
					import_results.html('Đã hoàn thành: Tổng cộng đã import được ' + count + ' sim');
					statusBar.addClass('done');
					statusBarWrapper.hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				statusBarWrapper.hide();
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
		return false;
	}

	// Sim super data
	sim_super_data_importer_form.submit(function (e) {
		e.preventDefault();
		var fileInput = $('#file');
		var formData = new FormData($(this)[0]);

		formData.append('action', 'sim_super_data_importer');
		formData.append('start_row', startRow);
		formData.append('history', history);

		if (fileInput[0].files.length === 0) {
			alert('Vui lòng chọn tệp Excel để import');
		} else {
			sim_super_data_importer(formData);
		}

		return false;
	});

	function sim_super_data_importer(formData) {
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				statusBarWrapper.show();
			},
			success: function (response) {
				console.log(response);
				var status = response.data.status;
				var end_row = response.data.end_row;
				history = response.data.history;
				import_results.html('Đã nhập được ' + end_row + ' sim');

				if (status === "continue") {
					startRow += batchSize;
					sim_super_data_importer_form.submit();
				} else {
					import_results.html('Đã hoàn thành!');
					statusBar.addClass('done');
					statusBarWrapper.hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				statusBarWrapper.hide();
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
	}

	// Sim đã bán
	sim_sold_out_importer_form.submit(function (e) {
		e.preventDefault();
		var fileInput = $('#file');
		var formData = new FormData($(this)[0]);

		formData.append('action', 'sim_sold_out_importer');
		formData.append('start_row', startRow);

		if (fileInput[0].files.length === 0) {
			alert('Vui lòng chọn tệp Excel để import');
		} else {
			sim_sold_out_importer(formData);
		}

		return false;
	});

	function sim_sold_out_importer(formData) {
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				statusBarWrapper.show();
			},
			success: function (response) {
				var status = response.data.status;
				var end_row = response.data.end_row;
				import_results.html('Đã xoá ' + end_row + ' sim...');

				if (status === "continue") {
					startRow += batchSize;
					sim_sold_out_importer_form.submit();
				} else {
					import_results.html('Đã hoàn thành!');
					statusBar.addClass('done');
					statusBarWrapper.hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				statusBarWrapper.hide();
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
	}

	// Nhập gói cước
	package_importer_form.submit(function (e) {
		e.preventDefault();
		var fileInput = $('#file');
		var formData = new FormData($(this)[0]);
		formData.append('action', 'package_importer');
		formData.append('start_row', startRow);
		formData.append('history', history);

		if (fileInput[0].files.length === 0) {
			import_results.html('Vui lòng chọn tệp Excel để import.');
		} else {
			package_importer(formData);
		}
		return false;
	});

	function package_importer(formData) {
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				statusBarWrapper.show();
			},
			success: function (response) {
				console.log(response);
				var status = response.data.status;
				var end_row = response.data.end_row;
				history = response.data.history;
				import_results.html('Đã nhập được ' + end_row + ' sim');
				if (status === "continue") {
					startRow += batchSize;
					package_importer_form.submit();
				} else {
					import_results.html('Đã hoàn thành!');
					statusBar.addClass('done');
					statusBarWrapper.hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				statusBarWrapper.hide();
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
	}

	// Xoá sản phẩm
	$('.delete-product-by-history').on('click', function (e) {
		e.preventDefault();
		var history_id = $(this).attr('data-history');

		$.ajax({
			type: "post",
			dataType: "json",
			url: _n_framework_admin.admin_ajax_url,
			data: {
				action: "delete_product_by_history",
				history: history_id,
			},
			beforeSend: function () {

			},
			success: function (response) {
				var alert = confirm(response.data);
				if (alert === true) {
					window.location.reload();
				} else {
					window.location.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
		return false;
	});

	// Báo cáo sim
	$('#sim-report-form').submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'sim_report');
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
			},
			success: function (response) {
				if (response.success) {
					$('#sim-report-table-wrapper').html(response.data);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
		return false;
	});

	// Báo cáo sim siêu data
	$('#sim-super-data-report-form').submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'sim_super_data_report');
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework_admin.admin_ajax_url,
			data: formData,
			beforeSend: function () {
			},
			success: function (response) {
				if (response.success) {
					$('#sim-report-table-wrapper').html(response.data);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
			}
		});
		return false;
	});
})(jQuery);
