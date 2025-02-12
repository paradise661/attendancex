<div>
    <!-- Filter Section -->
    <div class="flex items-center justify-end mb-4">
        <div class="flex items-center w-full max-w-xl gap-4">
            <select class="form-control w-80 !px-3 !py-2 !text-sm !rounded-md" aria-label="Filter by status"
                wire:model.live="status">
                <option value="">All Status</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Rejected">Rejected</option>
            </select>

            <input class="form-control w-80 !px-3 !py-2 !text-sm !rounded-l-md !border-r-0" id="daterangeCalendar"
                type="text" wire:model.live="dateRange" aria-label="Search by date" autocomplete="off"
                placeholder="Search by date">

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
                Leave requests
                @if ($leaves->isNotEmpty())
                    <span
                        class="badge bg-light text-default rounded-full ms-1 text-[0.75rem] align-middle">{{ $leaves->count() }}</span>
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
                            <th class="text-start px-4 py-2" scope="col">Leave Type</th>
                            <th class="text-start px-4 py-2" scope="col">Day's</th>
                            <th class="text-start px-4 py-2" scope="col">Reason</th>
                            <th class="text-start px-4 py-2" scope="col">Status</th>
                            <th class="text-start px-4 py-2" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($leaves->isNotEmpty())
                            @foreach ($leaves as $key => $leave)
                                <tr class="{{ $loop->last ? '' : 'border-b border-defaultborder' }}">
                                    <th class="px-4 py-2" scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="avatar avatar-xs me-2 online avatar-rounded">
                                                <a class="fancybox" data-fancybox="demo"
                                                    href="{{ $leave->employee->image ?? '' }}">
                                                    <img src="{{ $leave->employee->image ?? '' }}" alt="profile">
                                                </a>
                                            </span>
                                            {{ $leave->employee->full_name ?? '' }}
                                            ({{ $leave->employee->branch->name ?? '' }})
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $leave->from_date == $leave->to_date ? $leave->from_date : "{$leave->from_date} to {$leave->to_date}" }}
                                    </td>
                                    <td class="px-4 py-2">{{ $leave->leavetype->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $leave->no_of_days ?? '-' }}</td>
                                    <td class="px-4 py-2" style="white-space: normal">{{ $leave->reason ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="{{ ($leave->status == 'Approved' ? 'bg-green-500' : $leave->status == 'Pending') ? 'bg-yellow-500' : 'bg-red-500' }} px-2 py-1 text-white">{{ $leave->status ?? '-' }}</span>
                                    </td>
                                    <td class="text-end px-4 py-2">
                                        <div class="btn-list flex gap-3">
                                            <a class="ti-btn ti-btn-primary-full !py-1 !px-3 ti-btn-wave"
                                                href="{{ route('leaves.edit', $leave->id) }}">
                                                <i class="ri-loop-right-line"></i> Manage Request
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8"
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
