@extends('layouts.admin')

@section('content')
  <section class="content">
      <div class="container-fluid" id="app">
        <router-view name="menuIndex"></router-view>
        <router-view>
        </router-view>
      </div>
  </section>
@endsection
