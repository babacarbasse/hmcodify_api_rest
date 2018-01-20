<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Codification;
use AppBundle\Form\CodificationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;


class CodificationController extends Controller {

    /**
     * @ApiDoc(
     *    section = "Codification",
     *    description="Create a new codification",
     *    input={
     *      "class" = "AppBundle\Form\CodificationType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Codification",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Codification::class, "groups"={}},
     *         400 = {"class"=CodificationType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"codification"})
     * @Rest\Post("/codifications")
     */
    public function postCodificationAction(Request $request) {
        $codification = new Codification();
        $form = $this->createForm(CodificationType::class, $codification);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($codification);
            $em->flush();
            return $codification;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "Codification",
     *    description="Return the list of all the codification"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"codification"})
     * @Rest\Get("/codifications")
     */
    public function getCodificationsAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        return $orm->getRepository('AppBundle:Codification')->findAll();
    }

    /**
     * @ApiDoc(
     *    section = "Codification",
     *    description="Finds and displays a codification entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"codification"})
     * @Rest\Get("/codifications/{id}")
     */
    public function getCodificationAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        return $orm->getRepository('AppBundle:Codification')->findOneBy(
            array("id" => $request->get('id'))
        );
    }

    /**
     * @ApiDoc(
     *    section = "Codification",
     *    description="Remove a codification"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"codification"})
     * @Rest\Delete("/codifications/{id}")
     */
    public function removeCodificationAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        $codification = $orm->getRepository('AppBundle:Codification')->findOneBy(
            array("id" => $request->get('id'))
        );
        $orm->remove($codification);
        $orm->flush();
        return;
    }


    /**
     * @ApiDoc(
     *    section = "Codification",
     *    description="Update entity codification",
     *    input={
     *      "class" = "AppBundle\Form\CodificationType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Codification",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Codification::class, "groups"={}},
     *         400 = {"class"=CodificationType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={})
     * @Rest\Put("/codifications/{id}")
     */
    public function putCodificationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Codification')->findOneBy(
            array("id" => $request->get('id'))
        );

        if(empty($data)) {
            return $this->resourceNotFound();
        }

        $form = $this->createForm('AppBundle\Form\CodificationType', $data, []);

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
