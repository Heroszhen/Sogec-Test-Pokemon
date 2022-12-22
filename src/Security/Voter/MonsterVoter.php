<?php
namespace App\Security\Voter;

use App\Entity\Monster;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class ProductVoter extends Voter
{
    private $security = null;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }

    protected function supports($attribute, $subject): bool
    {
        $supportsAttribute = in_array($attribute, ['MONSTER_UPDATE']);
        $supportsSubject = $subject instanceof Monster;

        return $supportsAttribute && $supportsSubject;
    }

    /**
     * @param string $attribute
     * @param Book $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        /** ... check if the user is anonymous ... **/

        switch ($attribute) {
            case 'MONSTER_UPDATE':
                $found = $this->em->getRepository(Monster::class)->findBy(["type1"=>$subject->getType1()]);
                if(count($found) > 0)return true;
                break;
            case 'BOOK_READ':
                /** ... other autorization rules ... **/
        }

        return false;
    }
}