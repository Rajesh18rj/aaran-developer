<article
    class=" flex rounded-xl max-w-sm  flex-col overflow-hidden border border-slate-300
    bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
    <!-- Carousel -->
    <div class="h-48 md:h-64 overflow-hidden">
        <div x-data="{
            slides: [
                @foreach ($slides as $slide)
                    {
                        imgSrc: '{{ $slide['imgSrc'] }}',
                        imgAlt: '{{ $slide['imgSrc'] }}',
                    },
                @endforeach
            ],
            currentSlideIndex: 1,
            previous() {
                this.currentSlideIndex = this.currentSlideIndex > 1 ? this.currentSlideIndex - 1 : this.slides.length;
            },
            next() {
                this.currentSlideIndex = this.currentSlideIndex < this.slides.length ? this.currentSlideIndex + 1 : 1;
            },
        }" class="relative w-full overflow-hidden">

            <!-- Previous button -->

            <button type="button"
                    class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60"
                    aria-label="previous slide" x-on:click="previous()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                     stroke-width="3" class="size-5 md:size-6 pr-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                </svg>
            </button>

            <!-- Next button -->

            <button type="button"
                    class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60"
                    aria-label="next slide" x-on:click="next()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                     stroke-width="3" class="size-5 md:size-6 pl-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
            </button>

            <!-- Slides -->
            <div class="relative h-48 md:h-64 w-full">
                <template x-for="(slide, index) in slides">
                    <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                         x-transition.opacity.duration.300ms>
                        <img class="absolute w-full h-full inset-0 object-cover text-slate-700 dark:text-slate-300"
                             x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt"/>
                    </div>
                </template>
            </div>

        </div>
    </div>

    <!-- Content -->

    <div class="flex flex-col gap-4 p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row gap-4 md:gap-12 justify-between">

            <!-- Title -->

            <div class="flex">
                <h3 class="text-lg lg:text-xl font-bold text-black dark:text-white">{{ $title }}</h3>
            </div>

            <!-- Price -->
            <span
                class="bg-indigo-700 h-fit rounded-xl px-2 py-1 text-xs font-medium text-slate-100 dark:bg-indigo-600 dark:text-slate-100">
                {{$status }}
            </span>
        </div>

        <p id="nftDescription" class="text-pretty text-sm">
            To : <a href="#" class="text-blue-700 dark:text-blue-600">{{$allocated}}</a><span> - {{$priority}} </span> <br/><br/>
            {!!\Illuminate\Support\Str::words($description,20)!!} <br/><br/>
            By : <span>{{$createdBy}}</span>
        </p>

        <!-- Button -->
        <div class="flex gap-3 mt-2">

            <a href="{{$readMoer}}" type="button"
               class="flex cursor-pointer items-center justify-center gap-2 whitespace-nowrap bg-blue-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"
                     class="size-3.5">
                    <path fill-rule="evenodd"
                          d="M5 4a3 3 0 0 1 6 0v1h.643a1.5 1.5 0 0 1 1.492 1.35l.7 7A1.5 1.5 0 0 1 12.342 15H3.657a1.5 1.5 0 0 1-1.492-1.65l.7-7A1.5 1.5 0 0 1 4.357 5H5V4Zm4.5 0v1h-3V4a1.5 1.5 0 0 1 3 0Zm-3 3.75a.75.75 0 0 0-1.5 0v1a3 3 0 1 0 6 0v-1a.75.75 0 0 0-1.5 0v1a1.5 1.5 0 1 1-3 0v-1Z"
                          clip-rule="evenodd"/>
                </svg>
                Read More...
            </a>

            <x-button.edit wire:click="edit({{$id}})"/>
            <x-button.delete wire:click="getDelete({{$id}})"/>
        </div>
    </div>
</article>
