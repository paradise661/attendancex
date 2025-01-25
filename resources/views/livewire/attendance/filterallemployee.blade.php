<div>
    <!-- Filter Section -->
    <div class="flex items-center justify-end mb-4">
        <div class="flex items-center w-full max-w-md gap-2">

            <!-- Branch Dropdown -->
            <select class="form-control w-full !px-3 !py-2 !text-sm !rounded-md" aria-label="Filter by branch"
                wire:model.live="branch">
                <option value="">All Branches</option>
                @foreach ($branches as $b)
                    <option value="{{ $b->id }}">{{ $b->name ?? '' }}</option>
                @endforeach
            </select>

            <input class="form-control w-full !px-3 !py-2 !text-sm !rounded-l-md !border-r-0" id="date" type="text"
                wire:model.live="searchTerms" aria-label="Search by date" autocomplete="off"
                placeholder="Search by date">

            <!-- Clear Button -->
            @if ($searchTerms || $branch)
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
                Attendances
                @if ($attendances->isNotEmpty())
                    <span
                        class="badge bg-light text-default rounded-full ms-1 text-[0.75rem] align-middle">{{ $attendances->total() }}</span>
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
                            <th class="text-start px-4 py-2" scope="col">Break Start</th>
                            <th class="text-start px-4 py-2" scope="col">Break End</th>
                            <th class="text-start px-4 py-2" scope="col">Total Worked</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($attendances->isNotEmpty())
                            @foreach ($attendances as $key => $attendance)
                                <tr class="{{ $loop->last ? '' : 'border-b border-defaultborder' }}">
                                    <th class="px-4 py-2" scope="row">{{ $key + $attendances->firstItem() }}</th>
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
                                    <td class="px-4 py-2">{{ $attendance->break_start ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $attendance->break_end ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $attendance->worked_hours ?? '' }}</td>
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

        {{ $attendances->links('vendor.pagination.custom') }}
    </div>
</div>
