<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Floor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;


class FloorController extends Controller
{

    /**
     * @ApiDoc(
     *    section = "Floor",
     *    description="Lists all floor entities."
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"floor"})
     * @Rest\Get("/floors")
     */
    public function getFloorsAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('AppBundle:Floor')->findAll();

    }

    /**
     * @ApiDoc(
     *    section = "Floor",
     *    description="Creates a new floor entity.",
     *    input={
     *      "class" = "AppBundle\Form\FloorType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Floor",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Floor::class, "groups"={}},
     *         400 = {"class"=FloorType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"floor"})
     * @Rest\Post("/floors")
     */
    public function postFloorAction(Request $request)
    {
        $floor = new Floor();
        $form = $this->createForm('AppBundle\Form\FloorType', $floor);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($floor);
            $em->flush();

            return $floor;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "Floor",
     *    description="Finds and displays a floor entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"floor"})
     * @Rest\Get("/floors/{id}")
     */
    public function getFloorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:Floor')->findOneBy(
            array("id" => $request->get('id'))
        );
    }

    /**
     * @ApiDoc(
     *    section = "Floor",
     *    description="Remove a floor"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"floor"})
     * @Rest\Delete("/floors/{id}")
     */
    public function removeFloorAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        $floor = $orm->getRepository('AppBundle:Floor')->findOneBy(
            array("id" => $request->get('id'))
        );
        $orm->remove($floor);
        $orm->flush();
        return;
    }


    /**
     * @ApiDoc(
     *    section = "Floor",
     *    description="Update entity floor",
     *    input={
     *      "class" = "AppBundle\Form\FloorType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Floor",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Floor::class, "groups"={}},
     *         400 = {"class"=FloorType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={})
     * @Rest\Put("/floors/{id}")
     */
    public function putFloorAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Floor')->findOneBy(
            array("id" => $request->get('id'))
        );

        if(empty($data)) {
            return $this->resourceNotFound();
        }

        $form = $this->createForm('AppBundle\Form\FloorType', $data, []);

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
