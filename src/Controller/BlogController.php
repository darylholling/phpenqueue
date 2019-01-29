<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'articles' => $this->getDoctrine()->getRepository(BlogPost::class)->findBy([], ['datetime' => 'DESC']),
        ]);
    }

    /**
     * @Route("/create", methods={"POST"}, name="blog_create")
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $blog = new BlogPost($request->request->get('title', 'title'));
        $blog->setCurrentPlace('draft');
        $blog->setContent($request->request->get('content', 'content'));
        $blog->setDatetime(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($blog);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_show', [
            'id' => $blog->getId()
        ]));
    }

    /**
     * @Route("/show/{id}", name="blog_show")
     * @param BlogPost $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(BlogPost $post)
    {
        return $this->render('blog/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/apply-transition/{id}", methods={"POST"}, name="blog_apply_transition")
     */
    public function applyTransition(Request $request, BlogPost $post, Registry $workflows)
    {
        $workflow = $workflows->get($post);
        try {
            $workflow->apply($post, $request->request->get('transition'));
            $this->getDoctrine()->getManager()->flush();
        } catch (\LogicException $e) {
            $this->addFlash('danger', sprintf('No, that did not work: %s', $e->getMessage()));
            $this->get('logger')->error('Yikes', ['error' => $e->getMessage()]);
        }
        $transitions = $workflow->getEnabledTransitions($post);

        return $this->redirect(
            $this->generateUrl('blog_show', [
                'id' => $post->getId(),
                'transition' => $transitions,
            ])
        );
    }

    /**
     * @Route("/reset-marking/{id}", methods={"POST"}, name="blog_reset_marking")
     * @param BlogPost $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function resetMarking(BlogPost $post)
    {
        $post->setCurrentPlace('draft');
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('blog_show', ['id' => $post->getId()]));
    }
}