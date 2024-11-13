@extends('dashboard.layouts.master')

@section('title', 'Profile')

@push('style')
@endpush

@section('main')

    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Profile
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('homePage') }}">home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Update Profile</li>
            </ul>
        </div>

        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 sm:col-span-12">
                <div class="card p-4 sm:p-5">

                    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                        update profile
                    </p>
                    <br>
                    @include('dashboard.partials._session')

                    <form action="{{ route('profile_update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mt-4 space-y-4">

                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <label class="block">
                                <span>Name</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Your Name" name="name" value="{{ $user->name }}" type="text">
                                </span>
                            </label>
                            @error('name')
                                <span class="text-tiny+ text-error">{{ $message }}</span>
                            @enderror


                            <label class="block">
                                <span>Email</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Your Email" name="email" value="{{ $user->email }}" type="text">
                                </span>
                            </label>
                            @error('email')
                                <span class="text-tiny+ text-error">{{ $message }}</span>
                            @enderror

                            <label class="block">
                                <span>New Password</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter New Password" name="password" type="text">
                                </span>
                            </label>
                            @error('password')
                                <span class="text-tiny+ text-error">{{ $message }}</span>
                            @enderror

                            <label class="block">
                                <span>confirm Password</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter confirmed Password" name="password_confirmation" type="text">
                                </span>
                            </label>
                            @error('password_confirmation')
                                <span class="text-tiny+ text-error">{{ $message }}</span>
                            @enderror

                            <label
                                class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                <input tabindex="-1" type="file" name="image" onchange="previewImage(this)"
                                    class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <span>Choose Image</span>
                                </div>
                            </label>
                            <div>
                                <img id="imagePreview" src="{{ $user->image_with_full_path }}" alt="Current Image"
                                    style="max-width: 150px;">
                            </div>
                            @error('image')
                                <span class="text-tiny+ text-error">{{ $message }}</span>
                            @enderror

                            <div class="flex justify-end space-x-2">
                                <button type="submit"
                                    class="btn border border-success font-medium text-success hover:bg-success hover:text-white focus:bg-success focus:text-white active:bg-success/90">
                                    Update
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endpush
