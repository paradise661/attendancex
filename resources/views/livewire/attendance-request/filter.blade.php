<div>
    <!-- Filter Section -->
    <div class="flex items-center justify-end mb-4">
        <div class="flex items-center w-full max-w-md gap-2">

            <input class="form-control w-full !px-3 !py-2 !text-sm !rounded-l-md !border-r-0" id="daterange" type="text"
                wire:model.live="dateRange" aria-label="Search by date" autocomplete="off" placeholder="Search by date">

            @if ($dateRange)
                <button class="ti-btn !mb-0 ti-btn-danger-full !rounded-r-md !px-4" wire:click="clearFilters"
                    type="button" aria-label="Clear Filter">
                    Clear <i class="ri-close-line"></i>
                </button>
            @endif
        </div>
    </div>

    <div class="box custom-box">
        <div class="box-header justify-between">
            <div class="box-title">
                Attendance requests
                @if ($attendance_requests->isNotEmpty())
                    <span
                        class="badge bg-light text-default rounded-full ms-1 text-[0.75rem] align-middle">{{ $attendance_requests->count() }}</span>
                @endif
            </div>
        </div>

        <!-- Table Section -->
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
                            <th class="text-start px-4 py-2" scope="col">Reason</th>
                            <th class="text-start px-4 py-2" scope="col">Status</th>
                            <th class="text-start px-4 py-2" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($attendance_requests->isNotEmpty())
                            @foreach ($attendance_requests as $key => $attendance)
                                <tr class="{{ $loop->last ? '' : 'border-b border-defaultborder' }}">
                                    <th class="px-4 py-2" scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="avatar avatar-xs me-2 online avatar-rounded">
                                                <a class="fancybox" data-fancybox="demo"
                                                    href="{{ $attendance->employee->image ?? '' }}">
                                                    <img src="{{ $attendance->employee->image ?? '' }}" alt="profile">
                                                </a>
                                            </span>
                                            {{ $attendance->employee->full_name ?? '' }}
                                            ({{ $attendance->employee->branch->name ?? '' }})
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">{{ $attendance->date ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $attendance->checkin ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $attendance->checkout ?? '-' }}</td>
                                    <td class="px-4 py-2" style="white-space: normal">{{ $attendance->reason ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="{{ $attendance->status == 'Approved' ? 'bg-green-500' : 'bg-red-500' }} px-2 py-1 text-white">{{ $attendance->status ?? '-' }}</span>
                                    </td>
                                    <td class="text-end px-4 py-2">
                                        <div class="btn-list flex gap-3">
                                            <a class="ti-btn ti-btn-primary-full !py-1 !px-3 ti-btn-wave"
                                                href="{{ route('attendance.request.edit', $attendance->id) }}">
                                                <i class="ri-pencil-line"></i> Edit
                                            </a>
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

        {{-- {{ $attendances->links('vendor.pagination.custom') }} --}}
    </div>
</div>
