<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Corridor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * Corridor controller.
 *
 * @Route("corridor")
 */
class CorridorController extends Controller
{
    /**
     * Lists all corridor entities.
     *
     * @Route("/", name="corridor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $corridors = $em->getRepository('AppBundle:Corridor')->findAll();

        return $this->render('corridor/index.html.twig', array(
            'corridors' => $corridors,
        ));
    }

    /**
     * Creates a new corridor entity.
     *
     * @Route("/new", name="corridor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $corridor = new Corridor();
        $form = $this->createForm('AppBundle\Form\CorridorType', $corridor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($corridor);
            $em->flush();

            return $this->redirectToRoute('corridor_show', array('id' => $corridor->getId()));
        }

        return $this->render('corridor/new.html.twig', array(
            'corridor' => $corridor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a corridor entity.
     *
     * @Route("/{id}", name="corridor_show")
     * @Method("GET")
     */
    public function showAction(Corridor $corridor)
    {
        $deleteForm = $this->createDeleteForm($corridor);

        return $this->render('corridor/show.html.twig', array(
            'corridor' => $corridor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing corridor entity.
     *
     * @Route("/{id}/edit", name="corridor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Corridor $corridor)
    {
        $deleteForm = $this->createDeleteForm($corridor);
        $editForm = $this->createForm('AppBundle\Form\CorridorType', $corridor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('corridor_edit', array('id' => $corridor->getId()));
        }

        return $this->render('corridor/edit.html.twig', array(
            'corridor' => $corridor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a corridor entity.
     *
     * @Route("/{id}", name="corridor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Corridor $corridor)
    {
        $form = $this->createDeleteForm($corridor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($corridor);
            $em->flush();
        }

        return $this->redirectToRoute('corridor_index');
    }

    /**
     * Creates a form to delete a corridor entity.
     *
     * @param Corridor $corridor The corridor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Corridor $corridor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('corridor_delete', array('id' => $corridor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
