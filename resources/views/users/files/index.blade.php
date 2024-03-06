@extends('layouts.user.app')

@section('title', __('messages.user.files.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('messages.user.files.title') }}</li> &nbsp; ({{$files->total()}})
@endsection

@section('content')
@include('users.files.modal')
<section class="section">
	@if(request('search'))
		<p class="h6 mb-3 text-danger">{{trans_choice('messages.user.files.search_result_for', $files->total(), ["search" => request('search')])}}</p>
	@endif
	<div class="d-flex justify-content-between">
		<div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadFile"><i class="bi bi-cloud-arrow-up"></i>&nbsp;{{__('messages.user.files.upload')}}</button>
        </div>
		<div>
			<form action="{{route('user.files.index')}}" id="fileSearchForm">
				<div class="d-flex gap-2 justify-content-end">
					<div class="mb-5">
						{{--<label for="fileSearchBar" class="form-label">{{ __('messages.user.files.search') }}</label>--}}
						<div class="input-group">
							<input type="text" name="search" value="{{request('search')}}" placeholder="{{ __('messages.user.files.search_placeholder') }}" class="form-control" id="fileSearchBar" aria-describedby="fileSearchInput" required="">
						</div>
					</div>
					<div>
						<button id="fileSearchBtn" type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ __('messages.user.files.search') }}"><i class="bi bi-search"></i></button>
					</div>
					<div>
						<a class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ __('messages.user.files.clear') }}" href="{{route('user.files.index')}}"><i class="bi bi-x-lg"></i></a>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="row text-center d-flex">
		@forelse($files as $key => $file)
		<div class="col-md-3 mb-2">
            <x-file :file=$file :url="route('user.files.show', $file)"/>
		</div>
		@empty
		<div class="col-md-12 mb-2">
			<img class="no-data" src="{{asset('placeholders/nodata.png')}}" />
		</div>
		@endforelse
	</div>
	@if($files->hasPages())
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-end">
				{{$files->withQueryString()->links('pagination::bootstrap-4')}}
			</ul>
		</nav>
	@endif
</section>
@endsection

@section('script')
@include('users.files.script')
@endsection