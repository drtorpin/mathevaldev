<?php
namespace drtorpin\MathEval\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    public function index()
    {
        return new Response('Hello, World 1!');
    }
}