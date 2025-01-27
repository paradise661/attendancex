@extends('layouts.admin.master')
@section('content')
    @include('admin.includes.message')

    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    Site Settings
                </div>

            </div>
            <div class="box-body">
                <form class="grid grid-cols-12 gap-4 mt-0" action="{{ route('site.setting.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">Company Name </label>
                        <input class="form-control mt-1 p-2 border border-gray-300 rounded-md w-full" id="company_name"
                            type="text" name="company_name" value="{{ $setting['company_name'] ?? '' }}" required>
                    </div>

                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label" for="support">Support</label>
                        <input class="form-control mt-1 p-2 border border-gray-300 rounded-md w-full" id="support"
                            type="text" name="support" value="{{ $setting['support'] ?? '' }}" required>
                    </div>

                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label" for="company_information">Company
                            Information</label>
                        <textarea class="sm:p-5 py-3 px-4 border border-gray-300 rounded-md w-full" rows="2" name="company_information">{{ $setting['company_information'] ?? '' }}</textarea>
                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label" for="company_logo">Company Logo
                            (200X60px)</label>
                        <input
                            class="image mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm @error('company_logo') border-red-500 @enderror"
                            id="company_logo" type="file" name="company_logo">

                        <span class="flex items-center gap-4">
                            <img class="view-image mt-2"
                                src="{{ $setting['company_logo'] ? asset('uploads/site/' . $setting['company_logo']) : '' }}"
                                style="max-height: 100px; width: auto;" name="company_logo">

                            @if ($setting['company_logo'])
                                <div>
                                    <a class="bg-red-500 p-1 px-2 text-white rounded-md btnRemoveFile"
                                        href="{{ route('site.setting.remove.file', ['filename' => $setting['company_logo'], 'type' => 'company_logo']) }}">Remove</a>
                                </div>
                            @endif
                        </span>

                    </div>

                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label" for="app_logo">App Logo
                            (200X60px)</label>
                        <input
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm @error('app_logo') border-red-500 @enderror image"
                            id="app_logo" type="file" name="app_logo">

                        <span class="flex items-center gap-4">
                            <img class="view-image mt-3"
                                src="{{ $setting['app_logo'] ? asset('uploads/site/' . $setting['app_logo']) : '' }}"
                                style="max-height: 100px; width: auto;">

                            @if ($setting['app_logo'])
                                <div>
                                    <a class="bg-red-500 p-1 px-2 text-white rounded-md btnRemoveFile"
                                        href="{{ route('site.setting.remove.file', ['filename' => $setting['app_logo'], 'type' => 'app_logo']) }}">Remove</a>
                                </div>
                            @endif
                        </span>
                    </div>

                    <div class="col-span-12 mt-3">
                        <button class="ti-btn ti-btn-primary-full" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".image").change(function() {
            input = this;
            var nthis = $(this);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    nthis.siblings('span').find('.view-image').attr('src', e.target.result);
                    nthis.siblings('span').find('a').hide();
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('.btnRemoveFile').click(function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            swal({
                    title: `Are you sure?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        location.href = url;
                    }
                });
        })
    </script>
@endsection
