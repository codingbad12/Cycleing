<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Send a notification to a user
     */
    public static function send(User $user, string $title, string $message, string $type = 'info', string $link = null): Notification
    {
        return Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'link' => $link,
        ]);
    }
    
    /**
     * Send a notification to multiple users
     */
    public static function sendToMany(array $userIds, string $title, string $message, string $type = 'info', string $link = null): void
    {
        foreach ($userIds as $userId) {
            Notification::create([
                'user_id' => $userId,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'link' => $link,
            ]);
        }
    }
    
    /**
     * Send a notification to all users
     */
    public static function sendToAll(string $title, string $message, string $type = 'info', string $link = null): void
    {
        $userIds = User::pluck('id')->toArray();
        self::sendToMany($userIds, $title, $message, $type, $link);
    }
}