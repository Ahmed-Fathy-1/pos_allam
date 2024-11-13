@extends('dashboard.layouts.master')
@section('title', 'Edit Payment')

@push('style')
@endpush

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">AiTech</h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a href="{{ route('homePage') }}"
                       class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                        Home
                    </a>
                </li>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <li class="flex items-center space-x-2">
                    @can('payments-list')
                        <a href="{{ route('payments.index') }}"
                           class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                            Payments
                        </a>
                    @endcan
                </li>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <li>Edit Payment</li>
            </ul>
        </div>

        <div>@include('dashboard.partials._session')</div>

        <div class="col-span-12 grid lg:col-span-12">
            <h4 class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary
                                dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid fa-edit"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">Edit Payment</h4>
                    </div>
                </div>

                @can('payments-edit')
                    <form action="{{ route('payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                    @csrf
                    @method('PUT') <!-- Use PUT for updating resources -->
                    <h4 class="space-y-4 p-4 sm:p-5">


                        <label class="block">
                            <span>username</span>
                            <input name="name" type="text" maxlength="3"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent
                               px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary
                               dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    value="{{ old('name', $payment->user->name) }}">
                        </label>
                        @error('name')<span class="text-tiny+ text-error">{{ $message }}</span>@enderror
                        <label class="block">
                            <span>domain name</span>
                            <input name="domain_name" type="text" maxlength="3"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent
                               px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary
                               dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   value="{{ old('name', $payment->domain_name) }}">
                        </label>
                        @error('domain_name')<span class="text-tiny+ text-error">{{ $message }}</span>@enderror

                        <input type="hidden" name="user_id" value="{{ $payment->user_id }}">

                        <label class="block">
                            <span>Package</span>
                            <select name="package_id"
                                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2
                                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700
                                dark:hover:border-navy-400 dark:focus:border-accent">
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}"
                                        {{ $package->id == $payment->package_id ? 'selected' : '' }}>
                                        {{ $package->title }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        @error('package_id')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Amount</span>
                            <input name="amount" type="number" step="0.01"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent
                               px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary
                               dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Amount" value="{{ old('amount', $payment->amount) }}">
                        </label>
                        @error('amount')<span class="text-tiny+ text-error">{{ $message }}</span>@enderror

                        <label class="block">
                            <span>Currency</span>
                            <input name="currency" type="text" maxlength="3"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent
                               px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary
                               dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Currency (e.g., USD)" value="{{ old('currency', $payment->currency) }}">
                        </label>
                        @error('currency')<span class="text-tiny+ text-error">{{ $message }}</span>@enderror

                        <label class="block">
                            <span>status</span>
                            <select name="status"
                                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2
                                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700
                                dark:hover:border-navy-400 dark:focus:border-accent">
                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>
                                        pending
                                    </option>
                                    <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>
                                        completed
                                    </option>
                            </select>
                        </label>
                        @error('status')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                    class="btn space-x-2 bg-success font-medium text-white hover:bg-success-focus
                                focus:bg-success-focus active:bg-success-focus/90 dark:bg-accent dark:hover:bg-accent-focus
                                dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Update Payment</span>
                            </button>
                        </div>
                    </h4>
                </form>
                @endcan
            </h4>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const amountInput = document.querySelector('input[name="amount"]');
            if (parseFloat(amountInput.value) <= 0) {
                e.preventDefault();
                alert('Amount must be greater than 0.');
            }
        });
    </script>
@endpush
