<?php
namespace Sdz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sdz\BlogBundle\Entity\Enquiry;
use Sdz\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{
   public function aboutAction()
    {
        return $this->render('SdzBlogBundle:Page:about.html.twig');
    }
    
  public function contactAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);
    
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
    
            if ($form->isValid()) {
               $message = \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from symblog')
                    ->setFrom('enquiries@gmail.com')
                    ->setTo($this->container->getParameter('Sdz_blog.emails.contact_email'))
                    ->setBody($this->renderView('SdzBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);
        
                $this->get('session')->setFlash('Sdz-notice', 'Votre demande de contact a bien été envoyée. Merci!');
        
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page */
                return $this->redirect($this->generateUrl('SdzBlogBundle_contact'));
            }
        }
    
        return $this->render('SdzBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
      
      
    }
     
}