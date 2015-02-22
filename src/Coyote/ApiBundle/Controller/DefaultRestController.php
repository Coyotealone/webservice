<?php

namespace Coyote\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Coyote\ApiBundle\Entity\Perso;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Coyote\ApiBundle\Entity\Guild;
use Coyote\ApiBundle\Entity\Stuff;
use Coyote\ApiBundle\Entity\Boot;
use Coyote\ApiBundle\Entity\Helmet;
use Coyote\ApiBundle\Entity\Register;
use Coyote\ApiBundle\Form\PersoType;
use Coyote\ApiBundle\Form\PersoRestType;
use Coyote\ApiBundle\Form\GuildType;
use Coyote\ApiBundle\Form\StuffType;
use Coyote\ApiBundle\Form\RegisterType;

class DefaultRestController extends FOSRestController
{
    /**
     * @Rest\Get("perso")
     * @ApiDoc(
     *      section="Perso Entity",
     *      description="Get all perso from database"
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllPersoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:Perso")->findAll();
        if (count($entity) > 0)
        {
            $view = $this->view(array(
                            "Persos" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No Persos" => $entity
            ),204);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Get("perso/{id}")
     * @ApiDoc(
     *      section="Perso Entity",
     *      description="Get perso by id from database"
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the perso instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPersoByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:Perso")->findOneById($id);
        if ($entity)
        {
            $view = $this->view(array(
                            "Perso" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No Perso" => $entity
            ),204);
        }
        return $this->handleView($view);
    }
    
    
    
    /**
     * @Rest\Get("guild")
     * @ApiDoc(
     *      section="Guild Entity",
     *      description="Get all guild from database",
     *      statusCodes = {
     *          200 = "OK",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllGuildAction()
    {
        $em = $this->getDoctrine()->getManager();
        $datas = $em->getRepository("CoyoteApiBundle:Guild")->findAll();
        if (count($datas) > 0)
        {
            $view = $this->view(array(
                            "Guilds" => $datas
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "message" => "Empty Data"
            ),204);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Get("guild/{id}")
     * @ApiDoc(
     *      section="Guild Entity",
     *      description="Get guild by id from database"
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the guild instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getGuildById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteApiBundle:Guild")->findOneById($id);
        if ($entity)
        {
            $view = $this->view(array(
                            "Guild" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No Guild" => $entity
            ),204);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Put("perso")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "OK|KO",
     *          "description" = "The name of perso of the game"
     *      },
     *      {
     *          "name" = "class",
     *          "dataType" = "string",
     *          "requirement" = "Warrior|Paladin",
     *          "description" = "The class of perso of the game"
     *      },
     *      {
     *          "name" = "level",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The level of perso of the game"
     *      },
     *      {
     *          "name" = "race",
     *          "dataType" = "string",
     *          "requirement" = "Human|Orc",
     *          "description" = "The race of perso of the game"
     *      },
     *      {
     *          "name" = "sexe",
     *          "dataType" = "string",
     *          "requirement" = "Masculin|Female",
     *          "description" = "The sexe of perso of the game"
     *      }
     *      },
     *      section="Perso Entity",
     *      description="Insert new perso into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putPersoAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Perso();
        $form = $this->createForm(new PersoRestType(), $entity,
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        
        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Perso create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Perso not create" => $entity
            ),406);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Put("boot")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Chaussure|Botte",
     *          "description" = "The name of boot of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Epique|Legendaire",
     *          "description" = "The rarity of boot of the game"
     *      },
     *      {
     *          "name" = "level",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The level of boot of the game"
     *      },
     *      {
     *          "name" = "weight",
     *          "dataType" = "float",
     *          "requirement" = "1.1",
     *          "description" = "The weight of boot of the game"
     *      }
     *      },
     *      section="Stuff Entity",
     *      description="Insert new boot into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putBootAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Boot();
        $form = $this->createForm(new StuffType(), $entity, 
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        
        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Boot create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Boot not create" => $entity
            ),406);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Put("helmet")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Casque|Chapeau",
     *          "description" = "The name of helmet of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Epique|Legendaire",
     *          "description" = "The rarity of helmet of the game"
     *      },
     *      {
     *          "name" = "level",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The level of helmet of the game"
     *      },
     *      {
     *          "name" = "weight",
     *          "dataType" = "float",
     *          "requirement" = "1.1",
     *          "description" = "The weight of helmet of the game"
     *      }
     *      },
     *      section="Stuff Entity",
     *      description="Insert new boot into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putHelmetAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Helmet();
        $form = $this->createForm(new StuffType(), $entity, 
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        
        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Helmet create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Helmet not create" => $entity
            ),406);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Put("guild")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Guildeo|MasterGuild",
     *          "description" = "The name of guild of the game"
     *      },
     *      {
     *          "name" = "banner",
     *          "dataType" = "string",
     *          "requirement" = "Guild winner",
     *          "description" = "The banner of guild of the game"
     *      },
     *      },
     *      section="Guild Entity",
     *      description="Insert new boot into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putGuildAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Guild();
        $form = $this->createForm(new GuildType(), $entity, 
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        
        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Guild create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Guild not create" => $entity
            ),406);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Post("perso/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "OK|KO",
     *          "description" = "The name of perso of the game"
     *      },
     *      {
     *          "name" = "class",
     *          "dataType" = "string",
     *          "requirement" = "Warrior|Paladin",
     *          "description" = "The class of perso of the game"
     *      },
     *      {
     *          "name" = "level",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The level of perso of the game"
     *      },
     *      {
     *          "name" = "race",
     *          "dataType" = "string",
     *          "requirement" = "Human|Orc",
     *          "description" = "The race of perso of the game"
     *      },
     *      {
     *          "name" = "sexe",
     *          "dataType" = "string",
     *          "requirement" = "Masculin|Female",
     *          "description" = "The sexe of perso of the game"
     *      }
     *      },
     *      section="Perso Entity",
     *      description="Update perso into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the perso instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postPersoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository("CoyoteApiBundle:Perso")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new PersoRestType(), $entity, 
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }
            
            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "Perso update" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "Perso not update" => $entity
                ),406);
            }
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Post("guild/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Guildeo|MasterGuild",
     *          "description" = "The name of guild of the game"
     *      },
     *      {
     *          "name" = "banner",
     *          "dataType" = "Guild winner",
     *          "requirement" = "Warrior|Paladin",
     *          "description" = "The banner of guild of the game"
     *      },
     *      },
     *      section="Guild Entity",
     *      description="Update guild into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the guild instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postGuildAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository("CoyoteApiBundle:Guild")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new GuildType(), $entity, 
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }
            
            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "Guild update" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "Guild not update" => $entity
                ),406);
            }
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Post("boot/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Chaussure|Botte",
     *          "description" = "The name of boot of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Epique|Legendaire",
     *          "description" = "The rarity of boot of the game"
     *      },
     *      {
     *          "name" = "level",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The level of boot of the game"
     *      },
     *      {
     *          "name" = "weight",
     *          "dataType" = "float",
     *          "requirement" = "1.1",
     *          "description" = "The weight of boot of the game"
     *      }
     *      },
     *      section="Stuff Entity",
     *      description="Update boot into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the boot instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postBootAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository("CoyoteApiBundle:Boot")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new StuffType(), $entity, 
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }
            
            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "Boot update" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "Boot not update" => $entity
                ),406);
            }
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Post("helmet/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "Chapeau|Casque",
     *          "description" = "The name of boot of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Epique|Legendaire",
     *          "description" = "The rarity of boot of the game"
     *      },
     *      {
     *          "name" = "level",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The level of boot of the game"
     *      },
     *      {
     *          "name" = "weight",
     *          "dataType" = "float",
     *          "requirement" = "1.1",
     *          "description" = "The weight of boot of the game"
     *      }
     *      },
     *      section="Stuff Entity",
     *      description="Update helmet into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the helmet instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postHelmetAction($id)
    {
    $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository("CoyoteApiBundle:Helmet")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new StuffType(), $entity, 
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
            }
            
            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "Helmet update" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "Helmet not update" => $entity
                ),406);
            }
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Put("register")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "level",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The level of register into guild"
     *      },
     *      {
     *          "name" = "rank",
     *          "dataType" = "string",
     *          "requirement" = "Junior|Expert",
     *          "description" = "The rank of register into guild"
     *      },
     *      {
     *          "name" = "members",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The Id of perso"
     *      },
     *      {
     *          "name" = "guilds",
     *          "dataType" = "integer",
     *          "requirement" = "1",
     *          "description" = "The Id of guild"
     *      },
     *      },
     *      section="Register Entity",
     *      description="Insert new register into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putRegister()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Register();
        $form = $this->createForm(new RegisterType(), $entity,
                array('csrf_protection' => false,));
        $request = $this->getRequest()->request->all();
        $form->submit($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        
        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Add register" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Not add register" => $entity
            ),406);
        }
        return $this->handleView($view);
        /*$em = $this->getDoctrine()->getManager();
        $data_guild = $em->getRepository("CoyoteApiBundle:Guild")->findOneById($guild_id);
        $data_perso = $em->getRepository("CoyoteApiBundle:Perso")->findOneById($perso_id);
        $json = $this->getRequest()->request->all();
        
        $entity = new Register();
        if(!empty($data_guild) && !empty($data_perso))
        {
            $entity->setMembers($data_perso);
            $entity->setGuilds($data_guild);
            if (!empty($json['level']))
            {
                $entity->setLevel($json['level']);
            }
            if (!empty($json['rank']))
            {
                $entity->setRank($json['rank']);
            }
            
            $em->persist($entity);
            $em->flush();
            
            if ($entity->getId() > 0)
            {
                $view = $this->view(array(
                                "Register guild" => $entity
                ),200);
            }
            else{
                $view = $this->view(array(
                                "Not Register guild" => $entity
                ),406);
            }
        }
        else {
            $view = $this->view(array(
                            "Not Register guild" => $entity
            ),404);
        }
        return $this->handleView($view);*/
    }
    
    /**
     * @Rest\Delete("register/{id}")
     * @ApiDoc(
     *      section="Register Entity",
     *      description="Insert new register into database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param integer $id Id of the register instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteRegisterAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository("CoyoteApiBundle:Register")->findOneById($id);
        if (!$entity) {
            $view = $this->view(array(
                            "Not delete register" => $entity
            ),404);
        }
        else {
            $form = $this->createForm(new RegisterType(), $entity,
                    array('csrf_protection' => false,));
            $request = $this->getRequest()->request->all();
            $form->submit($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($entity);
                $em->flush();
            }
            $view = $this->view(array(
                            "Delete register" => $entity
            ),200);
        
        }
        return $this->handleView($view);
    }
}
