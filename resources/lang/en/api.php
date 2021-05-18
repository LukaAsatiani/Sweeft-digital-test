<?php

use GrahamCampbell\ResultType\Success;

return [
  'products' => [
    'get' => [
      'success' => 'Products list.',
      'empty' => 'Products list is empty.'
    ],
    'create' => [
      'success' => 'Product created.',
      'error' => 'Something went wrong!',
    ],
    'update' => [
      'success' => 'Product updated.',
      'error' => 'Something went wrong!',
      'same' => 'Nothing to update.'
    ],
    'delete' => [
      'success' => 'Product removed.',
      'error' => 'Something went wrong!'
    ],
    'find' => [
      'error' => 'Product not found.'
    ]
  ]
];