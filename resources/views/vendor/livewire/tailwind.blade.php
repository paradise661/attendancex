@if ($paginator->hasPages())
    <div class="box-footer border-topacity-0">
        <div class="flex items-center">
            <div>
                Showing {{ $paginator->count() }} Entries
                <i class="bi bi-arrow-right ms-2 font-semibold"></i>
            </div>
            <div class="ms-auto">
                <nav class="pagination-style-4" aria-label="Page navigation">
                    <ul class="ti-pagination mb-0">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript:void(0);">Prev</a>
                            </li>
                        @else
                            <li class="page-item">
                                <button class="page-link" wire:click="previousPage" wire:loading.attr="disabled">
                                    Prev
                                </button>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled">
                                    <a class="page-link" href="javascript:void(0);">{{ $element }}</a>
                                </li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item">
                                            <a class="page-link active"
                                                href="javascript:void(0);">{{ $page }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <button class="page-link" wire:click="gotoPage({{ $page }})">
                                                {{ $page }}
                                            </button>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <button class="page-link text-primary" wire:click="nextPage"
                                    wire:loading.attr="disabled">
                                    Next
                                </button>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript:void(0);">Next</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif
