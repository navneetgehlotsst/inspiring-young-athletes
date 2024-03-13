<div class="float-left">
@php 
$total = $element->total();
        $currentPage = $element->currentPage();
        $perPage = $element->perPage();
        
        $from = ($currentPage - 1) * $perPage + 1;
        $to = min($currentPage * $perPage, $total);
        
        echo "Showing {$from} to {$to} of {$total} entries";
        @endphp
    </div>