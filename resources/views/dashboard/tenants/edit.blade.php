@extends('dashboard.layouts.master')

@section('title', 'Update tenant')

@push('style')
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
                    @can('tenants-list')
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('tenants.index') }}">tenant List</a>
                    @endcan
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Update tenant</li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="col-span-12 grid lg:col-span-12">
            <div class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            tenant
                        </h4>

                    </div>
                </div>
                @can('tenants-edit')
                    <form action="{{ route('tenants.update', $tenants->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 p-4 sm:p-5">
                        <label class="block">
                            <span>tenant name </span>

                            <input name="name" value="{{ $tenants->name }}"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter name" type="text">
                        </label>
                        @error('name')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror
                        <br>
                        <label class="block">
                            <span>tenant email </span>

                            <input name="email" value="{{ $tenants->email }}"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter email" type="email">
                        </label>
                        @error('email')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror
                        <br>
                        <label class="block">
                            <span>tenant password </span>

                            <input name="password"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter password" type="password">
                        </label>
                        @error('password')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Confirm Password</span>

                            <input name="confirm-password"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter password" type="password">
                        </label>
                        @error('confirm-password')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Role:</span>
                            <select
                              multiple  name="roles[]"
                              class="form-multiselect mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                            >
                            @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                            </select>
                          </label>
                          @error('roles')
                          <span class="text-tiny+ text-error">{{ $message }}</span>
                      @enderror
                        <br>
                        <input type="file" name="image" id="">
                        @error('image')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <input type="hidden" name="id" value="{{$tenants->id}}">



                    <div class="flex justify-end space-x-2">
                        <button type="submit"
                            class="btn space-x-2 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>Update</span>
                        </button>
                    </div>
            </div>
            </form>
                @endcan
        </div>
        </div>

    </main>
@endsection

@push('scripts')


@endpush
