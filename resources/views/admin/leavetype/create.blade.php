@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    New Leavetype
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('leavetypes.index') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('leavetypes.store') }}" method="POST">
                    @csrf
                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Name<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="Name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('name')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Short Name</label>
                        <div class="relative">
                            <input
                                class="form-control @error('short_name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="Short Name" name="short_name" value="{{ old('short_name') }}">

                            @error('short_name')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>

                        @error('short_name')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Duration (Days)<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('duration') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="number" aria-label="Duration" name="duration" value="{{ old('duration') }}"
                                min="1" autocomplete="off">

                            @error('duration')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>

                        @error('duration')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label" for="inputEmail4">Order</label>
                        <div class="relative">
                            <input
                                class="form-control @error('order') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                id="inputEmail4" type="number" name="order" value="{{ old('order') }}" min="1">
                            @error('order')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('order')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label mt-2">Is Paid?<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <div class="form-check form-check-md flex item-center">
                                <input class="form-check-input" type="checkbox" value="1" name="is_paid" checked>
                            </div>
                            @error('is_paid')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>

                        @error('is_paid')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label mt-2">Gender<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div class="form-check flex form-check-md items-center">
                                    <input class="form-check-input" id="male" type="radio" value="Male"
                                        name="gender">
                                    <label class="form-check-label ml-2" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-md flex items-center">
                                    <input class="form-check-input" id="female" type="radio" value="Female"
                                        name="gender">
                                    <label class="form-check-label ml-2" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-md flex items-center">
                                    <input class="form-check-input" id="both" type="radio" value="Both"
                                        name="gender" checked>
                                    <label class="form-check-label ml-2" for="both">Both</label>
                                </div>
                            </div>

                            @error('gender')
                                <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                    <i>*{{ $message }}</i>
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-12">
                        <button class="ti-btn ti-btn-primary-full" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
