<?php

function actives($path)
{
    // return request()->path() == request()->is($path) ? 'active' : '';
    if (request()->url() === url($path)) {
        return 'nav-link active';
    } else {
        return 'nav-link';
    }
}
