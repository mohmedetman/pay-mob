<?php

namespace App\Http\Controllers;

use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }
}
