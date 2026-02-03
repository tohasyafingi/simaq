<?php

return [
    'mimes' => 'The file must be a file of type: :values.',
    'max' => [
        'file' => 'The file must not be greater than :max kilobytes.',
    ],
    'custom' => [
        'newImage' => [
            'mimes' => 'Image must be one of: webp, jpg, jpeg, png, avif, svg, gif.',
            'max' => 'Image must be 5MB or smaller.',
        ],
        'img' => [
            'mimes' => 'Image must be one of: webp, jpg, jpeg, png, avif, svg, gif.',
            'max' => 'Image must be 5MB or smaller.',
        ],
        'newFile' => [
            'mimes' => 'File must be a PDF.',
            'max' => 'File must be 12MB or smaller.',
        ],
        'file' => [
            'mimes' => 'File must be a PDF.',
            'max' => 'File must be 12MB or smaller.',
        ],
    ],
];
