@extends('layouts.admin.master')
@section('content')
    @include('admin.includes.message')
    <div class="grid grid-cols-12 gap-6 mt-4">
        <div class="xl:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        Notifications
                        @if ($notifications->isNotEmpty())
                            <span
                                class="badge bg-light text-default rounded-full ms-1 text-[0.75rem] align-middle">{{ $notifications->total() }}</span>
                        @endif
                    </div>

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table whitespace-nowrap min-w-full">
                            <thead>
                                <tr class="border-b border-defaultborder">
                                    <th class="text-start px-4 py-2" scope="col">#</th>
                                    <th class="text-start px-4 py-2" scope="col">Message</th>
                                    <th class="text-start px-4 py-2" scope="col">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($notifications->isNotEmpty())
                                    @foreach ($notifications as $key => $notice)
                                        <tr class="{{ $loop->last ? '' : 'border-b border-defaultborder' }}">
                                            <th class="px-4 py-2" scope="row">{{ $key + $notifications->firstItem() }}
                                            </th>
                                            <td class="px-4 py-2">{{ $notice->message ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $notice->created_at ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3"
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

                {{ $notifications->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
