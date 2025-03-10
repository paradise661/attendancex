@extends('layouts.admin.master')
@section('content')
    @include('admin.includes.message')
    <!-- Start::page-header -->
    <div class="md:flex block items-center justify-between my-[1.5rem] page-header-breadcrumb">
        <div>
            <p class="font-semibold text-[1.125rem] text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-0 ">
                Welcome back, Sajilo Attendance Admin !</p>
            <p class="font-normal text-[#8c9097] dark:text-white/50 text-[0.813rem]">
                Keep your workforce on track—monitor attendance, analyze trends, and boost productivity.</p>
        </div>
    </div>
    <!-- End::page-header -->
    @can('view dashboard')
        <div class="grid grid-cols-12 gap-x-6">
            <div class="xxl:col-span-12 xl:col-span-12  col-span-12">
                <div class="grid grid-cols-12 gap-x-6">
                    <div class="xxl:col-span-4 xl:col-span-4  col-span-12">
                        <div class="xxl:col-span-12 xl:col-span-12 col-span-12">
                            <div class="box crm-highlight-card">
                                <div class="box-body">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-semibold text-[1.125rem] text-white mb-2">Employee Check-in Status
                                            </div>
                                            <span class="block text-[0.75rem] text-white">
                                                <span class="opacity-[0.7]">So far today,</span>
                                                <span class="font-semibold text-warning">{{ $presentPercent }}%</span>
                                                <span class="opacity-[0.7]">of employees have checked in. Stay updated!</span>
                                            </span>
                                        </div>
                                        <div>
                                            <div id="crm-main"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xxl:col-span-12 xl:col-span-12 col-span-12">
                            <div class="box">
                                <div class="box-header flex justify-between">
                                    <div class="box-title">
                                        Upcoming Birthdays
                                    </div>
                                </div>
                                <div class="box-body">
                                    @if ($upcomingBirthdays->count())
                                        <ul class="list-none crm-top-deals mb-0">
                                            @foreach ($upcomingBirthdays as $birthday)
                                                <li class="mb-4">
                                                    <div class="flex items-start flex-wrap">
                                                        <div class="me-2">
                                                            <span class=" inline-flex items-center justify-center">
                                                                <img class="w-[1.75rem] h-[1.75rem] leading-[1.75rem] text-[0.65rem]  rounded-full"
                                                                    src="{{ $birthday->image }}" alt="">
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow">
                                                            <p class="font-semibold mb-[1.4px]  text-[0.813rem]">
                                                                {{ $birthday->full_name }}
                                                            </p>
                                                            <p class="text-[#8c9097] dark:text-white/50 text-[0.75rem] mb-0">
                                                                {{ $birthday->email }}</p>
                                                        </div>
                                                        <div class=" text-xs ">
                                                            {{ date('M d', strtotime($birthday->date_of_birth)) }}</div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No Employees Added Yet</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-8 xl:col-span-8 col-span-12">
                        <div class="grid grid-cols-12 gap-x-6">
                            <!-- First Column -->
                            <div class="xxl:col-span-6 xl:col-span-6 col-span-12">
                                <div class="grid grid-cols-1">
                                    <!-- Total Present Box -->
                                    <div class="box overflow-hidden">
                                        <div class="box-body">
                                            <div class="flex items-top justify-between">
                                                <div>
                                                    <span
                                                        class="!text-[0.8rem] !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !rounded-full inline-flex items-center justify-center bg-green-500">
                                                        <i class="ti ti-user text-[1rem] text-white"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow ms-4">
                                                    <div class="flex items-center justify-between flex-wrap">
                                                        <div>
                                                            <p class="text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-0">
                                                                Total Present</p>
                                                            <h4 class="font-semibold text-[1.5rem] !mb-2 ">{{ $todayPresent }}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-between !mt-1">
                                                        <div>
                                                            <a class="text-primary text-[0.813rem]"
                                                                href="{{ route('attendance.index') }}">View All<i
                                                                    class="ti ti-arrow-narrow-right ms-2 font-semibold inline-block"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Absent Box -->
                                    <div class="box overflow-hidden">
                                        <div class="box-body">
                                            <div class="flex items-top justify-between">
                                                <div>
                                                    <span
                                                        class="!text-[0.8rem] !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !rounded-full inline-flex items-center justify-center bg-red-500">
                                                        <i class="ti ti-user-x text-[1rem] text-white"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow ms-4">
                                                    <div class="flex items-center justify-between flex-wrap">
                                                        <div>
                                                            <p class="text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-0">
                                                                Total Absent</p>
                                                            <h4 class="font-semibold text-[1.5rem] !mb-2 ">{{ $todayAbsent }}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-between mt-1">
                                                        <div>
                                                            <a class="text-secondary text-[0.813rem]"
                                                                href="{{ route('attendance.index') }}">View All<i
                                                                    class="ti ti-arrow-narrow-right ms-2 font-semibold inline-block"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Today Leave Box -->
                                    <div class="box overflow-hidden">
                                        <div class="box-body">
                                            <div class="flex items-top justify-between">
                                                <div>
                                                    <span
                                                        class="!text-[0.8rem] !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !rounded-full inline-flex items-center justify-center bg-yellow-500">
                                                        <i class="ti ti-user-exclamation text-[1rem] text-white"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow ms-4">
                                                    <div class="flex items-center justify-between flex-wrap">
                                                        <div>
                                                            <p class="text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-0">
                                                                Today Leave</p>
                                                            <h4 class="font-semibold text-[1.5rem] !mb-2 ">{{ $todayLeave }}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-between mt-1">
                                                        <div>
                                                            <a class="text-success text-[0.813rem]"
                                                                href="{{ route('attendance.index') }}">View All<i
                                                                    class="ti ti-arrow-narrow-right ms-2 font-semibold inline-block"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Second Column -->
                            <div class="xxl:col-span-6 xl:col-span-6 col-span-12">
                                <div class="box">
                                    <div class="box-header justify-between">
                                        <div class="box-title">Today's Attendance Record</div>
                                    </div>
                                    <div class="box-body overflow-hidden">
                                        <div class="leads-source-chart flex items-center justify-center">
                                            <canvas class="chartjs-chart w-full" id="leads-source"></canvas>
                                            <div class="lead-source-value">
                                                <span class="block text-[0.875rem]">Total Employees</span>
                                                <span class="block text-[1.5625rem] font-bold">{{ $totalEmployees }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 border-t border-dashed dark:border-defaultborder/10">
                                        <div class="col !p-0">
                                            <div
                                                class="!ps-4 p-[0.95rem] text-center border-e border-dashed dark:border-defaultborder/10">
                                                <span
                                                    class="text-[#8c9097] dark:text-white/50 text-[0.75rem] mb-1 crm-lead-legend mobile inline-block">Present</span>
                                                <div><span class="text-[1rem] font-semibold">{{ $todayPresent }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col !p-0">
                                            <div
                                                class="p-[0.95rem] text-center border-e border-dashed dark:border-defaultborder/10">
                                                <span
                                                    class="text-[#8c9097] dark:text-white/50 text-[0.75rem] mb-1 crm-lead-legend desktop inline-block">Absent</span>
                                                <div><span class="text-[1rem] font-semibold">{{ $todayAbsent }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col !p-0">
                                            <div class="!pe-4 p-[0.95rem] text-center">
                                                <span
                                                    class="text-[#8c9097] dark:text-white/50 text-[0.75rem] mb-1 crm-lead-legend tablet inline-block">Leave</span>
                                                <div><span class="text-[1rem] font-semibold">{{ $todayLeave }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('scripts')
    <script>
        var options = {
            chart: {
                height: 127,
                width: 100,
                type: "radialBar",
            },

            series: ["{{ $presentPercent }}"],
            colors: ["rgba(255,255,255,0.9)"],
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "55%",
                        background: "#fff"
                    },
                    dataLabels: {
                        name: {
                            offsetY: -10,
                            color: "#4b9bfa",
                            fontSize: ".625rem",
                            show: false
                        },
                        value: {
                            offsetY: 5,
                            color: "#4b9bfa",
                            fontSize: ".875rem",
                            show: true,
                            fontWeight: 600
                        }
                    }
                }
            },
            stroke: {
                lineCap: "round"
            },
            labels: ["Status"]
        };
        document.querySelector("#crm-main").innerHTML = "";
        var chart = new ApexCharts(document.querySelector("#crm-main"), options);
        chart.render();

        // leads
        Chart.defaults.elements.arc.borderWidth = 0;
        Chart.defaults.datasets.doughnut.cutout = '85%';
        var chartInstance = new Chart(document.getElementById("leads-source"), {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'My First Dataset',
                    data: ["{{ $todayPresent }}", "{{ $todayAbsent }}", "{{ $todayLeave }}"],
                    backgroundColor: [
                        'green',
                        'red',
                        'yellow',
                    ]
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 1,
                maintainAspectRatio: false
            },
            plugins: [{
                afterUpdate: function(chart) {
                    const arcs = chart.getDatasetMeta(0).data;

                    arcs.forEach(function(arc) {
                        arc.round = {
                            x: (chart.chartArea.left + chart.chartArea.right) / 2,
                            y: (chart.chartArea.top + chart.chartArea.bottom) / 2,
                            radius: (arc.outerRadius + arc.innerRadius) / 2,
                            thickness: (arc.outerRadius - arc.innerRadius) / 2,
                            backgroundColor: arc.options.backgroundColor
                        }
                    });
                },
                afterDraw: (chart) => {
                    const {
                        ctx,
                        canvas
                    } = chart;

                    chart.getDatasetMeta(0).data.forEach(arc => {
                        const startAngle = Math.PI / 2 - arc.startAngle;
                        const endAngle = Math.PI / 2 - arc.endAngle;

                        ctx.save();
                        ctx.translate(arc.round.x, arc.round.y);
                        ctx.fillStyle = arc.options.backgroundColor;
                        ctx.beginPath();
                        ctx.arc(arc.round.radius * Math.sin(endAngle), arc.round.radius * Math
                            .cos(endAngle), arc.round.thickness, 0, 2 * Math.PI);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    });
                }
            }]
        });
    </script>
@endsection
