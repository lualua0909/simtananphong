(function ($) {
	'use strict';
	var loader = $('.theme-loader-wrapper');

	// Mobile menu
	$(window).on("load resize", function () {
		if ($(window).width() < 991) {
			new Mmenu("#mobile-menu", {
				extensions: ["position-right"]
			}, {
				offCanvas: {
					clone: true
				}
			});
		}
	});

	// Back to top
	$("#back-to-top").click(function () {
		$("html, body").animate({scrollTop: 0}, 300);
	});

	// Slider
	$('.primary-slick-slider').slick({
		infinite: true,
		arrows: false,
		adaptiveHeight: true,
		autoplay: true,
		autoplaySpeed: 5000,
	});

	// Tự động tìm kiếm khi check vào dạng số
	$('.sim-format').change(function () {
		$('#sim-filter-form').submit();
	});

	// Tự động tìm kiếm khi chọn năm sinh
	$('select[name=nam]').on('change', function (e) {
		$('#sim-filter-form').submit();
	});

	// Đặt hàng
	$('#order-form').submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'sim_order');

		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				if (response.success) {
					window.location.href = response.data.url;
				} else {
					alert(response.data);
				}
				loader.hide();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});
		return false;
	});

	// Chọn gói cước
	$('label.radio-button').on('click', function () {
		var radio = $(this).find('input[type=radio]');
		var price = radio.attr('data-price');
		var cartTotalEl = $('.cart-total');
		var cartTotal = cartTotalEl.attr('data-cart-subtotal');
		var cartTotalVal;

		if (radio.is(':checked')) {
			radio.prop('checked', false);
			$('.data-package .price').html(0 + ' vnđ');
			$('input[name=product_data]').val(0);
			cartTotalVal = parseFloat(cartTotal);
			cartTotalEl.html(numberFormat(cartTotalVal) + ' vnđ');
			cartTotalEl.attr('data-cart-total', cartTotalVal);
		} else {
			radio.prop('checked', true);
			$('.data-package .price').html(numberFormat(parseFloat(price)) + ' vnđ');
			$('input[name=product_data]').val(radio.attr('data-id'));
			cartTotalVal = parseFloat(cartTotal) + parseFloat(price);
			cartTotalEl.html(numberFormat(cartTotalVal) + ' vnđ');
			cartTotalEl.attr('data-cart-total', cartTotalVal);
		}

		return false;
	});

	// Số lượng sim siêu data
	$('input[name=product_quantity]').change(function () {
		if ($(this).val() <= 1) {
			alert('Số lượng không được nhỏ hơn 1');
			$(this).val(1);
			return;
		}

		var price = $('.product-price').attr('data-price');
		var cartTotalEl = $('.cart-total');
		var cartTotal = cartTotalEl.attr('data-cart-subtotal');
		var newPrice = parseFloat(price) * parseFloat($(this).val());
		var cartTotalVal;
		cartTotalVal = parseFloat(cartTotal) + newPrice - parseFloat(price);
		cartTotalEl.html(numberFormat(cartTotalVal) + ' vnđ');
		cartTotalEl.attr('data-cart-total', cartTotalVal);
	});

	// Phương thức giao hàng
	$('input[type=radio][name=delivery-method]').on('change', function () {
		if ($(this).val() === 'delivery-method-1') {
			$('.branch-select').show();
			$('.address-input').hide();
		} else if ($(this).val() === 'delivery-method-2') {
			$('.branch-select').hide();
			$('.address-input').show();
		}
	});

	// Bản đồ
	if ($('#shipping-map').length) {
		let marker = null;

		let shipping_map = L.map('shipping-map', {
			center: [10.0310623, 465.7804871],
			zoom: 12
		});

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(shipping_map);

		$('input[type=radio][name=branch]').on('change', function () {
			var lat = $(this).attr('data-lat');
			var lng = $(this).attr('data-lng');
			marker = L.marker([lat, lng]).addTo(shipping_map).bindPopup($(this).attr('data-branch-name'));
			shipping_map.setView(new L.LatLng(lat, lng), 14);
		});
	}

	// Cập nhật thông tin khách hàng
	$('#shipping-form').submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'customer_info');
		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				if (response.success) {
					window.location.href = response.data.url;
				} else {
					alert(response.data);
				}
				loader.hide();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});
		return false;
	});

	// Chọn địa chỉ
	var province = $('#province');
	var district = $('#district');
	var wards = $('#wards');

	province.select2();
	district.select2();
	wards.select2();

	province.on('change', function (e) {
		let province_selected = $(this).val();
		$.ajax({
			type: "post",
			dataType: "html",
			url: _n_framework.admin_ajax_url,
			data: {
				action: "get_district",
				province: province_selected,
			},
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				district.html(response);
				district.select2("destroy").select2();
				loader.hide();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});

		return false;
	});

	district.on('change', function (e) {
		let district_selected = $(this).val();
		$.ajax({
			type: "post",
			dataType: "html",
			url: _n_framework.admin_ajax_url,
			data: {
				action: "get_wards",
				district: district_selected,
			},
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				wards.html(response);
				wards.select2("destroy").select2();
				loader.hide();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});

		return false;
	});

	// Xem trước ảnh
	$('#id-front, #id-back, #portrait').on('change', function (e) {
		$(this).closest('label').find('.preview').addClass('show').attr('src', URL.createObjectURL(e.target.files[0]));
		$(this).closest('label').find('.image-remove').show();
	});

	// Xem trước Video
	$('#short-clip').on('change', function (e) {
		$(this).closest('label').find('.preview').addClass('show');
		$(this).closest('label').find('.image-remove').show();
		var $source = $('#video_here');
		$source[0].src = URL.createObjectURL(this.files[0]);
		$source.parent()[0].load();
	});

	// Xoá ảnh và video đã chọn
	$(document).on('click', '.image-remove', function () {
		$(this).closest('label').find('.preview').removeClass('show');
		$(this).closest('label').find('input').val('');
		$(this).hide();
	});

	// Đăng ký chính chủ
	$('#kyc-form').submit(function (e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.append('action', 'owner_register');

		$.ajax({
			type: "post",
			processData: false,
			contentType: false,
			url: _n_framework.admin_ajax_url,
			data: formData,
			beforeSend: function () {
				loader.show();
			},
			success: function (response) {
				if (response.success) {
					window.location.href = response.data.url;
				} else {
					alert(response.data);
				}
				loader.hide();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('The following error occured: ' + textStatus, errorThrown);
				loader.hide();
			}
		});

		return false;
	});

	const pre = ["093", "0777", "0767", "0901", "0898", "0789", "0765"];
	const end = ["86", "78", "33", "35", "111", "333", "222", "123", "234", "456", "012", "778", "9876"];
	let time = getRandomInt(10000, 15000);

	function getRandomInt(min, max) {
		min = Math.ceil(min);
		max = Math.floor(max);
		return Math.floor(Math.random() * (max - min) + min); //The maximum is exclusive and the minimum is inclusive
	}

	const alertPromote = () => tata.success('Sim ' + pre[getRandomInt(0, pre.length - 1)] + '***' + end[
		getRandomInt(0, end.length - 1)] + ' đã được đặt', Math.floor(time / 1000) + ' giây trước.', {
		position: 'tr',
		onClose: () => {
			time = getRandomInt(10000, 15000);
			setTimeout(() => {
				alertPromote();
			}, time);
		}
	});

	setTimeout(() => {
		alertPromote();
	}, time);

	var popupModal = new bootstrap.Modal(document.getElementById("popupModal"), {});

	function showModal() {
		popupModal.show();
	}

	const modalShown = localStorage.getItem('modalShown');

	if (!modalShown) {
		showModal();
		localStorage.setItem('modalShown', true);
	}

	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
		return false;
	};

	var phan_loai = getUrlParameter('phan_loai');

	var startingYear = 1900;
	var endingYear = 2023;
	var yearArray = [];

	for (var i = startingYear; i <= endingYear; i++) {
		yearArray.push(i.toString());
	}

	// $('.sims-wrapper').unhighlight().highlight(['111', '222', '333', '444', '555', '666', '777', '888', '999', '000']);

	if (phan_loai === '_sim_than_tai') {
		$('.sims-wrapper').unhighlight().highlight(['39', '79']);
	} else if (phan_loai === '_sim_tho_dia') {
		$('.sims-wrapper').unhighlight().highlight(['38', '78']);
	} else if (phan_loai === '_sim_loc_phat') {
		$('.sims-wrapper').unhighlight().highlight(['68']);
	} else if (phan_loai === '_sim_phat_loc') {
		$('.sims-wrapper').unhighlight().highlight(['86']);
	} else if (phan_loai === '_sim_luc_quy') {
		$('.sims-wrapper').unhighlight().highlight(['000000', '111111', '222222', '333333', '444444', '555555', '666666', '777777', '888888', '999999']);
	} else if (phan_loai === '_sim_ngu_quy') {
		$('.sims-wrapper').unhighlight().highlight(['00000', '11111', '22222', '33333', '44444', '55555', '66666', '77777', '88888', '99999']);
	} else if (phan_loai === '_sim_tu_quy') {
		$('.sims-wrapper').unhighlight().highlight(['0000', '1111', '2222', '3333', '4444', '5555', '6666', '7777', '8888', '9999']);
	} else if (phan_loai === '_sim_tam_hoa_kep') {
		$('.sims-wrapper').unhighlight().highlight(['000', '111', '222', '333', '444', '555', '666', '777', '888', '999']);
	} else if (phan_loai === '_sim_tam_hoa_cuoi') {
		$('.sims-wrapper').unhighlight().highlight(['000', '111', '222', '333', '444', '555', '666', '777', '888', '999']);
	} else if (phan_loai === '_sim_tam_hoa') {
		$('.sims-wrapper').unhighlight().highlight(['000', '111', '222', '333', '444', '555', '666', '777', '888', '999']);
	} else if (phan_loai === '_sim_sanh_tien_len') {
		$('.sims-wrapper').unhighlight().highlight(['012', '123', '234', '345', '456', '567', '678', '789']);
	} else if (phan_loai === '_sim_nam_sinh') {
		$('.sims-wrapper').unhighlight().highlight(yearArray);
	}

	// Định dạng số
	function numberFormat(number, decimals = 0, decimalSeparator = '.', thousandSeparator = '.') {
		var parts = number.toFixed(decimals).split('.')
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandSeparator)
		return parts.join(decimalSeparator)
	}
})(jQuery);
