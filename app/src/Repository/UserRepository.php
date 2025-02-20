<?php

namespace App\Repository;

use App\DTO\RegisterDTO;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(
        public ManagerRegistry        $registry,
        public EntityManagerInterface $entityManager,
    )
    {
        parent::__construct($registry, User::class);
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function createUser(RegisterDTO $registerDTO): User
    {
        $user = new User();
        $user->setEmail($registerDTO->getEmail());
        $user->setPassword(password_hash($registerDTO->getPassword(), PASSWORD_BCRYPT));
        $user->setName($registerDTO->getName());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function delete(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
