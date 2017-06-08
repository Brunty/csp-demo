<?php

return [
    'csp' => "default-src 'none'; img-src 'self'; style-src 'self' '%1\$s' https://*.googleapis.com; font-src https://*.gstatic.com; script-src 'self' '%1\$s'; upgrade-insecure-requests;"
];
