<?php

// app/Notifications/JobApplicationStatusNotification.php
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class JobApplicationStatusNotification extends Notification
{
    public $jobApplication;

    public function __construct($jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    public function toMail($notifiable)
    {
        // Build the mail representation
        return (new MailMessage)
            ->line('Your job application status has been updated.')
            ->action('View Application', url('/job-applications/' . $this->jobApplication->id))
            ->line('Thank you for using our application!');
    }
}
