<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class MathEvalController
{
    public function index()
    {
        return new Response('Hello, World!');
    }
}