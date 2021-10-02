<?php

namespace App\Domain\Services\Helper;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

/**
 * @codeCoverageIgnore
 * TODO: test later
 */
class Mailer
{
    /**
     * @param MailerInterface $mailer
     */
    public function __construct(
        private MailerInterface $mailer,
        private VerifyEmailHelperInterface $verifyEmailHelper
    ) {
    }

    /**
     * @param string $email
     * @param string $username
     * @throws TransportExceptionInterface
     */
    public function sendVerificationEmail(string $email, string $username)
    {
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            'registration_confirmation_route',
            $email,
            $username,
            [
                'email' => $email,
                'username' => $username,
            ]
        );

        $verificationEmail = (new TemplatedEmail())
            ->from(new Address('lamkimphu258@gmail.com', 'CEO Todotab'))
            ->to(new Address($email, $username))
            ->subject('Welcome to Todotab')
            ->htmlTemplate('emails/verification.html.twig')
            ->context([
                'username' => $username,
                'signedUrl' => $signatureComponents->getSignedUrl(),
            ]);

        $this->mailer->send($verificationEmail);
    }
}
