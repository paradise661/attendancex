@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    New Department
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('departments.index') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>

            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('departments.store') }}" method="POST">
                    @csrf

                    <!-- Main form fields (9 Columns) -->
                    <div class="md:col-span-10 col-span-12 grid grid-cols-12 gap-4">
                        <div class="md:col-span-12 col-span-12">
                            <label class="form-label">Department Name<span class="text-red-500"> *</span></label>
                            <div class="relative">
                                <input
                                    class="form-control @error('name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    type="text" aria-label="Department Name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label">Branch<span class="text-red-500"> *</span></label>
                            <div class="relative">
                                <select
                                    class="ti-form-select rounded-sm @error('branch_id') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    name="branch_id">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id ?? '' }}">{{ $branch->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label">Order</label>
                            <div class="relative">
                                <input
                                    class="form-control @error('order') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    type="number" name="order" value="{{ old('order') }}" min="1">
                                @error('order')
                                    <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-12 col-span-12">
                            <label class="form-label">Description</label>
                            <div class="relative">
                                <textarea class="sm:p-5 py-3 px-4 ti-form-input" rows="2" name="description">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label">Status</label>
                            <div class="relative">
                                <select
                                    class="ti-form-select rounded-sm @error('status') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                    name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <p class="text-sm text-red-600 mt-2"><i>*{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Exceptional Days Checkboxes (3 Columns) -->
                    <div class="md:col-span-2 col-span-12">
                        <label class="form-label">Holidays</label>
                        <div class="grid grid-cols-1 gap-2">
                            @php
                                $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                            @endphp
                            @foreach ($days as $day)
                                <div class="flex items-center space-x-2">
                                    <input class="form-checkbox ti-form-checkbox text-primary" type="checkbox"
                                        name="holidays[]" value="{{ $day }}"
                                        {{ $day == 'Saturday' ? 'checked' : '' }}>
                                    <label>{{ $day }}</label>
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
