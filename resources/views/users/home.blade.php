@extends('layouts.user.app')

@section('title', __('messages.user.home.title'))

@section('breadcrumb')

@endsection

@section('content')
<section class="section dashboard">
	<p class="h2 mb-3">{{__('messages.user.home.folders')}}</p>
	<div class="row text-center d-flex">
		@forelse($folders as $folder)
		<div class="col-md-3 mb-2">
			<x-folder :folder=$folder/>
		</div>
		@empty
			<div class="col-md-12 mb-2">
				<img class="no-data" src="{{asset('placeholders/nodata.png')}}" />
			</div>
		@endforelse
	</div>
	<hr />
	<p class="h2 mb-3">{{__('messages.user.home.files')}}</p>
	<div class="row text-center d-flex">
		@forelse($files as $file)
			<div class="col-md-3">
				<x-file :file=$file/>
			</div>
			@empty
				<div class="col-md-12 mb-2">
			<img class="no-data" src="{{asset('placeholders/nodata.png')}}" />
		</div>
		@endforelse
	</div>
</section>
@endsection