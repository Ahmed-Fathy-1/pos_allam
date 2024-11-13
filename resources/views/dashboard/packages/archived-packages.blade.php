@extends('dashboard.layouts.master')

@section('title', 'package')

@push('style')
    <script src="{{ asset('SuperAdmin/assets/js/pages/components-modal.js') }}" defer=""></script>
@endpush

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                AiTech
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('homePage') }}">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li class="flex items-center space-x-2">
                    @can('packages-list')
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('packages.index') }}">package List</a>
                    @endcan
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Archive package</li>
            </ul>
        </div>

        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">

            <!-- Table With Filter -->
            <div id="table-filter">
                <div class="ac js-enabled" id="ac-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Cards Of archived packages
                        </h2>
                    </div>

                    {{-- ------------------------------start of cards --}}
                    <div class="flex items-center justify-center min-h-screen p-4">

                        <div class="grid max-w-4xl grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-5 lg:gap-6">
                            @foreach ($packages as $package)
                                <div class="card p-4 text-center sm:p-5" id="package-{{ $package->id }}">
                                    <div class="mt-5">
                                        <h4 class="text-xl font-semibold text-slate-600 dark:text-navy-100">
                                            {{ $package->title }}
                                        </h4>
                                        {!! $package->description !!}
                                    </div>
                                    <div class="mt-5 flex flex-col items-center">
                                        <label class="inline-flex items-center space-x-2 form-switch">
                                            <span>Monthly</span>
                                            <input
                                                class="form-switch h-5 w-10 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white"
                                                type="checkbox" data-package-id="{{ $package->id }}" />
                                            <span>Yearly</span>
                                        </label>

                                        <!-- Monthly details -->
                                        <span
                                            class="text-4xl tracking-tight text-primary dark:text-accent-light mt-5 monthly-details"
                                            data-package-id="{{ $package->id }}">
                                            {{ $package->packageDetails->Price_monthly }}
                                            <span>/month</span>
                                        </span>

                                        <!-- Yearly details -->
                                        <span
                                            class="text-4xl tracking-tight text-primary dark:text-accent-light mt-5 yearly-details"
                                            data-package-id="{{ $package->id }}">
                                            {{ $package->packageDetails->Price_annually }}
                                            <span>/Year</span>
                                        </span>
                                    </div>


                                    <div class="mt-8 space-y-4 text-left">

                                        <div class="flex items-start space-x-3 monthly-details">
                                            <div
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" />
                                                </svg>
                                            </div>
                                            <span class="font-medium">Monthly Storage:
                                                {{ $package->packageDetails->storage_monthly }}</span>
                                        </div>

                                        <div class="flex items-start space-x-3 yearly-details">
                                            <div
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-6V7h2v4h4v2z" />
                                                </svg>
                                            </div>
                                            <span class="font-medium">Annual Storage:
                                                {{ $package->packageDetails->storage_annually }}</span>
                                        </div>

                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium">Interactive Archives:
                                                {{ $package->packageDetails->interactive_archives }}</span>
                                        </div>
                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium">Custom Branding:
                                                {{ $package->packageDetails->custom_branding }}</span>
                                        </div>
                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium">Messages:
                                                {{ $package->packageDetails->messages }}</span>
                                        </div>
                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-warning/10 text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium">Number of Users:
                                                {{ $package->packageDetails->num_users }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-8">
                                        <span>
                                            <div class="flex justify-between items-center space-x-2">

                                                <button data-toggle="modal" data-target="#modal2"
                                                    class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary/90
                                                dark:bg-accent dark:text-navy-50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90
                                                h-8 w-8 p-0">
                                                    <i class="fa fa-undo"></i>
                                                </button>



                                                {{-- Button positioned on the right --}}
                                                <button data-toggle="modal" data-target="#modal1"
                                                    class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>

                                                <div class="modal fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                                    id="modal1" role="dialog">
                                                    <div class="modal-overlay absolute inset-0 bg-slate-900/60"></div>
                                                    <div
                                                        class="modal-content scrollbar-sm relative flex max-w-lg flex-col items-center overflow-y-auto rounded-lg bg-white px-4 py-10 text-center dark:bg-navy-700 sm:px-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="inline h-28 w-28 shrink-0 text-success" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>

                                                        <div class="mt-4">
                                                            <h2 class="text-2xl text-slate-700 dark:text-navy-100">
                                                                Confirmed Delete</h2>
                                                            <p class="mt-2">Are you sure you want to delete this item?
                                                            </p>
                                                            @can('packages-forceDelete')
                                                                <form
                                                                    action="{{ route('packages.forceDelete', $package->id) }}"
                                                                    method="POST">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button data-close-modal=""
                                                                        class="btn mt-6 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                                                                        submit
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                                    id="modal2" role="dialog">
                                                    <div class="modal-overlay absolute inset-0 bg-slate-900/60"></div>
                                                    <div
                                                        class="modal-content scrollbar-sm relative flex max-w-lg flex-col items-center overflow-y-auto rounded-lg bg-white px-4 py-10 text-center dark:bg-navy-700 sm:px-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="inline h-28 w-28 shrink-0 text-success" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>

                                                        <div class="mt-4">
                                                            <h2 class="text-2xl text-slate-700 dark:text-navy-100">
                                                                Confirmed Restore</h2>
                                                            <p class="mt-2">Are you sure you want to delete this item?
                                                            </p>
                                                            @can('packages-restore')
                                                                <form action="{{ route('packages.restore', $package->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button data-close-modal=""
                                                                        class="btn mt-6 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                                                                        Restore
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </div>


                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- ------------------------------ends of cards --}}
                </div>
            </div>
        </div>
    </main>



@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.yearly-details').hide();

            $('.form-switch input[type="checkbox"]').change(function() {
                let packageId = $(this).data('package-id');
                let $card = $('#package-' + packageId);

                if ($(this).is(':checked')) {
                    $card.find('.monthly-details').hide();
                    $card.find('.yearly-details').show();
                } else {
                    $card.find('.yearly-details').hide();
                    $card.find('.monthly-details').show();
                }
            });
        });
    </script>
@endpush
