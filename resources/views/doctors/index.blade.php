@extends('layouts.app')
@section('title')
    {{__('messages.doctors')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <div class="content d-flex flex-column flex-column-fluid pt-7">
                <div class="d-flex flex-column-fluid">
                    <div class="container-fluid">
                        <div class="d-flex flex-column">
                            <div id="datatable-neJSl3t7bKnJaNDt8tgd">
                                <div class="d-none">
                                    <div class="alert alert-danger d-flex align-items-center" style="display: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.3em;height:1.3em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="d-inline-block ml-2">You are not connected to the internet.</span>
                                    </div>
                                </div>
            
                                <div class="d-flex flex-column">
                                    <div></div>
                                    <div class="d-md-flex justify-content-between mb-3 livewire-search-box align-items-center">
                                        <div class="d-md-flex">
                                            <div class="mb-3 mb-sm-0">
                                                <div class="position-relative d-flex width-320">
                                                    <span class="position-absolute d-flex align-items-center top-0 bottom-0 left-0 text-gray-600 ms-3">
                                                        <svg class="svg-inline--fa fa-magnifying-glass" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"></path>
                                                        </svg><!-- <i class="fa-solid fa-magnifying-glass"></i> Font Awesome fontawesome.com -->
                                                    </span>
                                                    <input type="search" name="search" class="form-control w-250px ps-10" placeholder="Search">
                                                </div>
                                            </div>
                                       
            
        </div>
        @include('doctors.qualification-modal')
    </div>
@endsection
