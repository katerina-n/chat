<?php
declare(strict_types=1);
namespace AppBundle\Controller;

use ApiBundle\Model\ApiModel;
use AppBundle\Entity\Chat;
use AppBundle\Entity\ChatMessages;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Model\Form;
use AppBundle\Form\PostType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use AppBundle\Service\ChatService;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function indexAction(Request $request)
    {
        $session = $this->get('session');
        $post = new Form();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $pagination = [];

        if (!empty($session->get('message'))) {
            $message = $session->get('message');
            /*$pagination= $this->get('knp_paginator')->paginate(
               $message,
               $request->query->getInt('page', $page ),
               5
           );*/
            $pagination =
                $this
                    ->get('app.service.chat_service')
                    ->outputChatWithPagination(
                        $message,
                        (int) $request->get('page', 1)
                    );

            // ne verno
            // $session->set('message', null);
        }


        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $searchChat = $this->container->get('api.service.chat');
            $message = $searchChat->requestSend($task, $this->generateUrl(
                'app_default_api_chat',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL),
                [$task->getDateFirst(), $task->getDateLast()]
            );


            foreach ($message as $value){

                $messageChat[]=$value->getChat();
            }
            $session->set('startdate', $task->getDateFirst());
            $session->set('lastdate', $task->getDateLast());
            $session->set('message', $message);
            /*$paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $message,
                $request->query->getInt('page', $page),
                5
            );*/

            $pagination = $this->get('app.service.chat_service')->outputChatWithPagination(
                $message,
                (int)$request->get('page')
            );
            $save = $this->container->get('app.service.chat_service')->saveinDatebase($message);

        }

        $id = ($request->get('id') !== null)?$request->get('id'):1000;

        $page = $request->get('page');

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'message' => $pagination,
            'id' => $id,
            'page' => $page

        ]);

    }



}
