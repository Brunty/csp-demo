<?php

return [
    'csp' => "default-src 'none'; img-src 'self'; style-src 'self' '{{ nonce }}' https://*.googleapis.com; font-src https://*.gstatic.com; script-src 'self' '{{ nonce }}';"
];
