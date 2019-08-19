<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Entity\Adress;
use App\Service\Myservice;
use App\Entity\UserSecurity;
use App\Form\UserRegisterType;
use App\Event\VideoCreatedEvent;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController
{

    private $dispatcher;

     public function __construct(EventDispatcherInterface $dispatcher)
     {
         $this->dispatcher=$dispatcher;
     }
    
    /**
     * @Route("/home", name="home")
     */
    public function index(Myservice $service)
    {

        $adress=$this->getDoctrine()->getRepository(Adress::class)->find(1);

        $videoevent=new VideoCreatedEvent($adress);

        //$this->dispatcher->dispatch('bonjour',$videoevent);
        
/*
         $objectmanager=$this->getDoctrine()->getManager();

         $adress=$this->getDoctrine()->getRepository(Adress::class)->find(1);
         

         $user =new User;

         $user->setAdress($adress);
         $user->setName('montassar');

         $objectmanager->persist($user);

         $objectmanager->flush();

         */
            
   /*
          for ($i=0; $i < 3 ; $i++) { 
             
             $video=new Video;
             $video->setTitle('romance');

             $video->setUser($user);
             $objectmanager->persist($video);
          }
        */

         //$objectmanager->remove($user);
         //$objectmanager->flush();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("blog/{page?}",name="blog_list",requirements={"page"="\d+"})
     */

     public function index2(SessionInterface $session,Request $request)
     {

         $session->set('name','session value');

         $session->remove('name');

          if($session->has('name'))
          {
              exit($session->get('name'));
          }
 


         // exit($request->query->get('page'));

        /*
           $cookie=new Cookie(
               'my_cookie',
               'cookie value',
                time()+(2*60*60)
           );


          $res=new Response;

          $res->headers->setCookie($cookie);
          
           $res->send();

           */

          $res=new Response;

          $res->headers->clearCookie('my_cookie');
          
           $res->send();

           return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
     }

     /**
      * @Route("/generate-url/{param?}",name="generate-url")
      */

      public function generate_url($param)
      {
          exit($this->generateUrl(
               'generate-url',
                ['param'=>$param]
          ));
      }

      /**
       * @Route("/download")
       */
      public function dowload(){

          $path=$this->getParameter('download_directory');

          return $this->file($path.'file.pdf');
      }


      /**
       * @Route("/register")
       */

       public function register(Request $request,UserPasswordEncoderInterface $encoder,ObjectManager $manager){

         
        $adress=$this->getDoctrine()->getRepository(Adress::class)->find(1);

        $videoevent=new VideoCreatedEvent($adress);

        $this->dispatcher->dispatch('bonjour',$videoevent);


          $userSecurity=new UserSecurity;

          $form=$this->createForm(UserRegisterType::class);

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid())
          {

            //dump($form->get('password')->getData());
             
            $userSecurity->setEmail('montasar.hermi@gmail.com');
            $userSecurity->setRoles(['ROLE_USER']);

          
            $pass=$encoder->encodePassword($userSecurity, $form->get('password')->getData());

            $userSecurity->setPassword($pass);
           
            $manager->persist($userSecurity);
            $manager->flush();

            
             
            

          }
          
          return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'form'=>$form->createView()
        ]);
       }

      /**
       * Undocumented function
       *
       * @Route("/login",name="login")
       */
       public function login(AuthenticationUtils $authenticationUtils)
       {

        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);


       }

       /**
        * @Route("/test",name="test")
        */

        public function test(){

            return $this->render("test.html.twig");
        }


        /**
         * @Route("logout",name="logout")
         */

        public function logout(){


        }


        /**
         * @Route("logout_test",name="logout_test")
         */

        public function logout_test(){

            $reponse=new Response("you are logout");

            return $reponse;
        }


        /**
         * @Route("/fr",name="test_trast")
         */

        public function test_trast(){

            return $this->render('test.html.twig');
        }
}
