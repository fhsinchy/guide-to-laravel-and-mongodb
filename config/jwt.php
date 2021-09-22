<?php

return [
    'secret' => env('JWT_SECRET', 'secret'),
    'algorithms' => ['HS256'],
];
