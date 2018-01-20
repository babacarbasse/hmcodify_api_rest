<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;


class RoomController extends Controller
{

    /**
     * @ApiDoc(
     *    section = "Room",
     *    description="Lists all room entities."
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"room"})
     * @Rest\Get("/rooms")
     */
    public function getRoomsAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('AppBundle:Room')->findAll();

    }

    /**
     * @ApiDoc(
     *    section = "Room",
     *    description="Creates a new room entity.",
     *    input={
     *      "class" = "AppBundle\Form\RoomType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Room",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Room::class, "groups"={}},
     *         400 = {"class"=RoomType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"room"})
     * @Rest\Post("/rooms")
     */
    public function postRoomAction(Request $request)
    {
        $room = new Room();
        $form = $this->createForm('AppBundle\Form\RoomType', $room);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();

            return $room;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "Room",
     *    description="Finds and displays a room entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"room"})
     * @Rest\Get("/rooms/{id}")
     */
    public function getRoomAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:Room')->findOneBy(
            array("id" => $request->get('id'))
        );
    }
}
