<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChannelLogController extends AbstractController
{
    #[Route('/channel/log', name: 'app_channel_log')]
    public function index(): Response
    {
        return $this->render('channel_log/index.html.twig', [
            'controller_name' => 'ChannelLogController',
        ]);
    }
}
