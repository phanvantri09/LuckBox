<?php

namespace App\Repositories;

interface MessageRepositoryInterface
{
    public function createMessage($userId, $content);

    public function createAdminMessage($userId, $adminId, $content);

    public function updateMessageReadStatus($messageId);

    public function getUsersWithLatestMessages();

    public function getUserChat();

    public function getAdminChat($userId);

    public function searchUser($search);
}
