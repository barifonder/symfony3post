<?php

namespace AppBundle\Controller;


use AppBundle\Service\MathService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\createView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/math")
     * 
     */
    public function operation()    
    {               
        $em = new MathService();
        $math = $em->addition(10,20);
        return $this->render('default/test.html.twig',['math'=>$math]);
    }


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('adminBundle:Post')->findBy([],['datepublish'=>'desc'],3,0);
        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function blogAction(Request $request)
    {
        // replace this example code with whatever you need
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('adminBundle:Post')->findBy([],['datepublish'=>'desc'],3,0);
        return $this->render('default/blog.html.twig', [
            'posts' => $posts,
        ]);
    }

     /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function showAction(Request $request,$id)
    {
        // replace this example code with whatever you need
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('adminBundle:Post')->find($id);
        return $this->render('default/show.html.twig', [
            'post' => $post,
        ]);
    }

     /**
     * @Route("/contact", name="contact")
     * @Method({"GET","POST"})
     */
    public function contactAction(Request $request)
    {
        // replace this example code with whatever you need

        $form = $this->createFormBuilder()
                     ->add('from')
                     ->add('subject')
                     ->add('body',TextareaType::class)
                     ->add('Send', SubmitType::class)
                     ->getForm();
        if($form->isSubmitted() && isValid())  {
            $data = $form->getData();
            $message = (new \Swift_Message($data['subject']))
                        ->setForm($data['from'])
                        ->setTo('rakiki.khalid@gmail.com')
                        ->setBody($data['body'],'text/plain');

                        $mailer->send($message);


        }                   
    
        return $this->render('default/contact.html.twig',['form'=>$form->createView()]);
    }

   

}
