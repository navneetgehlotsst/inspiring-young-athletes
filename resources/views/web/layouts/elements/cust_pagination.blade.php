@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="cust_pagination float-right">
  
        
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="a page-item disabled"><a class="page-link" href="javascript:void(0);" aria-label="Previous">
                <i class="mdi mdi-chevron-left"></i></a></li>
                @else
                <li class="b page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="mdi mdi-chevron-left"></i></a></li>
                @endif
                
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                @foreach ($element as $page => $url)
                <!--  Use three dots when current page is greater than 4.  -->
                @if ($paginator->currentPage() > 4 && $page === 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
        
                <!--  Show active page else show the first and last two pages from current page.  -->
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
        
                <!--  Use three dots when current page is away from end.  -->
                @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endforeach
                @endforeach
                
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="f page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="mdi mdi-chevron-right"></i></a></li>
                @else
                <li class="g page-item disabled"><a class="page-link" href="javascript:void(0);" aria-label="Next"><i class="mdi mdi-chevron-right"></i></a></li>
        @endif
    </ul>
    </nav>
    @endif