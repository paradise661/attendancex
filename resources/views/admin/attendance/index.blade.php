@extends('layouts.admin.master')
@section('content')
    @include('admin.includes.message')
    <div class="grid grid-cols-12 gap-6 mt-4">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Attendances
                        @if ($attendances->isNotEmpty())
                            <span
                                class="badge bg-light text-default rounded-full ms-1 text-[0.75rem] align-middle">{{ $attendances->total() }}</span>
                        @endif
                    </div>
                    <div class="prism-toggle">
                        {{-- <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                            href="{{ route('employees.create') }}">
                            New Attendance <i class="ri-add-line"></i>
                        </a> --}}
                    </div>

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table whitespace-nowrap min-w-full">
                            <thead>
                                <tr class="border-b border-defaultborder">
                                    <th class="text-start px-4 py-2" scope="col">#</th>
                                    <th class="text-start px-4 py-2" scope="col">Employee</th>
                                    <th class="text-start px-4 py-2" scope="col">Date</th>
                                    <th class="text-start px-4 py-2" scope="col">Check In</th>
                                    <th class="text-start px-4 py-2" scope="col">Check Out</th>
                                    <th class="text-start px-4 py-2" scope="col">Break Out</th>
                                    <th class="text-start px-4 py-2" scope="col">Break In</th>
                                    <th class="text-start px-4 py-2" scope="col">Worked Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($attendances->isNotEmpty())
                                    @foreach ($attendances as $key => $attendance)
                                        <tr class="{{ $loop->last ? '' : 'border-b border-defaultborder' }}">
                                            <th class="px-4 py-2" scope="row">{{ $key + $attendances->firstItem() }}</th>
                                            <td>
                                                <div class="flex items-center"> <span
                                                        class="avatar avatar-xs me-2 online avatar-rounded">
                                                        <a class="fancybox" data-fancybox="demo"
                                                            href="{{ $attendance->employee->image ?? '' }}">
                                                            <img src="{{ $attendance->employee->image ?? '' }}"
                                                                alt="profile">
                                                        </a>
                                                    </span>{{ ($attendance->employee->first_name ?? '') . ' ' . ($attendance->employee->last_name ?? '-') }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-2">{{ $attendance->date ?? '-' }}</td>
                                            <td class="px-4 py-2">
                                                {{ $attendance->checkin ? \Carbon\Carbon::parse($attendance->checkin)->format('h:i A') : '-' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $attendance->checkout ? \Carbon\Carbon::parse($attendance->checkout)->format('h:i A') : '-' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $attendance->break_start ? \Carbon\Carbon::parse($attendance->break_start)->format('h:i A') : '-' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $attendance->break_end ? \Carbon\Carbon::parse($attendance->break_end)->format('h:i A') : '-' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ formatWorkedHours($attendance->worked_hours) }}
                                            </td>
                                            {{-- <td class="text-end px-4 py-2">
                                                <div class="btn-list flex gap-3">
                                                    <a class="ti-btn ti-btn-primary-full !py-1 !px-3 ti-btn-wave"
                                                        href="{{ route('employees.edit', $employee->id) }}">
                                                        <i class="ri-pencil-line"></i> Edit
                                                    </a>

                                                    <form class="delete-form"
                                                        action="{{ route('employees.destroy', $employee->id) }}"
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
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10"
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

                {{ $attendances->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
