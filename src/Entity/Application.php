<?php

namespace App\Entity;


use ApiPlatform\Doctrine\Orm\Filter\ExactFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\QueryParameter;
use App\Enum\JobTypeEnum;
use App\Enum\PositionTypeEnum;
use App\Repository\ApplicationRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(),
        new Patch(),
    ],
    paginationItemsPerPage: 3
)]
#[GetCollection(
    parameters: [
        'jobTypeEnum' => new QueryParameter(filter: new ExactFilter()),
        'positionTypeEnum' => new QueryParameter(filter: new ExactFilter()),
    ],
)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(
        message: 'Imię nie może być puste',
        groups: ['admin']
    )]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Imię musi mieć przynajmniej {{ limit }} znaki',
        maxMessage: 'Imię nie może mieć więcej niż {{ limit }} znaków',
        groups: ['admin']
    )]
    private string $name;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(
        message: 'Nazwisko nie może być puste',
        groups: ['admin']
    )]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Nazwisko musi mieć przynajmniej {{ limit }} znaki',
        maxMessage: 'Nazwisko nie może mieć więcej niż {{ limit }} znaków',
        groups: ['admin']
    )]
    private string $surname;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'Email nie może być pusty',
        groups: ['admin']
    )]
    #[Assert\Email(
        message: 'Nieprawidłowy format email',
        groups: ['admin']
    )]
    private string $email;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(
        message: 'Numer telefonu nie może być pusty',
        groups: ['admin']
    )]
    #[Assert\Length(
        min: 9,
        max: 9,
        exactMessage: 'Numer telefonu musi zawierać dokładnie {{ limit }} cyfr',
        groups: ['admin']
    )]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Numer telefonu może składać się tylko z cyfr',
        groups: ['admin']
    )]
    private string $phone;

    #[ORM\Column(type: 'smallint')]
    #[Assert\NotNull(
        message: 'Doświadczenie nie może być puste',
        groups: ['admin']
    )]
    #[Assert\PositiveOrZero(
        message: 'Doświadczenie musi być liczbą nieujemną',
        groups: ['admin']
    )]
    #[Assert\Range(
        maxMessage: 'Doświadczenie nie może być większe niż {{ limit }} lat',
        max: 50,
        groups: ['admin']
    )]
    private int $experience;

    #[ORM\Column(enumType: JobTypeEnum::class)]
    #[Assert\NotNull(
        message: 'Typ pracy musi być wybrany',
        groups: ['admin']
    )]
    private JobTypeEnum $jobTypeEnum = JobTypeEnum::REMOTE;

    #[ORM\Column(enumType: PositionTypeEnum::class)]
    #[Assert\NotNull(
        message: 'Pozycja musi być wybrana',
        groups: ['admin']
    )]
    private PositionTypeEnum $positionTypeEnum = PositionTypeEnum::JUNIOR;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }


    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
    }


    public function getExperience(): int
    {
        return $this->experience;
    }


    public function setJobTypeEnum(JobTypeEnum $jobTypeEnum): void
    {
        $this->jobTypeEnum = $jobTypeEnum;
    }


    public function getJobTypeEnum(): JobTypeEnum
    {
        return $this->jobTypeEnum;
    }

    public function setPositionTypeEnum(PositionTypeEnum $positionTypeEnum): void
    {
        $this->positionTypeEnum = $positionTypeEnum;
    }


    public function getPositionTypeEnum(): PositionTypeEnum
    {
        return $this->positionTypeEnum;
    }
}
