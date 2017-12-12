<?php

namespace AppBundle\Controller;

use AppBundle\Document\Ticket;
use AppBundle\Document\User;
use AppBundle\Form\Type\LoginType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(Request $request)
    {
        return $this->render(':default:index.html.twig');
    }

    /**
     * @Route("/search", name="search")
     */

    public function showSearchAction(Request $request)
    {
        return $this->render(':default:search-window.html.twig');

    }


    /**
     * @Route("/user", name="user_create")
     */

    public function userAction(Request $request)
    {
        $user = new User();
        $user->setPassword('abdou macy');
        $user->setEmail("macyjohn@test.com");
        $user->setEnabled(true);

        $ticket = new Ticket();
        $ticket->setShop('anvers');
        $ticket->setPrintTime('1-10-2017');
        $ticket->setCreatedAt('04-02-2017');
        $ticket->setUpdatedAt('22-11-2017');
        $ticket->setUserId($user);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($user);
        $dm->persist($ticket);

        $dm->flush();
        //console.log($user->getId());
        return new Response(
            'Saved new ticket with id: ' . $ticket->getMd5sum()
            . ' and new user with id: ' . $user->getPublicId()
        );
    }


    /**
     * @Route("/ticket", name="ticket_create")
     */

    public function ticketAction(Request $request)
    {
        $user = new User();
        $user->setPassword('Paulvergnas');
        $user->setEmail("paul@test.com");
        $user->setEnabled(true);

        $ticket = new Ticket();
        $ticket->setShop('lorient');
        $ticket->setPrintTime('21-11-2017');
        $ticket->setCreatedAt('21-11-2017');
        $ticket->setCreatedAt('21-11-2017');
        $ticket->setUserId($user);


        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($ticket);
        $dm->flush();
        //console.log($user->getId());
        return new Response('Created ticket id' . $ticket->getMd5sum());
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(LoginType::class);

        return $this->render(':default:Search.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("searchMe", name="handleSearch")
     * @param Request $request
     */
    public function handleSearch(Request $request, SessionInterface $session)
    {

        $session = new Session();

        $form = $this->createForm(LoginType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $data = $form->getData();

            $userId = $data["userId"];
            $refFact = $data["refFact"];

            $user = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:User')
                ->find($userId);


            $ticket = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:Ticket')
                ->findOneBy(array('md5sum' => $refFact, 'userId' => $userId));

            if ($user && $ticket) {

                $sessionId = $session->set('userid', $userId);
                // var_dump($session->get('userid'));

                $listTicket = $this->get('doctrine_mongodb')
                    ->getRepository('AppBundle:Ticket')
                    ->findBy(['userId' => $sessionId]);

                //var_dump($listTicket); die;
                return $this->render(':default:result.html.twig', array(
                    'TicketOne' => $ticket,
                    'tickets' => $listTicket,
                    'sessionId' => $sessionId

                ));

            } else {


                return $this->render(':default:Search.html.twig', array(
                    'form' => $form->createView(),
                ));
            }

        }
    }

    /**
     * @Route("/ticket/{ticket_id}", name="ticket-show")
     */
    public function showTicketAction($ticket_id)
    {
        $sessionId = $this->get('session')->get('userid');

        $ticket = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Ticket')
            ->findOneBy(array('md5sum' => $ticket_id));

        return $this->render(':default:show-ticket.html.twig', array(
            'ticket' => $ticket,
            'sessionId' => $sessionId

        ));


    }

    /**
     * @Route("/list-tickets/", name="listTickets")
     *
     */
    public function listTicketsAction()
    {
        $sessionId = $this->get('session')->get('userid');
        $tickets = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:Ticket')
            ->findBy(array('userId' => $sessionId));
        return $this->render(':default:liste-tickets.html.twig', array(
            'tickets' => $tickets,
            'sessionId' => $sessionId
        ));


    }

    /**
     * @Route("/decouvrir-digicket", name="digicket")
     *
     */

    public function digicketAction(Request $request)
    {
        return $this->render(':default:digicket.html.twig');

    }

}