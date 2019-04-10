<?php
  namespace App\Controller;

  use App\Entity\Role;

  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;


  class RoleController extends Controller{

    /**
    * @Route("/", name="role_list")
    * @Method({"GET"})
    */

    public function index(){
      // return new Response('<html><body>Hello World</body></html>');
      $data['module_name'] = "System Administration";
      $data['page_title'] = "Role List";
      $data['roles'] = $this->getDoctrine()->getRepository(Role::class)->findAll();
      return $this->render('roles/index.html.twig', $data);
    }

    /**
    * @Route("/role/new", name="new_role")
    * @Method({"GET","POST"})
    */
    public function new(Request $request)
    {
      $role = new Role();
      $form = $this->createFormBuilder($role)
                   ->add('roleName', TextType::class, array('label' => 'Name of Role', 'attr' => array('class' => 'form-control')))
                   ->add('description', TextareaType::class, array('required'=>'false', 'attr'=>array('class'=>'form-control')))
                   ->add('save', SubmitType::class, array('label'=>'Create', 'attr'=>array('class'=> 'btn btn-primary mt-3')))
                   ->getForm();
      $data['form'] = $form->createView();
      $data['module_name'] = "System Administration";
      $data['page_title'] = "Create New Role";

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
          $role = $form->getData();
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($role);
          $entityManager->flush();

          return $this->redirectToRoute('role_list');
      }

      return $this->render('roles/new.html.twig', $data);
    }

    /**
    * @Route("/role/edit/{id}", name="edit_role")
    * @Method({"GET","POST"})
    */
    public function edit(Request $request, $id)
    {
      $role = new Role();
      $role = $this->getDoctrine()->getRepository(Role::class)->find($id);

      $form = $this->createFormBuilder($role)
                   ->add('roleName', TextType::class, array('label' => 'Name of Role', 'attr' => array('class' => 'form-control')))
                   ->add('description', TextareaType::class, array('required'=>'false', 'attr'=>array('class'=>'form-control')))
                   ->add('save', SubmitType::class, array('label'=>'Create', 'attr'=>array('class'=> 'btn btn-primary mt-3')))
                   ->getForm();
      $data['form'] = $form->createView();
      $data['module_name'] = "System Administration";
      $data['page_title'] = "Edit Role Information";

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();

          return $this->redirectToRoute('role_list');
      }

      return $this->render('roles/edit.html.twig', $data);
    }

    /**
    * @Route("/role/{id}", name="role_show")
    */
    public function show($id){
      $data['module_name'] = "System Administration";
      $data['page_title'] = "Role Details";
      $data['role'] = $this->getDoctrine()->getRepository(Role::class)->find($id);
      return $this->render("roles/show.html.twig", $data);
    }

    /**
    * @Route("/role/delete/{id}")
    * @Method({"DELETE"})
    */
    public function delete(Request $request, $id)
    {
      $role = $this->getDoctrine()->getRepository(Role::class)->find($id);
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($role);
      $entityManager->flush();

      $response = new Response();
      $response->send();
    }

  }
