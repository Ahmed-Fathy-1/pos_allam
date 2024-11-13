@extends('dashboard.layouts.master')

@section('title', 'Home')

@push('style')
@endpush

@section('main')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <main class="main-content w-full pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div class="col-span-12 sm:col-span-12">
                <div class="my-3 flex items-center justify-between px-4 sm:px-5">
                    <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">Home</h2>
                </div>

                {{-- Stat Cards --}}
                <div class="mt-4 grid grid-cols-4 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                    {{-- Stat Card Components --}}
                    @php
                        $stats = [
                            ['title' => 'Users', 'count' => $userCount, 'icon' => 'fa-user', 'bg' => 'warning', 'link' => 'users.index'],
                            ['title' => 'Domains', 'count' => $domainsCount, 'icon' => 'fa-globe', 'bg' => 'info', 'link' => 'tenants.index'],
                            ['title' => 'Feedbacks', 'count' => $feedbackCount, 'icon' => 'fa-comments', 'bg' => 'success', 'link' => 'feedbacks.index'],
                            ['title' => 'Contact Us', 'count' => $contactusCount, 'icon' => 'fa-phone', 'bg' => 'error', 'link' => 'contact-us.index']
                        ];
                    @endphp
                    @foreach ($stats as $stat)
                        <div class="card flex-row justify-between p-4">
                            <div>
                                <a class="text-xs+ uppercase" href={{ route($stat['link']) }}>{{ $stat['title'] }}</a>
                                <div class="mt-8 flex items-baseline space-x-1">
                                    <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">{{ $stat['count'] }}</p>
                                </div>
                            </div>
                            <div class="mask is-squircle flex size-10 items-center justify-center bg-{{ $stat['bg'] }}/10">
                                <i class="fa-solid {{ $stat['icon'] }} text-xl text-{{ $stat['bg'] }}"></i>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Charts Section --}}
                <div class="mt-8 grid grid-cols-12 gap-6">
                    {{-- Users Chart --}}
                    <div class="col-span-12 lg:col-span-6">
                        <div id="chart-users"></div>
                    </div>

                    {{-- Domains Chart --}}
                    <div class="col-span-12 lg:col-span-6">
                        <div id="chart-domains"></div>
                    </div>

                    {{-- Feedbacks Chart --}}
                    <div class="col-span-12 lg:col-span-6">
                        <div id="chart-feedbacks"></div>
                    </div>

                    {{-- Contact Us Chart --}}
                    <div class="col-span-12 lg:col-span-6">
                        <div id="chart-contactus"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Apex Charts Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function createChartOptions(name, data, months) {
                const maxCount = Math.max(...data);
                const yAxisMax = maxCount > 10 ? Math.ceil(maxCount / 10) * 10 : 10;
                return {
                    chart: { type: 'area', height: 350, zoom: { enabled: false } },
                    series: [{ name: name, data: data }],
                    xaxis: { categories: months },
                    yaxis: {
                        max: yAxisMax,
                        tickAmount: yAxisMax > 10 ? 5 : 10,
                        labels: { formatter: value => Math.floor(value) }
                    },
                    title: { text: `${name} Over the Last 12 Months`, align: 'left' },
                    tooltip: { shared: true, intersect: false }
                };
            }

            /**
             * User Chart
             */
            const userCounts = {!! json_encode($userCounts) !!};
            const months = {!! json_encode($months) !!};
            const userChart = new ApexCharts(document.querySelector("#chart-users"), createChartOptions("User Count", userCounts, months));
            userChart.render();

            /**
             * Domains Chart
             */
            const domainCounts = {!! json_encode($domainsCounts) !!};
            const domainChart = new ApexCharts(document.querySelector("#chart-domains"), createChartOptions("Domain Count", domainCounts, months));
            domainChart.render();

            /**
             * Feedbacks Chart
             */
            const feedbackCounts = {!! json_encode($feedbackCounts) !!};
            const feedbackChart = new ApexCharts(document.querySelector("#chart-feedbacks"), createChartOptions("Feedback Count", feedbackCounts, months));
            feedbackChart.render();

            /**
             * Contact Us Chart
             */
            const contactusCounts = {!! json_encode($contactusCounts) !!};
            const contactusChart = new ApexCharts(document.querySelector("#chart-contactus"), createChartOptions("Contact Us Count", contactusCounts, months));
            contactusChart.render();
        });
    </script>

@endsection

@push('scripts')
@endpush
