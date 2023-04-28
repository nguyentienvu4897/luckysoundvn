let $selectcity = $('.select-city');
let $liststore = $('#list-store');
$(function(){
	var public_spreadsheet_url = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vQ3LHAG9q8SXl1SWmpRxvgnQ_7oYJBDbUyzi7PtxdeqNLMhAk7VFLnhn3_zn5KV_TzZUVehY9KPPo87/pub?gid=0&single=true&output=csv';
	init_spreadsheet(public_spreadsheet_url);
})
function sortByKey(array, key) {
	return array.sort(function (a, b) {
		var x = a[key];
		var y = b[key];
		return ((x < y) ? -1 : ((x > y) ? 1 : 0));
	});
}
function init_spreadsheet(public_spreadsheet_url) {
	Papa.parse(public_spreadsheet_url, {
		download: true,
		header: true,
		complete: function(results) {
			showInfo(results.data)
		}
	})
}
function extractSrcFormIframe(iframe){
	if (/<(\"[^\"]*\"|'[^']*'|[^'\">])*>/g.test(`${iframe}`)){
		if(/src\s*=\s*'(.+?)'/.exec(`${iframe}`)){
			return /src\s*=\s*'(.+?)'/.exec(`${iframe}`).toString();
		} else return '';
	} else{
		return iframe
	}
}
function showInfo(data, tabletop) {
	var stores_arr = data.reduce(function (acc, item) {
		var obj = [];
		var key = item.thanh_pho;
		obj.type = item.dinh_dang;
		obj.address = item.dia_chi;
		obj.district = item.quan_huyen;
		obj.storename = item.ten_cua_hang;
		obj.phonemap = item.so_dien_thoai;
		obj.mailmap = item.mail_map;
		obj.ban_do = extractSrcFormIframe((item.ban_do).toString().replace(/"/ig, "'"));
		obj.grand_opening = item.khai_truong
		if (!acc[key]) {
			acc[key] = [];
		}
		acc[key].push({
			grand_opening: obj.grand_opening,
			type: obj.type,
			address: obj.address,
			storename: obj.storename,
			mailmap: obj.mailmap,
			phonemap: obj.phonemap,
			ban_do: obj.ban_do,
			district: obj.district
		})
		acc[key].sort(function (a, b) {
			var nameA = a.district.replace('quận ', '');
			var nameB = b.district.replace('quận ', '');
			if (nameA < nameB) {
				return -1;
			}
			if (nameA > nameB) {
				return 1;
			}
			return 0;
		})
		return acc;
	}, {});
	console.log(stores_arr);
	var grand_openning_arr = data.filter(function (item) {
		return item.khai_truong;
	}).map(function(item){
		return {
			city:item.thanh_pho,
			ban_do:item.ban_do,
			address:item.dia_chi,
			grand_opening:item.khai_truong,
			district:item.quan_huyen,
			storename:item.ten_cua_hang,
			mailmap:item.mail_map
		}
	})
	grand_openning_arr = grand_openning_arr.sort(function(a, b){
		if (a.city.toLowerCase() == b.city.toLowerCase()) return 0;
		if (a.city.toLowerCase() == 'hồ chí minh') return -1;
		if (b.city.toLowerCase() == 'hồ chí minh') return 1;
		if (a.city.toLowerCase() == 'hà nội') return -2;
		if (b.city.toLowerCase() == 'hà nội') return 2;
		if (a.city.toLowerCase() < b.city.toLowerCase())
			return -1;
		if (a.city.toLowerCase() > b.city.toLowerCase())
			return 1;
		return 0;
	})
	store_generate(stores_arr);
	if (grand_openning_arr.length > 0) {
		grand_opening_generate(grand_openning_arr)
		var $set_default = $liststore.find('.item').eq(0);
		$set_default.addClass('checked')
		generateMap($set_default.data('ban_do'), $set_default.data('address'))
	} else {
		var setdefault = stores_arr[Object.keys(stores_arr)[0]][0];
		$selectcity.val($selectcity.find('option').eq(1).val()).trigger('change');
		generateMap(setdefault.ban_do,setdefault.address)
	}
	$('.sectionContentStore').show();
	$('.cssload-loader').hide();
}
function changeStore(val,data) {
	$liststore.empty();
	$.each(data[val], function (i, item) {
		var isGrandOpenning = item.grand_opening != '' ? 'date_openning' : 'hidden' 
		var $item = '<div class="item position-relative p-1 mb-1 rounded" data-ban_do="' + item.ban_do + '" data-address="' + item.address + '">'
		+ '<div class="district font-weight-bold">' + item.storename + '</div>'
		+ '<div>Mail: ' + item.mailmap + '</div>'
		+ '<div>Hotline: ' + item.phonemap + '</div>'
		+ '<div>' + item.address + ' - '+ item.district + '</div>'
		+ '</div>';
		$liststore.append($item)
	})
	$liststore.find('.item').on('click', function () {
		var $this = $(this);
		if (!$this.hasClass('unclick')) {
			$this.siblings().removeClass('checked');
			$this.addClass('checked');
			var ban_do = $this.data('ban_do');
			var address = $this.attr('data-address');
			var storename = $this.attr('data-storename');
			generateMap(ban_do, address,storename, data[val].map(function(item){
				return [item.storename,item.address,item.ban_do];
			}));
		}
	})
}
function generateMap(ban_do, address,locations,storename) {
	$('#map').html(`<div class="embed-responsive embed-responsive-16by9 h-100"><iframe class="embed-responsive-item" ${ban_do} allowfullscreen></iframe></div>`);
}
function grand_opening_generate(data) {
	var $liststore = $('#list-store');
	$liststore.html('');
	$.each(data, function (i, item) {
		var $item = '<div class="item" data-ban_do="' + item.ban_do + '" ' + item.lng + ' data-address="' + item.address + '">'
		+ '<div class="district">' + item.storename + '<span class="date_openning">' + item.grand_opening + '</span></div>'
		+ '<div class="district2">Mail: ' + item.mailmap + '</div>'
		+ '<div class="district2">Hotline: ' + item.phonemap + '</div>'
		+ '<div class="district1">' + item.address + ' - '+ item.district + '</div>'
		+ '</div>';
		$liststore.append($item)
	})
	$liststore.find('.item').click(function () {
		var $this = $(this);
		if (!$this.hasClass('unclick')) {
			$this.siblings().removeClass('checked');
			$this.addClass('checked');
			var ban_do = $this.data('ban_do');
			var address = $this.attr('data-address');
			generateMap(ban_do, address);
		}
	})
}
function store_generate(data) {
	var $liststore = $('#list-store');
	$.each(data, function (key, value) {
		$selectcity.append('<option value="' + key + '">' + key + '</option>');
	});
	if(data[$selectcity.val()]){
		$.each(data[$selectcity.val()], function (i, item) {
			var $item = '<div class="item">'
			+ item.address
			+ '</div>';
			$liststore.append($item)
		});
		changeStore($selectcity.val(),data)
	}

	$selectcity.on('change', function () {
		changeStore($(this).val(),data)
		var $set_default = $liststore.find('.item').eq(0);
		$set_default.addClass('checked');
		var locations = data[$(this).val()].map(function(item){
			return [item.address,item.ban_do];
		});
		generateMap($set_default.data('ban_do'), $set_default.data('address'),locations)
	});
}
$('.d-menu').on('mouseenter', function() {
	$selectcity.blur();
});