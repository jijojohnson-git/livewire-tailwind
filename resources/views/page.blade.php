<div>

    @if ($paginator->hasPages())

        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">

            <span>

                {{-- Previous Page Link --}}

                @if ($paginator->onFirstPage())
                    <span
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">

                        {!! __('pagination.previous') !!}

                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">

                        {!! __('pagination.previous') !!}

                    </button>
                @endif

            </span>

             {{-- Pagination Elements Start--}}
             @foreach ($elements as $element )

            <div class="flex">
            {{-- 3 Dots Seperator --}}
            @if (is_string($element))
                <li class="list-none page-item disabled d-none d-md-block" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

                {{-- ArrayOfLinks --}}
                @if (is_array($element))
                {{-- {{ dd($element) }} --}}
                    @foreach ($element as $page => $url)
                        @if($page == $paginator->currentPage())
                            <li wire:click='gotoPage({{ $page }})' class=" text-white list-none mx-2 w-10 px-2 py-1 text-center round border shadow bg-blue-500 cursor-pointer">{{ $page }}</li>
                        @else
                            <li wire:click='gotoPage({{ $page }})' class=" list-none mx-2 w-10 px-2 py-1 text-center round border shadow bg-white cursor-pointer">{{ $page }}</li>
                        @endif
                    @endforeach
                @endif
            </div>
            @endforeach

             {{-- Pagination Elements Ends --}}

            <span>

                {{-- Next Page Link --}}

                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">

                        {!! __('pagination.next') !!}

                    </button>
                @else
                    <span
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">

                        {!! __('pagination.next') !!}

                    </span>
                @endif

            </span>

        </nav>

    @endif

</div>
