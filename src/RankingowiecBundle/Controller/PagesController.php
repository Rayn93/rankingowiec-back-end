<?php

namespace RankingowiecBundle\Controller;

use RankingowiecBundle\Form\Type\ContactFormType;
use RankingowiecBundle\RankingowiecBundle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PagesController extends Controller
{
    /**
     * @Route(
     *     "/kontakt",
     *      name="contact_page"
     * )
     *
     * @Template()
     */
    public function contactAction(Request $request){
        
        $PageRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Page');
        $Page = $PageRepo->findOneBySlug('kontakt');

        if($Page === NULL){
            throw $this->createNotFoundException('Taka strona nie istnieje');
        }


        //Rendering a contact form
        $contactForm = $this->createForm(ContactFormType::class);

        if ($request->isMethod('POST')) {
            $contactForm->handleRequest($request);

            if ($contactForm->isSubmitted() && $contactForm->isValid()) {

                $name = $contactForm->getData()['name'];
                $email = $contactForm->getData()['email'];
                $message = $contactForm->getData()['message'];

                $this->sendMails($name, $email, $message);
                $this->get('session')->getFlashBag()->add('success', 'Dziękuję! Twoja wiadomość została wysłana. Odpiszemy tak szybko jak to tylko możliwe');
                return $this->redirect($this->generateUrl('contact_page').'#');
            }
            else{
                $this->get('session')->getFlashBag()->add('fail', 'Nie udało się wysłać wiadomości. Sprawdź wszystkie pola formularza. Wszystkie pola są wymagane');
                return $this->redirect($this->generateUrl('contact_page').'#');
            }
        }

        return array(
            'Page' => $Page,
            'contactForm' => $contactForm->createView()
        );
    }


    /**
     * @Route(
     *     "/{slug}",
     *      name="static_page"
     * )
     * @Template("RankingowiecBundle:Pages:staticPage.html.twig")
     */
    public function staticPageAction($slug){

        $PageRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Page');
        $Page = $PageRepo->findOneBySlug($slug);

        if($Page === NULL){
            throw $this->createNotFoundException('Taka strona nie istnieje');
        }

        return array(
            'Page' => $Page
        );
        
    }


    //######################################################################################################

    //Message from contact form for main page
    private function sendMails($name, $email, $message)
    {
        $mailToMe = (new \Swift_Message())
            ->setSubject('Wiadomość ze strony rankingowe.pl | Rankingi o wszystkim i o wszystkich')
            ->setFrom($email)
            ->setTo('rankingowe.pl@gmail.com')
            ->setBody(
                $this->renderView(
                    'RankingowiecBundle:Mail:contactFormMail.html.twig',
                    array(
                        'name' => $name,
                        'message' => $message
                    )
                ),
                'text/html'
            )
        ;

        $mailToVisitor = (new \Swift_Message())
            ->setSubject('Poprawne wysłanie mail-a | Rankingowe.pl')
            ->setFrom('rankingowe.pl@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'RankingowiecBundle:Mail:contactFormMailToVisitor.html.twig',
                    array(
                        'name' => $name,
                        'email' => $email
                    )
                ),
                'text/html'
            )
        ;

        $this->get('mailer')->send($mailToMe);
        $this->get('mailer')->send($mailToVisitor);
    }




}
