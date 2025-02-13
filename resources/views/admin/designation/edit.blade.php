@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    Edit Designation
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('designations.index') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('designations.update', $designation->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">Designation Name <span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="Designation Name" name="name"
                                value="{{ old('name', $designation->name) }}">
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

                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label" for="inputPassword4">Description</label>
                        <div class="relative">
                            <textarea class="sm:p-5 py-3 px-4 ti-form-input" rows="2" name="description">{{ old('description', $designation->description) }}</textarea>
                        </div>
                        @error('description')
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
                                <option {{ $designation->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                <option {{ $designation->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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
                        <label class="form-label" for="inputEmail4">Order</label>
                        <div class="relative">
                            <input
                                class="form-control @error('order') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                id="inputEmail4" type="number" name="order"
                                value="{{ old('order', $designation->order) }}" min="1">
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

                    <div class="col-span-12">
                        <button class="ti-btn ti-btn-primary-full" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
