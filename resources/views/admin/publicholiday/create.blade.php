@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    New Holiday
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('publicholidays.index') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>

            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('publicholidays.store') }}" method="POST">
                    @csrf

                    <!-- Main form fields (9 Columns) -->
                    <div class="md:col-span-8 col-span-12 grid grid-cols-12 gap-4">
                        <div class="md:col-span-12 col-span-12">
                            <label class="form-label">Holiday Name<span class="text-red-500"> *</span></label>
                            <div class="relative">
                                <input
                                    class="form-control @error('name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    type="text" aria-label="Holiday Name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label">Start Date<span class="text-red-500"> *</span></label>
                            <div class="relative">
                                <input
                                    class="form-control flatpickr-input active @error('start_date') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    id="fulldate" type="text" name="start_date" placeholder="Choose start date"
                                    readonly="readonly" value="{{ old('start_date') }}">
                                @error('start_date')
                                    <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label">End Date (for one day leave it blank)</label>
                            <div class="relative">
                                <input
                                    class="form-control flatpickr-input active @error('end_date') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    id="fulldate" type="text" name="end_date" placeholder="Choose start date"
                                    readonly="readonly" value="{{ old('end_date') }}">
                                @error('end_date')
                                    <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label">Gender</label>
                            <div class="relative">
                                <select
                                    class="ti-form-select rounded-sm !py-2 !px-3 @error('gender') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    name="gender">
                                    <option {{ old('gender') == 'Both' ? 'selected' : '' }} value="Both">Both</option>
                                    <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                    <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                            viewBox="0 0 16 16" aria-hidden="true">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                    </div>
                                @enderror
                            </div>
                            @error('gender')
                                <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                    <i>*{{ $message }}</i>
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Exceptional Days Checkboxes (3 Columns) -->
                    <div class="md:col-span-4 col-span-12">
                        <label class="form-label">Departments</label>
                        <div class="grid grid-cols-1 gap-2">
                            @foreach ($departments as $department)
                                <div class="flex items-center space-x-2">
                                    <input class="form-checkbox ti-form-checkbox text-primary" type="checkbox"
                                        name="departments[]" value="{{ $department->id }}" {{ (in_array($department->id, old('departments', [])) || old('departments') == null) ? 'checked' : '' }}>
                                    <label>{{ $department->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button (12 Columns) -->
                    <div class="col-span-12">
                        <button class="ti-btn ti-btn-primary-full" type="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
