<?php


$importantLink = app('Pmis\Eloquent\ImportantLink');

$links = $importantLink->where('link_status',1)->get();
?>

<ul class="list-group population-clock">
    @foreach($links as $link)
        <li class="list-group-item">
                <a href="{{ $link->url }}">{{ $link->organization_name }}</a>

        </li>
    @endforeach
</ul>