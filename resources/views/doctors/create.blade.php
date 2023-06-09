@extends('layouts.app')
@section('title')
    {{__('messages.doctor.add')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('doctors.index') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                {{ Form::open(['route' => ['doctors.store'], 'method' => 'POST', 'files' => true,'id'=> 'createDoctorForm']) }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label for="first_name" class="form-label required">{{ __('messages.doctor.first_name') }}:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="{{ __('messages.doctor.first_name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label for="last_name" class="form-label required">{{ __('messages.doctor.last_name') }}:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="{{ __('messages.doctor.last_name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label for="email" class="form-label required">{{ __('messages.user.email') }}:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('messages.user.email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label for="contact" class="form-label">{{ __('messages.user.contact_number') }}:</label>
                            <input type="tel" name="contact" id="contact" class="form-control" placeholder="{{ __('messages.user.contact_number') }}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="phoneNumber">
                            <input type="hidden" name="region_code" id="prefix_code">
                            <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.valid_number') }}</span>
                            <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">{{ __('messages.invalid_number') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="mb-1">
                            <label for="password" class="form-label required">{{ __('messages.staff.password') }}:</label>
                            <span data-bs-toggle="tooltip" title="{{ __('messages.flash.user_8_or') }}">
                                <i class="fa fa-question-circle"></i>
                            </span>
                            <div class="mb-3 position-relative">
                                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('messages.staff.password') }}" autocomplete="off" required aria-label="Password" data-toggle="password">
                                <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="mb-1">
                            <label for="password_confirmation" class="form-label required">{{ __('messages.user.confirm_password') }}:</label>
                            <span data-bs-toggle="tooltip" title="{{ __('messages.flash.user_8_or') }}">
                                <i class="fa fa-question-circle"></i>
                            </span>
                            <div class="mb-3 position-relative">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="{{ __('messages.user.confirm_password') }}" autocomplete="off" required aria-label="confirm_password" data-toggle="confirm_password">
                                <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                
                        <div class="col-md-6 mb-5">
                            <div class="mb-1">
                                <label for="dob" class="form-label">{{ __('messages.doctor.dob') }}:</label>
                                <input type="text" name="dob" id="dob" class="form-control doctor-dob" placeholder="{{ __('messages.doctor.dob') }}" value="{{ old('dob') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label for="specializations" class="form-label required">{{ __('messages.doctor.specialization') }}:</label>
                                <select name="specializations[]" id="specializations" class="io-select2 form-select" data-control="select2" multiple data-placeholder="{{ __('messages.doctor.specialization') }}">
                                    @foreach($specializations as $specialization)
                                        {{-- <option value="{{ $specialization->id }}">{{ $specialization->name }}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label for="experience" class="form-label">{{ __('messages.doctor.experience') }}:</label>
                                <input type="text" name="experience" id="experience" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, '')" placeholder="{{ __('messages.doctor.experience') }}" step="any" value="{{ old('experience') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label required">{{ __('messages.doctor.select_gender') }}:</label>
                                <div class="mt-2">
                                    <input class="form-check-input" type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>
                                    <label class="form-label mr-3">{{ __('messages.doctor.male') }}</label>
                                    <input class="form-check-input ms-2" type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>
                                    <label class="form-label mr-3">{{ __('messages.doctor.female') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="blood_group" class="form-label">{{ __('messages.patient.blood_group') }}:</label>
                            <select name="blood_group" id="blood_group" class="io-select2 form-select" data-control="select2" data-placeholder="{{ __('messages.patient.blood_group') }}">
                                @foreach($bloodGroup as $group)
                                    <option value="{{ $group }}">{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="twitterUrl" class="form-label">{{ __('messages.doctor.twitter') }}:</label>
                            <input type="text" name="twitter_url" id="twitterUrl" class="form-control" placeholder="{{ __('messages.common.twitter_url') }}" value="{{ old('twitter_url') }}">
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="linkedinUrl" class="form-label">{{ __('messages.doctor.linkedin') }}:</label>
                            <input type="text" name="linkedin_url" id="linkedinUrl" class="form-control" placeholder="{{ __('messages.common.linkedin_url') }}" value="{{ old('linkedin_url') }}">
                        
                    </div>
                    <div class="col-md-6 mb-5">
                        <label class="form-label" for="instagramUrl">{{__('messages.doctor.instagram')}}:</label>
                        <input type="text" name="instagram_url" id="instagramUrl" class="form-control" placeholder="{{__('messages.common.instagram_url')}}">
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-5">
                            <div class="mb-3" io-image-input="true">
                                <label for="exampleInputImage" class="form-label">{{__('messages.doctor.profile')}}:</label>
                                <div class="d-block">
                                    <div class="image-picker">
                                        <div class="image previewImage" id="exampleInputImage" style="background-image: url({{ !empty($service->icon) ? $service->icon : asset('web/media/avatars/male.png') }})"></div>
                                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip" data-placement="top" data-bs-original-title="{{ __('messages.user.edit_profile') }}">
                                            <label> 
                                                <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                                                <input type="file" id="profilePicture" name="profile" class="image-upload d-none profile-validation" accept="image/*">
                                            </label> 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <label class="form-label">{{__('messages.doctor.status')}}:</label>
                        <div class="col-lg-8">
                            <div class="form-check form-check-solid form-switch">
                                <input tabindex="12" name="status" value="0" class="form-check-input" type="checkbox" id="allowmarketing" checked="checked">
                                <label class="form-check-label" for="allowmarketing"></label>
                            </div>
                        </div>
                    </div>
                    <div class="fw-bolder fs-3 rotate collapsible mb-7">
                        {{__('messages.doctor.address_information')}}
                    </div>
                    <div class="row gx-10 mb-5">
                        <div class="col-md-6 mb-5">
                            <label class="form-label" for="address1">{{__('messages.doctor.address1')}}:</label>
                            <input type="text" name="address1" id="address1" class="form-control" placeholder="{{__('messages.doctor.address1')}}">
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="form-label" for="address2">{{__('messages.doctor.address2')}}:</label>
                            <input type="text" name="address2" id="address2" class="form-control" placeholder="{{__('messages.doctor.address2')}}">
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="form-label" for="editDoctorCountryId">{{__('messages.doctor.country')}}:</label>
                            <select name="country_id" id="editDoctorCountryId" class="io-select2 form-select" data-control="select2" placeholder="{{__('messages.doctor.country')}}">
                                <!-- Options for country select -->
                            </select>
                        </div>
                    
                        <div class="col-md-6 mb-5">
                            <label class="form-label" for="editDoctorStateId">{{__('messages.doctor.state')}}:</label>
                            <select name="state_id" id="editDoctorStateId" class="io-select2 form-select" data-control="select2" placeholder="{{__('messages.doctor.state')}}">
                                <!-- Options for state select -->
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="form-label" for="editDoctorCityId">{{__('messages.doctor.city')}}:</label>
                            <select name="city_id" id="editDoctorCityId" class="io-select2 form-select" data-control="select2" placeholder="{{__('messages.doctor.city')}}">
                                <!-- Options for city select -->
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="form-label" for="postal_code">{{__('messages.doctor.postal_code')}}:</label>
                            <input type="text" name="postal_code" class="form-control" placeholder="{{__('messages.doctor.postal_code')}}">
                        </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">{{__('messages.common.save')}}</button>
                            <a href="{{route('doctors.index')}}" type="reset" class="btn btn-secondary">{{__('messages.common.discard')}}</a>
                        </div>
                    </div>  
                
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
