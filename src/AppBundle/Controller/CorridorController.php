<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Corridor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;

class CorridorController extends Controller
{

    /**
     * @ApiDoc(
     *    section = "Corridor",
     *    description="Lists all corridor entities."
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"corridor"})
     * @Rest\Get("/corridors")
     */
    public function getCorridorsAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $corridors = $em->getRepository('AppBundle:Corridor')->findAll();
    }

    /**
     * @ApiDoc(
     *    section = "Corridor",
     *    description="Creates a new corridor entity.",
     *    input={
     *      "class" = "AppBundle\Form\CorridorType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Corridor",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Corridor::class, "groups"={}},
     *         400 = {"class"=CorridorType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"corridor"})
     * @Rest\Post("/corridors")
     */
    public function postCorridorAction(Request $request)
    {
        $corridor = new Corridor();
        $form = $this->createForm('AppBundle\Form\CorridorType', $corridor);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($corridor);
            $em->flush();

            return $corridor;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "Corridor",
     *    description="Finds and displays a corridor entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"corridor"})
     * @Rest\Get("/corridors/{id}")
     */
    public function getCorridorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:Corridor')->findOneBy(
            array("id" => $request->get('id'))
        );
    }

    /**
     * @ApiDoc(
     *    section = "Corridor",
     *    description="Remove a corridor"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"corridor"})
     * @Rest\Delete("/corridors/{id}")
     */
    public function removeCorridorAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        $corridor = $orm->getRepository('AppBundle:Corridor')->findOneBy(
            array("id" => $request->get('id'))
        );
        $orm->remove($corridor);
        $orm->flush();
        return;
    }


    /**
     * @ApiDoc(
     *    section = "Corridor",
     *    description="Update entity corridor",
     *    input={
     *      "class" = "AppBundle\Form\CorridorType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Corridor",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Corridor::class, "groups"={}},
     *         400 = {"class"=CorridorType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={})
     * @Rest\Put("/corridors/{id}")
     */
    public function putCorridorAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Corridor')->findOneBy(
            array("id" => $request->get('id'))
        );

        if(empty($data)) {
            return $this->resourceNotFound();
        }

        $form = $this->createForm('AppBundle\Form\CorridorType', $data, []);

        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em->flush();
            return $data;
        } else {
            return $form;
        }
    }

    public function resourceNotFound() {
        return \FOS\RestBundle\View\View::create(['message' => 'Resource not found'], Response::HTTP_NOT_FOUND);
    }

}
