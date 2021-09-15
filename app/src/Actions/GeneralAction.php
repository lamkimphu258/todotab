<?php

namespace App\Actions;

use App\Domain\Entities\Users\User;
use App\Domain\Repositories\Users\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

/**
 * @codeCoverageIgnore
 * // TODO: test later
 */
class GeneralAction extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index()
    {
        return $this->render('index/index.html.twig');
    }

    #[Route('/verify', name: 'registration_confirmation_route')]
    public function verifyEmail(Request $request, VerifyEmailHelperInterface $helper, UserRepository $userRepository)
    {
        try {
            $helper->validateEmailConfirmation($request->getUri(), $request->get('email'), $request->get('username'));
        } catch (VerifyEmailExceptionInterface $e) {
            // TODO: create token expired page to allow user ask to resend verification email
            return $this->redirectToRoute('/token/expired');
        }

        /** @var User $user */
        $user = $userRepository->findOneByEmail($request->get('email'));
        $user->verify();
        $userRepository->save($user);

        return $this->redirectToRoute('app_index');
    }

    #[Route('/{reactRouting}', name: 'app_react_routing')]
    public function reactRouting()
    {
        return $this->render('index/index.html.twig');
    }
}
