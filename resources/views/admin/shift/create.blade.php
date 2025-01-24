@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    New Shift
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('shifts.index') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('shifts.store') }}" method="POST">
                    @csrf
                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">Shift Name<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="Branch Name" name="name" value="{{ old('name') }}">
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
                        <label class="form-label">Start Time<span class="text-red-500"> *</span></label>

                        <div class="relative">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-[#8c9097] dark:text-white/50 "> <i
                                            class="ri-time-line"></i> </div>
                                    <input
                                        class="form-control @error('start_time') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                        id="timepikcr" type="text" name="start_time" placeholder="Choose time"
                                        value="{{ old('start_time') }}" autocomplete="off">
                                    @error('start_time')
                                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                            <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @error('start_time')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label" for="inputEmail4">Start Grace Time</label>
                        <div class="relative">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-[#8c9097] dark:text-white/50"> <i
                                            class="ri-time-line"></i> </div>
                                    <input
                                        class="form-control @error('start_grace_time') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                        id="timepikcr" type="text" name="start_grace_time" placeholder="Choose time"
                                        value="{{ old('start_grace_time') }}" autocomplete="off">
                                    @error('start_grace_time')
                                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                            <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @error('start_grace_time')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label" for="inputEmail4">End Grace Time</label>
                        <div class="relative">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-[#8c9097] dark:text-white/50"> <i
                                            class="ri-time-line"></i> </div>
                                    <input
                                        class="form-control @error('end_grace_time') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                        id="timepikcr" type="text" name="end_grace_time" placeholder="Choose time"
                                        value="{{ old('end_grace_time') }}" autocomplete="off">
                                    @error('end_grace_time')
                                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                            <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @error('end_grace_time')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">End Time<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-[#8c9097] dark:text-white/50"> <i
                                            class="ri-time-line"></i> </div>
                                    <input
                                        class="form-control @error('end_time') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                        id="timepikcr" type="text" name="end_time" placeholder="Choose time"
                                        value="{{ old('end_time') }}" autocomplete="off">
                                    @error('end_time')
                                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                            <svg class="h-5 w-5 text-danger" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @error('end_time')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Department<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('department_id') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                name="department_id">
                                <option value="">Please Select</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id ?? '' }}">{{ $department->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('department_id')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Status</label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('status') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('status')
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
