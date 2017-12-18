@extends('layouts.admin')

@section('content')
	<section class="content">
			<div class="container-fluid" id="app">
				<router-view name="companyIndex"></router-view>
				<router-view>
				</router-view>
			</div>
		</section>
@endsection
