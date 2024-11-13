@extends('dashboard.layouts.master')

@section('title', 'Update Setting')

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
                <li>update Setting</li>
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
                            {{-- <i class="fa-solid fa-layer-group"></i> --}}
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            Setting
                        </h4>

                    </div>
                </div>
                @can('settings-edit')
                    <form action="{{ route('settings.update', 1) }}" method="POST" enctype="multipart/form-data" id="identifier">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 p-4 sm:p-5">
                        <label class="block">
                            <span>Email</span>

                            <input name="email"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter Title" type="text" value="{{ $settings->email }}">
                        </label>
                        @error('email')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Logo</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this)" tabindex="-1" type="file" name="image"
                                class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>


                        <div>
                            <img id="imagePreview" src="{{ $settings->imageWithFullPath }}" alt="Current Image"
                                style="max-width: 150px;">
                        </div>
                        @error('image')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <br> <br>
                        <hr> <br> <br>

                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Setting Social Links
                        </p>

                        <div class="grid grid-cols-2 gap-4">
                        <label class="block">
                            <span>facebook link</span>

                            <input name="facebook_link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter facebook link" type="text" value="{{ $settings->facebook_link }}">
                        </label>
                        @error('facebook_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>twitter link</span>

                            <input name="twitter_link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter twitter link" type="text" value="{{ $settings->twitter_link }}">
                        </label>
                        @error('twitter_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>whatsapp_link</span>

                            <input name="whatsapp_link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter whatsapp_link" type="text" value="{{ $settings->whatsapp_link }}">
                        </label>
                        @error('whatsapp_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>pinterest link</span>

                            <input name="pinterest_link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter pinterest link" type="text" value="{{ $settings->pinterest_link }}">
                        </label>
                        @error('pinterest_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>youtube_link</span>

                            <input name="youtube link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter youtube link" type="text" value="{{ $settings->youtube_link }}">
                        </label>
                        @error('youtube_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>instagram link</span>

                            <input name="instagram_link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter instagram link" type="text" value="{{ $settings->instagram_link }}">
                        </label>
                        @error('instagram_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>reddit link</span>

                            <input name="reddit_link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter reddit link" type="text" value="{{ $settings->reddit_link }}">
                        </label>
                        @error('reddit_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>linkedin link</span>

                            <input name="linkedin_link"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter linkedin link" type="text" value="{{ $settings->linkedin_link }}">
                        </label>
                        @error('linkedin_link')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror
                        </div>
                        <br> <br>
                        <hr> <br> <br>

                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Setting Othors
                        </p>

                        <label class="block">
                            <span>copyright</span>

                            <input name="copyright"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter copyright" type="text" value="{{ $settings->copyright }}">
                        </label>
                        @error('copyright')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Address</span>

                            <input name="address"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter address" type="text" value="{{ $settings->address }}">
                        </label>
                        @error('address')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>Phone Number</span>

                            <input name="phone"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter phone" type="text" value="{{ $settings->phone }}">
                        </label>
                        @error('phone')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Description Footer </span>
                        </label>
                        <div class="w-full">
                            <div id="editor2" class="h-48"></div>
                        </div>
                        <textarea id="descOne" name="desc" style="display: none;"></textarea>

                        @error('desc')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Footer Image</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewTeamImage(this)" tabindex="-1" type="file" name="footer_image"
                                class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>


                        <div>
                            <img id="imagePreviewTeam" src="{{ $settings->footerImageWithFullPath }}"
                                alt="Current Image" style="max-width: 150px;">
                        </div>
                        @error('footer_image')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror




                    <div class="flex justify-end space-x-2">
                        <button type="submit"
                            class="btn space-x-2 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>Update</span>
                        </button>
                        </a>
                    </div>
            </div>
            </form>
                @endcan

    </main>

@endsection

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        // Configuration for editor 2
        const config2 = {
            modules: {
                toolbar: [
                    ["bold", "italic", "underline", "strike"], // toggled buttons
                    ["blockquote", "code-block"],
                    [{
                        header: 1
                    }, {
                        header: 2
                    }], // custom button values
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }],
                    [{
                        script: "sub"
                    }, {
                        script: "super"
                    }], // superscript/subscript
                    [{
                        indent: "-1"
                    }, {
                        indent: "+1"
                    }], // outdent/indent
                    [{
                        direction: "rtl"
                    }], // text direction
                    [{
                        size: ["small", false, "large", "huge"]
                    }], // custom dropdown
                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        color: []
                    }, {
                        background: []
                    }], // dropdown with defaults from theme
                    [{
                        font: []
                    }],
                    [{
                        align: []
                    }],
                    ["clean"], // remove formatting button
                ],

            },
            placeholder: "Enter your content...",
            theme: "snow",


        };

        const editor2 = document.querySelector("#editor2");
        const quill2 = new Quill(editor2, config2);

        // Get the value you want to set in the editor
        const descOne = {!! json_encode($settings->desc) !!};

        // Set the value of the editor
        quill2.root.innerHTML = descOne;

        // Attach event listener and update hidden input
        quill2.on("text-change", function() {
            document.getElementById("descOne").value = quill2.root.innerHTML;
        });
    </script>

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

        function previewTeamImage(input) {
            var preview = document.getElementById('imagePreviewTeam');
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
