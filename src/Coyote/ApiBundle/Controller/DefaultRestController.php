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
use Coyote\ApiBundle\Entity\Coyote\ApiBundle\Entity;
use Coyote\ApiBundle\Form\PersoType;

class DefaultRestController extends FOSRestController
{
    /**
     * @Rest\Get("perso")
     * @ApiDoc(
     *      section="Perso Entity",
     *      description="Get all perso from database"
     * )
     */
    public function getAllPersoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $datas = $em->getRepository("CoyoteApiBundle:Perso")->findAll();
        if (count($datas) > 0)
        {
            $view = $this->view(array(
                            "Persos" => $datas
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
     * @Rest\Get("perso/{id}")
     * @ApiDoc(
     *      section="Perso Entity",
     *      description="Get perso by id from database"
     * )
     * @param integer $id Id of the perso instance.
     */
    public function getPersoByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository("CoyoteApiBundle:Perso")->findOneById($id);
        if ($data)
        {
            $view = $this->view(array(
                            "Perso" => $data
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
     * )
     * @param integer $id Id of the guild instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getGuildById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository("CoyoteApiBundle:Guild")->findOneById($id);
        if ($data)
        {
            $view = $this->view(array(
                            "Guild" => $data
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
        //$json = json_decode($this->getRequest()->getContent(), true);
        $json = $this->getRequest()->request->all();
        $entity = new Perso();
        $entity->setClass($json['class']);
        $entity->setLevel($json['level']);
        $entity->setName($json['name']);
        $entity->setRace($json['race']);
        $entity->setSexe($json['sexe']);
        $em->persist($entity);
        $em->flush();
    
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
     *          "requirement" = "OK|KO",
     *          "description" = "The name of boot of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Warrior|Paladin",
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
        $json = $this->getRequest()->request->all();
        $entity = new Boot();
        $entity->setRarity($json['rarity']);
        $entity->setLevel($json['level']);
        $entity->setName($json['name']);
        $entity->setWeight($json['weight']);
        $em->persist($entity);
        $em->flush();
        
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
     *          "requirement" = "OK|KO",
     *          "description" = "The name of helmet of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Warrior|Paladin",
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
        $json = $this->getRequest()->request->all();
        $entity = new Helmet();
        $entity->setRarity($json['rarity']);
        $entity->setLevel($json['level']);
        $entity->setName($json['name']);
        $entity->setWeight($json['weight']);
        $em->persist($entity);
        $em->flush();
    
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
     *          "requirement" = "OK|KO",
     *          "description" = "The name of guild of the game"
     *      },
     *      {
     *          "name" = "banner",
     *          "dataType" = "string",
     *          "requirement" = "Warrior|Paladin",
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
        $json = $this->getRequest()->request->all();
        $entity = new Guild();
        $entity->setBanner($json['banner']);
        $entity->setName($json['name']);
        $em->persist($entity);
        $em->flush();
    
        if ($entity->getId() > 0)
        {
            $view = $this->view(array(
                            "Stuff create" => $entity
            ),200);
        }
        else{
            $view = $this->view(array(
                            "Stuff not create" => $entity
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
        
        $entity = new Perso();
        $form = $this->createForm(new PersoType(), $entity, 
                array('csrf_protection' => false,));
        
        //$form->handleRequest($this->getRequest());
        $form->submit($this->getRequest());
        
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
        return $this->handleView($view);
        
        /*$entity = $em->getRepository("CoyoteApiBundle:Perso")->findOneById($id);
        $updated_at = $entity->getUpdatedAt();
        $json = $this->getRequest()->request->all();

        if (!empty($json['class']))
        {
            $entity->setClass($json['class']);
        }
        if (!empty($json['level']))
        {
            $entity->setLevel($json['level']);
        }
        if (!empty($json['name']))
        {
            $entity->setName($json['name']);
        }
        if (!empty($json['sexe']))
        {
             $entity->setSexe($json['sexe']);
        }
        if (!empty($json['race']))
        {
            $entity->setRace($json['race']);
        }
        
        //A modifier*******************************
            $entity->setUpdatedAt(new \DateTime());
        //*****************************************
        $em->persist($entity);
        $em->flush();
    
        if ($updated_at != $entity->getUpdatedAt())
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
        return $this->handleView($view);*/
    }
    
    /**
     * @Rest\Post("guild/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "OK|KO",
     *          "description" = "The name of guild of the game"
     *      },
     *      {
     *          "name" = "banner",
     *          "dataType" = "string",
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
        $updated_at = $entity->getUpdatedAt();
        $json = $this->getRequest()->request->all();
    
        if (!empty($json['banner']))
        {
            $entity->setBanner($json['banner']);
        }
        if (!empty($json['name']))
        {
            $entity->setName($json['name']);
        }
        
        //A modifier*******************************
        $entity->setUpdatedAt(new \DateTime());
        //*****************************************
        
        $em->persist($entity);
        $em->flush();
    
        if ($updated_at != $entity->getUpdatedAt())
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
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Post("boot/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "OK|KO",
     *          "description" = "The name of boot of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Warrior|Paladin",
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
        $updated_at = $entity->getUpdatedAt();
        $json = $this->getRequest()->request->all();

        if (!empty($json['rarity']))
        {
            $entity->setRarity($json['rarity']);
        }
        if (!empty($json['name']))
        {
            $entity->setLevel($json['level']);
        }
        if (!empty($json['weight']))
        {
            $entity->setWeight($json['weight']);
        }
        if (!empty($json['name']))
        {
            $entity->setName($json['name']);
        }
    
        //A modifier*******************************
        $entity->setUpdatedAt(new \DateTime());
        //*****************************************
    
        $em->persist($entity);
        $em->flush();
    
        if ($updated_at != $entity->getUpdatedAt())
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
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Post("helmet/{id}")
     * @ApiDoc(
     *      requirements = {
     *      {
     *          "name" = "name",
     *          "dataType" = "string",
     *          "requirement" = "OK|KO",
     *          "description" = "The name of boot of the game"
     *      },
     *      {
     *          "name" = "rarity",
     *          "dataType" = "string",
     *          "requirement" = "Warrior|Paladin",
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
        $updated_at = $entity->getUpdatedAt();
        $json = $this->getRequest()->request->all();
    
        if (!empty($json['rarity']))
        {
            $entity->setRarity($json['rarity']);
        }
        if (!empty($json['name']))
        {
            $entity->setLevel($json['level']);
        }
        if (!empty($json['weight']))
        {
            $entity->setWeight($json['weight']);
        }
        if (!empty($json['name']))
        {
            $entity->setName($json['name']);
        }
    
        //A modifier*******************************
        $entity->setUpdatedAt(new \DateTime());
        //*****************************************
    
        $em->persist($entity);
        $em->flush();
    
        if ($updated_at != $entity->getUpdatedAt())
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
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Put("register/{perso_id}&{guild_id}")
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
     *          "requirement" = "Warrior|Paladin",
     *          "description" = "The rank of register into guild"
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
     * @param integer $perso_id Id of the perso instance.
     * @param integer $guild_id Id of the guild instance.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putRegister($perso_id, $guild_id)
    {
        $em = $this->getDoctrine()->getManager();
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
        return $this->handleView($view);
    }
}
