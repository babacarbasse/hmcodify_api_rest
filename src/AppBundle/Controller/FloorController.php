<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Floor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Floor controller.
 *
 * @Route("floor")
 */
class FloorController extends Controller
{
    /**
     * Lists all floor entities.
     *
     * @Route("/", name="floor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $floors = $em->getRepository('AppBundle:Floor')->findAll();

        return $this->render('floor/index.html.twig', array(
            'floors' => $floors,
        ));
    }

    /**
     * Creates a new floor entity.
     *
     * @Route("/new", name="floor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $floor = new Floor();
        $form = $this->createForm('AppBundle\Form\FloorType', $floor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($floor);
            $em->flush();

            return $this->redirectToRoute('floor_show', array('id' => $floor->getId()));
        }

        return $this->render('floor/new.html.twig', array(
            'floor' => $floor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a floor entity.
     *
     * @Route("/{id}", name="floor_show")
     * @Method("GET")
     */
    public function showAction(Floor $floor)
    {
        $deleteForm = $this->createDeleteForm($floor);

        return $this->render('floor/show.html.twig', array(
            'floor' => $floor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing floor entity.
     *
     * @Route("/{id}/edit", name="floor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Floor $floor)
    {
        $deleteForm = $this->createDeleteForm($floor);
        $editForm = $this->createForm('AppBundle\Form\FloorType', $floor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('floor_edit', array('id' => $floor->getId()));
        }

        return $this->render('floor/edit.html.twig', array(
            'floor' => $floor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a floor entity.
     *
     * @Route("/{id}", name="floor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Floor $floor)
    {
        $form = $this->createDeleteForm($floor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($floor);
            $em->flush();
        }

        return $this->redirectToRoute('floor_index');
    }

    /**
     * Creates a form to delete a floor entity.
     *
     * @param Floor $floor The floor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Floor $floor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('floor_delete', array('id' => $floor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
