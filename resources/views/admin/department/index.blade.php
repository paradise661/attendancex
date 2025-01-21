@extends('layouts.admin.master')
@section('content')
    @include('admin.includes.message')
    <div class="grid grid-cols-12 gap-6 mt-4">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Departments
                        @if ($departments->isNotEmpty())
                            <span
                                class="badge bg-light text-default rounded-full ms-1 text-[0.75rem] align-middle">{{ $departments->total() }}</span>
                        @endif
                    </div>
                    <div class="prism-toggle">
                        <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                            href="{{ route('departments.create') }}">
                            New Department <i class="ri-add-line"></i>
                        </a>
                    </div>

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table whitespace-nowrap min-w-full">
                            <thead>
                                <tr class="border-b border-defaultborder">
                                    <th class="text-start px-4 py-2" scope="col">#</th>
                                    <th class="text-start px-4 py-2" scope="col">Department Name</th>
                                    <th class="text-start px-4 py-2" scope="col">Branch</th>
                                    <th class="text-start px-4 py-2" scope="col">Order</th>
                                    <th class="text-start px-4 py-2" scope="col">Status</th>
                                    <th class="text-start px-4 py-2" scope="col">Last Updated</th>
                                    <th class="text-start px-4 py-2"scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($departments->isNotEmpty())
                                    @foreach ($departments as $key => $department)
                                        <tr class="{{ $loop->last ? '' : 'border-b border-defaultborder' }}">
                                            <th class="px-4 py-2" scope="row">{{ $key + $departments->firstItem() }}</th>
                                            <td class="px-4 py-2">{{ $department->name ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $department->branch->name ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $department->order ?? '-' }}</td>
                                            <td class="px-4 py-2">
                                                <span
                                                    class="badge bg-primary/10 text-primary">{{ $department->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $department->updated_at ? $department->updated_at->format('Y-m-d h:i A') : '' }}
                                            </td>
                                            <td class="text-end px-4 py-2">
                                                <div class="btn-list flex gap-3">
                                                    <a class="ti-btn ti-btn-primary-full !py-1 !px-3 ti-btn-wave"
                                                        href="{{ route('departments.edit', $department->id) }}">
                                                        <i class="ri-pencil-line"></i> Edit
                                                    </a>

                                                    <form class="delete-form"
                                                        action="{{ route('departments.destroy', $department->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="ti-btn ti-btn-danger-full !py-1 !px-3 ti-btn-wave delete_button"
                                                            id="" data-type="confirm" type="submit"
                                                            title="Delete"><i class="ri-delete-bin-line"></i>
                                                            Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7"
                                            style="text-align: center; height: 100px; vertical-align: middle; color: #6b7280; display: table-cell;">
                                            <div
                                                style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                                                <p class="text-lg font-semibold">No data available</p>
                                                <p class="mt-2 text-sm">There are no records to display at the moment.
                                                    Please check again later.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $departments->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
