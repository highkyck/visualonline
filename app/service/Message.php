<?php
namespace service;

class Message extends Base
{
    public function create($data)
    {
        $message = [];
        if (!empty($data['userId'])) {
            $message['from_id'] = (int)$data['from_id'];
        } else {
            return false;
        }

        if (!empty($data['userName'])) {
            $message['from_username'] = $data['from_username'];
        }

        if (!empty($data['to_id'])) {
            $message['to_id'] = (int)$data['to_id'];
        } else {
            return false;
        }

        if (\is_string($data['content'])) {
            $message['content'] = $data['content'];
        }

        if (\in_array($data['type'], ['friend', 'group'])) {
            $message['type'] = $data['type'];
        }

        if (!empty($data['avatar'])) {
            $message['avatar'] = $data['avatar'];
        }

        $message['message_time'] = time();

        $message['is_pushed'] = $data['is_pushed'] ?? 0;

        $this->db->insert('message', $message);
        return $this->db->id();
    }
}