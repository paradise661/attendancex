@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    Edit Role
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('roles.index') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">Role Name<span class="text-red-500"> *</span></label>
                        <div class="relative">
                            <input
                                class="form-control @error('name') ti-form-input !border-danger focus:border-danger focus:ring-danger @enderror"
                                type="text" aria-label="Role Name" name="name" value="{{ old('name', $role->name) }}">
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

                    <div class="md:col-span-12 col-span-12 mt-2">
                        <!-- Accordion Item: Permissions -->
                        <details class="mb-4 border border-gray-200 rounded-lg shadow-md">
                            <summary
                                class="flex justify-between items-center text-lg font-semibold p-4 bg-gray-100 hover:bg-gray-200 cursor-pointer transition duration-300 ease-in-out">
                                <span class="">
                                    Permissions
                                </span>
                                <svg class="w-5 h-5 text-gray-600 transform transition-transform duration-300"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" :class="open ? 'rotate-180' : ''">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </summary>

                            <div class="p-4 bg-gray-50">
                                <span class="text-sm my-4">
                                    <input class="mr-2" id="selectAllPermissions" type="checkbox" name=""> Select
                                    All
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
                                    @foreach ($permission as $key => $per)
                                        <div
                                            class="bg-white p-4 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                                            <div class="flex items-center space-x-3 mb-4">
                                                <input
                                                    class="select-all form-checkbox ti-form-checkbox text-blue-600 appearance-none border-gray-300 checked:border-blue-600 checked:bg-blue-600"
                                                    type="checkbox" child-class="{{ $key }}" name=""
                                                    value="">
                                                <b
                                                    class="text-lg font-semibold text-gray-800 capitalize">{{ ucwords(str_replace('_', ' ', $key)) }}</b>
                                            </div>

                                            <!-- Permissions List -->
                                            <div class="space-y-3 ml-4">
                                                @foreach ($per as $item)
                                                    <div class="flex items-center space-x-3">
                                                        <input
                                                            class="{{ $key }} all-select-items form-checkbox ti-form-checkbox text-blue-600 appearance-none  border-2 border-gray-300 checked:border-blue-600 checked:bg-blue-600 rounded"
                                                            type="checkbox" @if (in_array($item->name, $rolePermissions)) checked @endif
                                                            name="permission[]" value="{{ $item->name }}">
                                                        <label class="text-sm text-gray-700" for="permission[]">
                                                            {{ ucwords($item->name) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Error Message -->
                                @error('permission')
                                    <div class="text-sm text-red-600 mt-4">
                                        <div class="p-3 bg-red-100 rounded-lg shadow-sm">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                            </div>

                        </details>
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
        $('.select-all').click(function(e) {
            var childclass = $(this).attr('child-class');
            if ($(this).prop('checked')) {
                $('.' + childclass).prop('checked', true);
            } else {
                $('.' + childclass).prop('checked', false);
            }
        })
        $('#selectAllPermissions').click(function(e) {
            if ($(this).prop('checked')) {
                $('.all-select-items').prop('checked', true);
            } else {
                $('.all-select-items').prop('checked', false);
            }
        })
    </script>
@endsection
