@extends('layouts.admin.master')
@section('content')
    <div class="xl:col-span-6 col-span-12 mt-4">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    Attendance Request
                </div>
                <div class="prism-toggle">
                    <a class="ti-btn ti-btn-primary-full ti-btn-wave !text-[0.75rem] flex items-center gap-2"
                        href="{{ route('attendance.request') }}">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="grid grid-cols-12 gap-4 mb-6">
                    <!-- Employee Information -->
                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">Employee</label>
                        <div class="text-gray-700 dark:text-gray-300">
                            {{ $attendancerequest->employee->full_name ?? '' }}
                            ({{ $attendancerequest->employee->branch->name ?? '' }})
                        </div>
                    </div>

                    <!-- Check In -->
                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Check In</label>
                        <div class="text-gray-700 dark:text-gray-300">
                            {{ $attendancerequest->checkin ?? '' }}
                        </div>
                    </div>

                    <!-- Check Out -->
                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Check Out</label>
                        <div class="text-gray-700 dark:text-gray-300">
                            {{ $attendancerequest->checkout ?? '' }}
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="md:col-span-6 col-span-12">
                        <label class="form-label">Date</label>
                        <div class="text-gray-700 dark:text-gray-300">
                            {{ $attendancerequest->date ?? '' }}
                        </div>
                    </div>

                    <!-- Reason -->
                    <div class="md:col-span-12 col-span-12">
                        <label class="form-label">Reason</label>
                        <div class="text-gray-700 dark:text-gray-300">
                            {{ $attendancerequest->reason ?? '' }}
                        </div>
                    </div>
                </div>
                <!-- Admin Response Form -->
                @if ($attendancerequest->status == 'Approved')
                    <div class="md:col-span-12 col-span-12">
                        <div class="text-red-500 dark:text-red-400 font-semibold inline-flex items-center">
                            <i class="mr-1">Note: ⚠ You cannot process this request once it has been approved.</i>
                        </div>
                    </div>
                @else
                    <hr>
                    <form class="grid grid-cols-12 gap-4 mt-4"
                        action="{{ route('attendance.request.update', $attendancerequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Status (Admin Input) -->
                        <div class="md:col-span-6 col-span-12">
                            <label class="form-label">Status</label>
                            <div class="relative">
                                <select class="ti-form-select rounded-sm !py-2 !px-3" id="status-select" name="status">
                                    <option {{ $attendancerequest->status == 'Pending' ? 'selected' : '' }} value="Pending">
                                        Pending
                                    </option>
                                    <option {{ $attendancerequest->status == 'Approved' ? 'selected' : '' }}
                                        value="Approved">
                                        Approve
                                    </option>
                                    <option {{ $attendancerequest->status == 'Rejected' ? 'selected' : '' }}
                                        value="Rejected">
                                        Reject
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Rejection Reason (Admin Input, Conditionally Displayed) -->
                        <div class="md:col-span-12 col-span-12" id="rejection-reason">
                            <label class="form-label">Rejection Reason</label>
                            <div class="relative">
                                <textarea class="sm:p-5 py-3 px-4 ti-form-input" rows="2" name="action_reason">{{ old('action_reason', $attendancerequest->action_reason) }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-span-12">
                            <button class="ti-btn ti-btn-primary-full" type="submit">Submit</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const toggleRejectionReason = () => {
                const isRejected = $("#status-select").val() === "Rejected";
                $("#rejection-reason").toggle(isRejected);
                if (!isRejected) $("textarea[name='action_reason']").val("");
            };

            $("#status-select").change(toggleRejectionReason);
            toggleRejectionReason();
        });
    </script>
@endsection
