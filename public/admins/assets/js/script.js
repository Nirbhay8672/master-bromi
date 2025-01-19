(function ($) {
	"use strict";
	$(document).on("click", function (e) {
		var outside_space = $(".outside");
		if (
			!outside_space.is(e.target) &&
			outside_space.has(e.target).length === 0
		) {
			$(".menu-to-be-close").removeClass("d-block");
			$(".menu-to-be-close").css("display", "none");
		}
	});

	$(".prooduct-details-box .close").on("click", function (e) {
		var tets = $(this)
			.parent()
			.parent()
			.parent()
			.parent()
			.addClass("d-none");
		console.log(tets);
	});

	if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
		$(".sidebar-list").hover(
			function () {
				$(this).addClass("hoverd");
			},
			function () {
				$(this).removeClass("hoverd");
			}
		);
		$(window).on("scroll", function () {
			if ($(this).scrollTop() < 600) {
				$(".sidebar-list").removeClass("hoverd");
			}
		});
	}

	/*----------------------------------------
	   passward show hide
	   ----------------------------------------*/
	$(".show-hide").show();
	$(".show-hide span").addClass("show");

	$(".show-hide span").click(function () {
		if ($(this).hasClass("show")) {
			$('input[name="login[password]"]').attr("type", "text");
			$(this).removeClass("show");
		} else {
			$('input[name="login[password]"]').attr("type", "password");
			$(this).addClass("show");
		}
	});
	$('form button[type="submit"]').on("click", function () {
		$(".show-hide span").addClass("show");
		$(".show-hide")
			.parent()
			.find('input[name="login[password]"]')
			.attr("type", "password");
	});

	/*=====================
		02. Background Image js
		==========================*/
	$(".bg-center").parent().addClass("b-center");
	$(".bg-img-cover").parent().addClass("bg-size");
	$(".bg-img-cover").each(function () {
		var el = $(this),
			src = el.attr("src"),
			parent = el.parent();
		parent.css({
			"background-image": "url(" + src + ")",
			"background-size": "cover",
			"background-position": "center",
			display: "block",
		});
		el.hide();
	});

	$(".mega-menu-container").css("display", "none");
	$(".header-search").click(function () {
		$(".search-full").addClass("open");
	});
	$(".close-search").click(function () {
		$(".search-full").removeClass("open");
		$("body").removeClass("offcanvas");
	});
	$(".mobile-toggle").click(function () {
		$(".nav-menus").toggleClass("open");
	});

	$(".bookmark-search").click(function () {
		$(".form-control-search").toggleClass("open");
	});
	$(".filter-toggle").click(function () {
		$(".product-sidebar").toggleClass("open");
	});
	$(".toggle-data").click(function () {
		$(".product-wrapper").toggleClass("sidebaron");
	});
	$(".form-control-search input").keyup(function (e) {
		if (e.target.value) {
			$(".page-wrapper").addClass("offcanvas-bookmark");
		} else {
			$(".page-wrapper").removeClass("offcanvas-bookmark");
		}
	});
	$(".search-full input").keyup(function (e) {
		console.log(e.target.value);
		if (e.target.value) {
			$("body").addClass("offcanvas");
		} else {
			$("body").removeClass("offcanvas");
		}
	});

	$("body").keydown(function (e) {
		if (e.keyCode == 27) {
			$(".search-full input").val("");
			$(".form-control-search input").val("");
			$(".page-wrapper").removeClass("offcanvas-bookmark");
			$(".search-full").removeClass("open");
			$(".search-form .form-control-search").removeClass("open");
			$("body").removeClass("offcanvas");
		}
	});
	$(".mode").on("click", function () {
		$(".mode").toggleClass("dark");
		$("body").toggleClass("dark-only");
		var color = $(this).attr("data-attr");
		localStorage.setItem("body", "dark-only");
	});
})(jQuery);

$(".loader-wrapper").fadeOut("slow", function () {
	setTimeout(() => {
		$(this).remove();
	}, 500);
});

$(window).on("scroll", function () {
	if ($(this).scrollTop() > 600) {
		$(".tap-top").fadeIn();
	} else {
		$(".tap-top").fadeOut();
	}
});

$(".tap-top").click(function () {
	$("html, body").animate(
		{
			scrollTop: 0,
		},
		600
	);
	return false;
});

function toggleFullScreen() {
	if (
		(document.fullScreenElement && document.fullScreenElement !== null) ||
		(!document.mozFullScreen && !document.webkitIsFullScreen)
	) {
		if (document.documentElement.requestFullScreen) {
			document.documentElement.requestFullScreen();
		} else if (document.documentElement.mozRequestFullScreen) {
			document.documentElement.mozRequestFullScreen();
		} else if (document.documentElement.webkitRequestFullScreen) {
			document.documentElement.webkitRequestFullScreen(
				Element.ALLOW_KEYBOARD_INPUT
			);
		}
	} else {
		if (document.cancelFullScreen) {
			document.cancelFullScreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitCancelFullScreen) {
			document.webkitCancelFullScreen();
		}
	}
}
(function ($, window, document, undefined) {
	"use strict";
	var $ripple = $(".js-ripple");
	$ripple.on("click.ui.ripple", function (e) {
		var $this = $(this);
		var $offset = $this.parent().offset();
		var $circle = $this.find(".c-ripple__circle");
		var x = e.pageX - $offset.left;
		var y = e.pageY - $offset.top;
		$circle.css({
			top: y + "px",
			left: x + "px",
		});
		$this.addClass("is-active");
	});
	$ripple.on(
		"animationend webkitAnimationEnd oanimationend MSAnimationEnd",
		function (e) {
			$(this).removeClass("is-active");
		}
	);
})(jQuery, window, document);

// active link

$(".chat-menu-icons .toogle-bar").click(function () {
	$(".chat-menu").toggleClass("show");
});

//landing header //
$(".toggle-menu").click(function () {
	$(".landing-menu").toggleClass("open");
});
$(".menu-back").click(function () {
	$(".landing-menu").toggleClass("open");
});

$(".md-sidebar-toggle").click(function () {
	$(".md-sidebar-aside").toggleClass("open");
});

// Language
var tnum = "en";

$(document).ready(function () {
	if (localStorage.getItem("primary") != null) {
		var primary_val = localStorage.getItem("primary");
		$("#ColorPicker1").val(primary_val);
		var secondary_val = localStorage.getItem("secondary");
		$("#ColorPicker2").val(secondary_val);
	}

	$(document).click(function (e) {
		$(".translate_wrapper, .more_lang").removeClass("active");
	});
	$(".translate_wrapper .current_lang").click(function (e) {
		e.stopPropagation();
		$(this).parent().toggleClass("active");

		setTimeout(function () {
			$(".more_lang").toggleClass("active");
		}, 5);
	});

	/*TRANSLATE*/
});

$(".mobile-title svg").click(function () {
	$(".header-mega").toggleClass("d-block");
});

$(".onhover-dropdown").on("click", function () {
	$(this).children(".onhover-show-div").toggleClass("active");
});

// if ($(window).width() <= 991) {
//     $(".left-header .link-section").children('ul').css('display', 'none');
//     $(this).parent().children('ul').toggleClass("d-block").slideToggle();
// }

// if ($(window).width() < 991) {
//     $('<div class="bg-overlay"></div>').appendTo($('body'));
//     $(".bg-overlay").on("click", function () {
//         $(".page-header").addClass("close_icon");
//         $(".sidebar-wrapper").addClass("close_icon");
//         $(this).removeClass("active");
//     });

//     $(".toggle-sidebar").on("click", function () {
//         $(".bg-overlay").addClass("active");
//     });
//     $(".back-btn").on("click", function () {
//         $(".bg-overlay").removeClass("active");
//     });
// }

$("#flip-btn").click(function () {
	$(".flip-card-inner").addClass("flipped");
});

$("#flip-back").click(function () {
	$(".flip-card-inner").removeClass("flipped");
});

$(".email-sidebar .email-aside-toggle ").on("click", function (e) {
	$(".email-sidebar .email-left-aside ").toggleClass("open");
});

$(".resp-serch-box").on("click", function (e) {
	$(".search-form").toggleClass("open");
	e.preventDefault();
});

// for count function js ----------------------------

// $(document).ready(function(){
//     $('.count').prop('disabled', true);
//      $(document).on('click','.plus',function(){
//     $('.count').val(parseInt($('.count').val()) + 1 );
//     });
//       $(document).on('click','.minus',function(){
//       $('.count').val(parseInt($('.count').val()) - 1 );
//         if ($('.count').val() == 0) {
//         $('.count').val(1);
//       }
//         });
//   });

$(".md-sidebar-toggle").click(function () {
	$(".md-sidebar-aside").toggleClass("open");
});

// color selector
$(".color-selector ul li ").on("click", function (e) {
	$(".color-selector ul li").removeClass("active");
	$(this).addClass("active");
});

// custom javascript

function generate_result(params, i, str) {
	result = params[i]['address'];
	if (str == "areas" || str == "building") {
		if (str == "areas") {
			url = view_area_url + "?data_id=" + params[i]["id"];
		}
		result = params[i]["name"];
	} else if (str == "users") {
		url = view_user_url + "?data_id=" + params[i]["id"];
		result = params[i]["first_name"];
	} else if (str == "enquiries") {
		result = params[i]["client_name"];
		url = view_enquiry_url + "?data_id=" + params[i]["id"];
	} else if (str == "projects") {
		result = params[i]["project_name"];
		url = view_projects_url + "?data_id=" + params[i]["id"];
	} else if (str == 'properties') {
		result = params[i]["address"];
		url = view_properties_url + "?data_id=" + params[i]["id"];
	} else {
		url = "javascript:voide(0)";
	}
	var myvar =
		'<div>' +
		'	<a href="' + url + '" class="header-search-action py-2" <p class="mb-0">' +
		result +
		" (" + str + ")" + "</p></a>" +
		"</div>";
	return myvar;
}

function gotoUrl(url) {
	if (url != "") {
		window.location.href = url;
	}
}

function search() {
	$("#result_container").html("");
	var quer = $("#search_input").val();
	$.ajax({
		type: "POST",
		url: search_url,
		data: {
			search: quer,
			_token: $("[name=_token]").val(),
		},
		success: function (data) {
			try {
				var dataaa = JSON.parse(data);
				var arrs = [
					"building",
					"enquiries",
					"projects",
					"users",
					"areas",
					"properties",
				];
				$("#result_container").html("");
				$("#result_container").append('<p class="mb-0 mt-2"><b id="result_count">0</b> results</p>');
				var total_result = 0;
				for (let i = 0; i < arrs.length; i++) {
					if (dataaa[arrs[i]] !== undefined) {
						total_result = total_result + dataaa[arrs[i]].length;
						$("#result_count").html(total_result);
						if (dataaa[arrs[i]].length > 0) {
							for (let v = 0; v < dataaa[arrs[i]].length; v++) {
								$("#result_container").append(
									generate_result(dataaa[arrs[i]], v, arrs[i])
								);
							}
						}
					}
				}
			} catch (error) {
				console.log(error);
				$("#result_count").html(0);
				$("#result_container").html("");
			}
		},
	});
}

function debounce(func, wait, immediate) {
	var timeout;
	return function () {
		var context = this,
			args = arguments;
		var later = function () {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
}

$("#search_input").keyup(
	debounce(function () {
		search();
	}, 1000)
);

$(document).on("change", "#drop4_modal_form input", function (e) {
	var loanAmount = Number($("#drop4_loan").val());
	var loanDuration = Number($("#drop_4_tenure").val());
	var interestRate = Number($("#drop_4_percentage").val());
	if (loanAmount > 0 && loanDuration > 0 && interestRate > 0) {
		var interestPerYear = (loanAmount * interestRate) / 100;
		var monthlyInterest = interestPerYear / 12;

		var monthlyPayment = monthlyInterest + (loanAmount / loanDuration);
		var totalInterestCost = monthlyInterest * loanDuration;
		var totalRepayment = monthlyPayment * loanDuration;

		$("#monthly_payment").html(monthlyPayment.toFixed(2));
		$("#total_payment").html(totalRepayment.toFixed(2));
		$("#interest_cost").html(totalInterestCost.toFixed(2));
	}
});

$(document).on("change", "#drop3_modal_form input", function (e) {
	basic_total = Number($("#basic_sqft").val()) * Number($("#basic_rs").val());
	basic_construction_total =
		(Number($("#basic_construction_percent").val()) * basic_total) / 100;
	registration_fee_total =
		(Number($("#registration_percent").val()) * basic_total) / 100;
	stamp_duty_total =
		Number($("#stamp_duty_sqft").val()) * Number($("#stamp_duty_rs").val());
	others_total =
		Number($("#others_sqft").val()) * Number($("#others_rs").val());
	other1_total =
		Number($("#other1_sqft").val()) * Number($("#other1_rs").val());
	other2_total =
		Number($("#other2_sqft").val()) * Number($("#other2_rs").val());
	maintanance_total =
		Number($("#maintanance_sqft").val()) *
		Number($("#maintanance_rs").val());
	main_deposit_total =
		Number($("#main_deposit_sqft").val()) *
		Number($("#main_deposit_rs").val());

	$("#basic_total").html(basic_total);
	$("#basic_construction_total").html(basic_construction_total);
	$("#registration_fee_total").html(registration_fee_total);
	$("#stamp_duty_total").html(stamp_duty_total);
	$("#others_total").html(others_total);
	$("#other1_total").html(other1_total);
	$("#other2_total").html(other2_total);
	$("#maintanance_total").html(maintanance_total);
	$("#main_deposit_total").html(main_deposit_total);
	groupa =
		basic_total +
		basic_construction_total +
		registration_fee_total +
		stamp_duty_total +
		others_total;
	groupb =
		other1_total + other2_total + maintanance_total + main_deposit_total;
	$("#groupa_total").html(groupa);
	$("#groupb_total").html(groupb);
	$("#groupab_total").html(groupa + groupb);
});

$(document).ready(function () {
	$("body").addClass("rtl");

	// $(document).on("click", "#search-bar", function (e) {
	// 	$("#sear_bar_modal").modal("show");
	// });
});

$(document).on("click", ".drop_list_url", function (e) {
	window.location.href = $(this).attr("data-url");
});

$(document).on("submit", "#modal_form", function (e) {
	console.log(5654545);
	return false;
});

var cost_year = [
	"2001_2002",
	"2002_2003",
	"2003_2004",
	"2004_2005",
	"2005_2006",
	"2006_2007",
	"2007_2008",
	"2008_2009",
	"2009_2010",
	"2010_2011",
	"2011_2012",
	"2012_2013",
	"2013_2014",
	"2014_2015",
	"2015_2016",
	"2016_2017",
	"2017_2018",
	"2018_2019",
	"2019_2020",
	"2020_2021",
	"2021_2022",
	"2022_2023",
];

var cost_value = [
	"100",
	"105",
	"109",
	"113",
	"117",
	"122",
	"129",
	"137",
	"148",
	"167",
	"184",
	"200",
	"220",
	"240",
	"254",
	"264",
	"272",
	"280",
	"289",
	"301",
	"317",
	"331",
];

if ($("#loan_amount_slider").length > 0) {
	$("#loan_amount_slider").slider({
		max: 500000000,
		min: 0,
		step: 10000,
		slide: function (event, ui) {
			$("#drop4_loan").val(ui.value).trigger("change");
		},
	});

	$("#loan_percent_slider").slider({
		max: 30,
		min: 0,
		step: 1,
		slide: function (event, ui) {
			$("#drop_4_percentage").val(ui.value).trigger("change");
		},
	});

	$("#loan_month_slider").slider({
		max: 360,
		min: 0,
		step: 1,
		slide: function (event, ui) {
			$("#drop_4_tenure").val(ui.value).trigger("change");
		},
	});
}

$(document).on(
	"change",
	"input[name=drop_capital_sale_year],#drop_capital_purchase_date,#drop_capital_purchase_price,#drop_capital_sale_price",
	function (e) {
		var sale_year = $('input[name="drop_capital_sale_year"]:checked').val();
		var purchase_date = $("#drop_capital_purchase_date").val();
		var purchase_price = $("#drop_capital_purchase_price").val();
		var sale_price = $("#drop_capital_sale_price").val();
		var sale_index = "";
		var purchase_index = "";

		if (
			sale_year != "" &&
			purchase_date != "" &&
			purchase_price != "" &&
			sale_price != ""
		) {
			for (let i = 0; i < cost_year.length; i++) {
				if (cost_year[i].includes("_" + sale_year.split("_")[0])) {
					sale_index = cost_value[i];
				}
				var dat_splited = purchase_date.split("-");
				if (dat_splited[1] >= 4) {
					year_string = dat_splited[0] + "_";
				} else {
					year_string = "_" + dat_splited[0];
				}
				if (cost_year[i].includes(year_string)) {
					purchase_index = cost_value[i];
				}
			}
			var result = (sale_index / purchase_index) * purchase_price;
			$("#drop_capital_capital_gained").val(result.toFixed());
			$("#drop_capital_final").val((sale_price - result).toFixed());
		}
	}
);

//by subhash

function encryptSimpleString(val) {
	var encrypted = CryptoJS.AES.encrypt(val, "Ngodeinweb");
	return encrypted
		.toString()
		.replaceAll("+", "xM674JSUBl3Jk")
		.replaceAll("/", "PKv852LAM21Ld")
		.replaceAll("=", "MVHJ4wl32");
}

function decryptSimpleString(val) {
	val = val
		.toString()
		.replaceAll("xM674JSUBl3Jk", "+")
		.replaceAll("PKv852LAM21Ld", "/")
		.replaceAll("MVHJ4wl32", "=");
	var decrypted = CryptoJS.AES.decrypt(val, "Ngodeinweb");
	return decrypted.toString(CryptoJS.enc.Utf8);
}

// $(document).keydown(function (event) {
// 	if (event.keyCode == 27) {
// 		$("[aria-labelledby=exampleModalLabel]").modal("hide");
// 	}
// });

function setFocus() {
	setTimeout(() => {
		$('#modal_form input:visible,#modal_form select').first().focus()
	}, 200);
}

//filter empty array
function filtercona_arr(arr) {
	whatreturn = 0;
	for (let i = 0; i < arr.length; i++) {
		if (arr[i] !== 'undefined ' && arr[i] !== undefined && arr[i] !== '' && arr[i] !== null && arr[i] !== 'null') {
			str = arr[i]
			if (typeof str === 'string' || str instanceof String) {
				str = str.trim()
			}
			if (str != '') {
				whatreturn = 1;
				break;
			}
		}
	}

	return whatreturn
}
