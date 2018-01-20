<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;


class StudentController extends Controller
{

    /**
     * @ApiDoc(
     *    section = "Student",
     *    description="Lists all student entities."
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"student"})
     * @Rest\Get("/students")
     */
    public function getStudentsAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('AppBundle:Student')->findAll();

    }

    /**
     * @ApiDoc(
     *    section = "Student",
     *    description="Creates a new student entity.",
     *    input={
     *      "class" = "AppBundle\Form\StudentType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "Student",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=Student::class, "groups"={}},
     *         400 = {"class"=StudentType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"student"})
     * @Rest\Post("/students")
     */
    public function postStudentAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm('AppBundle\Form\StudentType', $student);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $student;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "Student",
     *    description="Finds and displays a student entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"student"})
     * @Rest\Get("/students/{id}")
     */
    public function getStudentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:Student')->findOneBy(
            array("id" => $request->get('id'))
        );
    }
}
