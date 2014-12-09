<?php
namespace Atotrukis\MainBundle\Service;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseClass
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();

        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';

        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }

        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $email = $response->getEmail();
        $name = $response->getRealName();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        //when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setName($name);
            $user->setUsername($email);
            $user->setEmail($email);
            $user->setPlainPassword($username);
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            $this->insertUserLikes($response, $user);
            return $user;
        }

        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';

        //update access token
        $user->$setter($response->getAccessToken());

        return $user;
    }

    /**
     * strips keywords and inserts them to database
     * @param UserResponseInterface $response
     * @param $user
     */
    private function insertUserLikes(UserResponseInterface $response, $user)
    {
        $data = $response->getResponse();
        $likes = array();
        $likesTypes = array(
            'favorite_athletes',
            'favorite_teams',
            'inspirational_people',
        );
        foreach($likesTypes as $like){
            if(isset($data[$like])){
                $likes[] = $data[$like];
            }
        }
        foreach ($likes as $like) {
            foreach ($like as $item) {
                $words = explode(" ", $item['name']);
                foreach ($words as $word) {
                    $keyword = trim($word);
                    $keyword = preg_replace('/(?:^[^\p{L}\p{N}]+|[^\p{L}\p{N}]+$)/u', '', $keyword);
                    $keyword = mb_strtolower($keyword);
                    if (strlen($keyword) > 0) {
                        $this->userKeywordService->addKeyword($keyword, $user);
                    }
                }
            }
        }
    }

}