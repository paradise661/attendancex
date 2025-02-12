@extends('layouts.admin.master')
@section('content')
    @include('admin.includes.message')

    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    Change Password
                </div>

            </div>
            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('update.password') }}" method="POST">
                    @csrf
                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">Current Password <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('current_password') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="password" aria-label="Current Password" name="current_password"
                                value="{{ old('current_password') }}">
                            @error('current_password')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('current_password')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">New Password <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('new_password') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="password" aria-label="new_password" name="new_password"
                                value="{{ old('new_password') }}">
                            @error('new_password')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('new_password')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label" for="inputEmail4">Confirm New Password <span class="text-red-500">
                                *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('new_password_confirmation') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                id="inputEmail4" type="password" name="new_password_confirmation"
                                value="{{ old('new_password_confirmation') }}">
                            @error('new_password_confirmation')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('new_password_confirmation')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12">
                        <button class="ti-btn ti-btn-primary-full" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
