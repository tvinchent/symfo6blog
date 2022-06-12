<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;

class HomeController extends AbstractController
{

    #[Route('/hello/{name}', name: 'hello_name')]
    public function name($name) : Response
    {
        return new Response ('Hello ' . $name . '!');
        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]);
    }

    #[Route('/', name: 'blog')]
    public function index(ManagerRegistry $doctrine) : Response
    {
        $posts = $doctrine->getRepository(Post::class)->findAll();

        return $this->render('home/index.html.twig', [
            'title' => 'A simple blog, but with symfo 6!',
            'posts' => $posts
        ]);
    }

    #[Route('/post/{id}', name: 'blogPost')]
    public function post(ManagerRegistry $doctrine, int $id) : Response
    {
        $post = $doctrine->getRepository(Post::class)->find($id);

        return $this->render('home/post.html.twig', [
            'title' => 'Detail of a post',
            'post' => $post
        ]);
    }
}

?>