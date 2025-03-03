@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    Edit Employee
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('employees.index') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('employees.update', $employee->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">First Name <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('first_name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="First Name" name="first_name"
                                value="{{ old('first_name', $employee->first_name) }}">
                            @error('first_name')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('first_name')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Last Name <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('last_name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="First Name" name="last_name"
                                value="{{ old('last_name', $employee->last_name) }}">
                            @error('last_name')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('last_name')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Email <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('email') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="Email" name="email"
                                value="{{ old('email', $employee->email) }}">
                            @error('email')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('email')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Password (Enter to change)</label>
                        <div class="relative">
                            <input
                                class="form-control @error('password') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="password" aria-label="Password" name="password" value="{{ old('password') }}">
                            @error('password')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('password')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Phone <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('phone') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="phone" name="phone"
                                value="{{ old('phone', $employee->phone) }}">
                            @error('phone')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('phone')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Gender</label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('gender') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                name="gender">
                                <option {{ $employee->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                <option {{ $employee->gender == 'Female' ? 'selected' : '' }} value="Female">Female
                                </option>
                                <option {{ $employee->gender == 'Other' ? 'selected' : '' }} value="Other">Other</option>
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

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Designation<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('designation') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                name="designation">
                                <option value="">Please Select</option>
                                @foreach ($designations as $designation)
                                    <option {{ $employee->designation == $designation->name ? 'selected' : '' }}
                                        value="{{ $designation->name ?? '' }}">
                                        {{ $designation->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('designation')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('designation')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Date of Birth <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-[#8c9097] dark:text-white/50"> <i
                                            class="ri-calendar-line"></i> </div> <input
                                        class="form-control flatpickr-input active @error('date_of_birth') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                        id="date" type="text" name="date_of_birth" placeholder="Choose date"
                                        readonly="readonly" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                                    @error('date_of_birth')
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
                        @error('date_of_birth')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Join Date</label>
                        <div class="relative">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-[#8c9097] dark:text-white/50"> <i
                                            class="ri-calendar-line"></i> </div> <input
                                        class="form-control flatpickr-input active @error('join_date') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                        id="date" type="text" name="join_date" placeholder="Choose date"
                                        readonly="readonly" value="{{ old('join_date', $employee->join_date) }}">
                                    @error('join_date')
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
                        @error('join_date')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Resign Date</label>
                        <div class="relative">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-[#8c9097] dark:text-white/50"> <i
                                            class="ri-calendar-line"></i> </div> <input
                                        class="form-control flatpickr-input active @error('resign_date') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                        id="date" type="text" name="resign_date" placeholder="Choose date"
                                        readonly="readonly" value="{{ old('resign_date', $employee->resign_date) }}">
                                    @error('resign_date')
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
                        @error('resign_date')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Branch <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('branch_id') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                id="branch" name="branch_id">
                                <option value="">Please Select</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $employee->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('branch_id')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Department <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('department_id') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                id="department" name="department_id">
                                <option value="">Please Select</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name ?? '' }}
                                    </option>
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
                        <label class="form-label">Shift <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('shift_id') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                id="shift" name="shift_id">
                                <option value="">Please Select</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}"
                                        {{ $employee->shift_id == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift_id')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('shift_id')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Order</label>
                        <div class="relative">
                            <input
                                class="form-control @error('order') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="number" aria-label="order" name="order"
                                value="{{ old('order', $employee->order) }}" min="1">
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
                        <label class="form-label">Status</label>
                        <div class="relative">
                            <select
                                class="ti-form-select rounded-sm !py-2 !px-3 @error('status') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                name="status">
                                <option {{ $employee->status == 'Active' ? 'selected' : '' }} value="Active">Active
                                </option>
                                <option {{ $employee->status == 'Inactive' ? 'selected' : '' }} value="Inactive">Inactive
                                </option>
                                <option {{ $employee->status == 'Suspended' ? 'selected' : '' }} value="Suspended">
                                    Suspended
                                </option>
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

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Image</label>
                        <div>
                            <label class="sr-only" for="file-input">Choose file</label>
                            <input
                                class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/50 file:border-0 file:bg-light file:me-4 file:py-3 file:px-4 dark:file:bg-black/20 dark:file:text-white/50 image"
                                id="file-input" type="file" name="image">
                            <img class="view-image mt-2" src="" style="max-height: 80px">
                            @if ($employee->image)
                                <img class="mt-2 old-image" src="{{ $employee->image ?? '' }}" width="80">
                            @endif
                        </div>
                        @error('image')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Assign Role <span><i> (For enable administrative
                                    privileges)</i></span></label>
                        <div class="relative">
                            <select
                                class="ti-form-select select2 rounded-sm !py-2 !px-3 @error('roles') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                name="roles[]" multiple>
                                <option value=""> Please Select</option>
                                @foreach ($roles as $role)
                                    <option @if (in_array($role->name, old('roles', $assignedRoles))) selected @endif
                                        value="{{ $role->name }}"> {{ $role->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                    <svg class="h-5 w-5 text-danger" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('roles')
                            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
                                <i>*{{ $message }}</i>
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-12">
                        <button class="ti-btn ti-btn-primary-full" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // When the branch changes, load departments
            $('#branch').on('change', function() {
                let branch_id = $(this).val();
                $('#department').html('<option value="">Loading...</option>');
                $('#shift').html('<option value="">Please Select</option>'); // Clear shift dropdown

                $.get("{{ url('get-departments') }}/" + branch_id, function(data) {
                    $('#department').html('<option value="">Please Select</option>');
                    $.each(data, function(key, value) {
                        $('#department').append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });

                    // After departments are loaded, set the selected department
                    @if (old('department_id') ?? $employee->department_id)
                        $('#department').val(
                            '{{ old('department_id') ?? $employee->department_id }}');
                        $('#department').trigger('change');
                    @endif
                });
            });

            // When the department changes, load shifts
            $('#department').on('change', function() {
                let department_id = $(this).val();
                $('#shift').html('<option value="">Loading...</option>');

                $.get("{{ url('get-shifts') }}/" + department_id, function(data) {
                    $('#shift').html('<option value="">Please Select</option>');
                    $.each(data, function(key, value) {
                        $('#shift').append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });

                    // After shifts are loaded, set the selected shift
                    @if (old('shift_id') ?? $employee->shift_id)
                        $('#shift').val('{{ old('shift_id') ?? $employee->shift_id }}');
                    @endif
                });
            });

            // Trigger the change event on page load to populate department and shift based on the selected branch
            $('#branch').trigger('change');
        });
    </script>
@endsection
