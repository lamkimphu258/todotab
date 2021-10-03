<?php

namespace App\Actions;

use App\Domain\Entities\Users\User;
use App\Domain\Repositories\Users\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

// TODO: test later
/**
 * @codeCoverageIgnore
 */
class SecurityAction extends AbstractController
{
    // TODO: check unique username when register
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

    public function refreshToken(Request $request, JWTEncoderInterface $jwtEncoder): JsonResponse
    {
        try {
            $requestBody = json_decode($request->getContent(), true);
            $token = $requestBody['token'];
            $decodedToken = $jwtEncoder->decode($token);
            $refreshToken = $jwtEncoder->encode([
                'username' => $decodedToken['username'],
                'roles' => $decodedToken['roles']
            ]);
        } catch (JWTDecodeFailureException $ex) {
            throw $ex;
        }

        return new JsonResponse(['refresh_token' => $refreshToken]);
    }
}
