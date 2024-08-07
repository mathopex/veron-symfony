<?php

namespace App\DataProcessor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserProcessor implements ProcessorInterface
{
    private UserPasswordHasherInterface $userPasswordEncoder;
    private ProcessorInterface $decoratedDataPersister;

    public function __construct(ProcessorInterface $decoratedDataPersister, UserPasswordHasherInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->decoratedDataPersister = $decoratedDataPersister;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($data instanceof \App\Entity\User && !empty($data->getPlainPassword())) {
            $data->setPassword($this->userPasswordEncoder->hashPassword($data, $data->getPlainPassword()));
            $data->eraseCredentials(); 
        }

        $data = $this->decoratedDataPersister->process($data, $operation, $uriVariables, $context);

        if ($data instanceof \App\Entity\User) {
            $data->eraseCredentials();
        }

        return $data;
    }

}
