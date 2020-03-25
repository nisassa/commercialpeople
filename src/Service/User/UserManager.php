<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * UserManager 
 */
class UserManager  
{   
    /**
     * @var UserPasswordEncoderInterface $encoder
     * 
     */   
    private $encoder;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Contructor
     */
    public function __construct(UserPasswordEncoderInterface $encoder, 
                                EntityManagerInterface $em,
                                LoggerInterface $logger)
    {
        $this->encoder = $encoder;
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * Register new user
     * @param string $username
     * @param string $password
     * @return User|null
     */
    public function registerUser(string $username, string $password): ? User
    {   
        try {
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($this->encoder->encodePassword($user, $password));
            
            $this->em->persist($user);
            $this->em->flush();
            return $user;
        } catch (\Exception $e) {
            $this->logger->error("Failed to register new user. {$e->getMessage()}");
        }
        return null;
    }
}