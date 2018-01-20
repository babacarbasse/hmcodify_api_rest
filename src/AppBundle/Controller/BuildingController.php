<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Building;
use AppBundle\Form\BuildingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;


class BuildingController extends Controller {

    /**
     * @ApiDoc(
     *    section = "Building",
     *    description="Create a new building",
     *    input={
     *      "class" = "AppBundle\Form\BuildingType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Building",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Building::class, "groups"={}},
     *         400 = {"class"=BuildingType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"building"})
     * @Rest\Post("/buildings")
     */
    public function postBuildingAction(Request $request) {
        $building = new Building();
        $form = $this->createForm(BuildingType::class, $building);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
            return $building;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "Building",
     *    description="Return the list of all the building"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"building"})
     * @Rest\Get("/buildings")
     */
    public function getBuildingsAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        return $orm->getRepository('AppBundle:Building')->findAll();
    }

    /**
     * @ApiDoc(
     *    section = "Building",
     *    description="Finds and displays a building entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"building"})
     * @Rest\Get("/buildings/{id}")
     */
    public function getBuildingAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        return $orm->getRepository('AppBundle:Building')->findOneBy(
            array("id" => $request->get('id'))
        );
    }

    /**
     * @ApiDoc(
     *    section = "Building",
     *    description="Remove a building"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"building"})
     * @Rest\Delete("/buildings/{id}")
     */
    public function removeBuildingAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        $building = $orm->getRepository('AppBundle:Building')->findOneBy(
            array("id" => $request->get('id'))
        );
        $orm->remove($building);
        $orm->flush();
        return;
    }

}
