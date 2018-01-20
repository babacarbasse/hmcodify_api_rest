<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Position;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;


class PositionController extends Controller
{

    /**
     * @ApiDoc(
     *    section = "Position",
     *    description="Lists all position entities."
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"position"})
     * @Rest\Get("/positions")
     */
    public function getPositionsAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('AppBundle:Position')->findAll();

    }

    /**
     * @ApiDoc(
     *    section = "Position",
     *    description="Creates a new position entity.",
     *    input={
     *      "class" = "AppBundle\Form\PositionType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Position",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Position::class, "groups"={}},
     *         400 = {"class"=PositionType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"position"})
     * @Rest\Post("/positions")
     */
    public function postPositionAction(Request $request)
    {
        $position = new Position();
        $form = $this->createForm('AppBundle\Form\PositionType', $position);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($position);
            $em->flush();

            return $position;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "Position",
     *    description="Finds and displays a position entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"position"})
     * @Rest\Get("/positions/{id}")
     */
    public function getPositionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:Position')->findOneBy(
            array("id" => $request->get('id'))
        );
    }

    /**
     * @ApiDoc(
     *    section = "Position",
     *    description="Remove a position"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"position"})
     * @Rest\Delete("/positions/{id}")
     */
    public function removePositionAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        $position = $orm->getRepository('AppBundle:Position')->findOneBy(
            array("id" => $request->get('id'))
        );
        $orm->remove($position);
        $orm->flush();
        return;
    }


    /**
     * @ApiDoc(
     *    section = "Position",
     *    description="Update entity position",
     *    input={
     *      "class" = "AppBundle\Form\PositionType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Position",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Position::class, "groups"={}},
     *         400 = {"class"=PositionType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={})
     * @Rest\Put("/positions/{id}")
     */
    public function putPositionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Position')->findOneBy(
            array("id" => $request->get('id'))
        );

        if(empty($data)) {
            return $this->resourceNotFound();
        }

        $form = $this->createForm('AppBundle\Form\PositionType', $data, []);

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
