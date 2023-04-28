@extends('layouts.main.master')
@section('title')
Hệ thống của hàng
@endsection
@section('description')
Hệ thống cửa hàng
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
<link rel="preload" as="style"  href="{{asset('frontend/css/pagestyle.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/pagestyle.scss.css')}}" rel="stylesheet" type="text/css" media="all" />

<link rel="preload" as="style"  href="{{asset('frontend/css/hethong_style.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/hethong_style.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
<script>
	$('.address').click(function(e) {
		e.preventDefault();
		var map = $(this).data('ban_do');
		$('.address').removeClass('checked');
		$(this).addClass('checked');
		console.log(map);
		if (map) {
			$('.gg-map').html(map);
		} else {
			$('.gg-map').html("<p>Bản đồ đang được cập nhật...</p>");
		}
	})
</script>
@endsection
@section('content')
<div class="contentWarp ">
	<div class="com_info">
	<div class="container mt-3 mb-3">
		<div class="col-main rounded m_white_bg_module p-lg-3 pl-2 pr-2 page-title">
			<h1 class="font-weight-bold mt-0 mb-3">
				Hệ thống cửa hàng
			</h1>
			<div class="rte">
				<div class="cssload-loader" style="display: none;">Đang tải bản đồ</div>
				<div class="sectionContentStore row" style="">
				<div class="col-12 col-md-4">
					<div class="leftCollumStore h-100 p-2 p-lg-3 rounded">
						<div class="form-group m-0">
							<label class="select-city-label font-weight-bold text-uppercase position-relative mb-2">Các chi nhánh cửa hàng của Lucky Sound</label>
							{{-- <label class="select-city-wrapper mb-1">
							<select name="select-city" class="select-city custom-select">
								<option value="" disabled="" selected="">Chọn tỉnh/ thành phố</option>
								<option value="Hà Nội">Hà Nội</option>
								<option value="Hải Phòng">Hải Phòng</option>
							</select>
							</label> --}}
						</div>
						<div class="resultStore">
							<div id="list-store" class="pr-1">
								@foreach ($partner as $key=>$item)
								@if ($key==0)
									<div class="item position-relative p-2 mb-1 rounded address checked" data-ban_do="{{$item->link}}">
										{!!$item->name!!}
									</div>
								@else
									<div class="item position-relative p-2 mb-1 rounded address" data-ban_do="{{$item->link}}">
										{!!$item->name!!}
									</div>
								@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8">
					<div id="map" class="rounded modal-open">
						<div class="embed-responsive h-100 gg-map text-center">
							{!!$partner[0]->link!!}
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
@endsection