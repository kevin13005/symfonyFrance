<?php

namespace App\MessageHandler;

use App\Message\MailNotification;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MailNotificationHandler implements MessageHandlerInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(MailNotification $message)
    {

        $email = (new Email())
                ->from($message->getFrom())
                ->to('ici@faire.com')
                ->subject('Nouveau contact client' .$message->getId(). ' - ' .$message->getFrom() )
                ->html('<p> ' .$message->getDescription(). ' </p>');

        $this->mailer->send($email);

    }
}