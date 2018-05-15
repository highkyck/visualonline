<?php

namespace service;

use lib\storage\Redis;

class User extends Base
{

    public function changeSign($uid, $sign)
    {
        return $this->db->update('user', ['sign' => $sign], ['id' => $uid]);
    }

    public function getAllFriends($uid)
    {
        //分组
        $group = $this->db->select('group', '*', ['uid' => $uid, 'type' => 1]);
        $friends = [];
        if (!empty($group)) {
            foreach ($group as &$g) {
                //查询分组好友
                $groupFriends = $this->db->select('group_user_map', ['[>]user' => ['uid' => 'id']], '*',
                    ['group_id' => $g['group_id']]);
                $friends += $groupFriends;
            }
        }
        return $friends;
    }

    /**
     * 获取好友列表
     * @param $uid
     * @return array|bool
     * @throws \Exception
     */
    public function getList($uid)
    {
        //自己的信息
        $mine = $this->db->get('user', '*', ['id' => $uid]);
        if (empty($mine)) {
            return false;
        }
        $mine['status'] = 'online';
        $result = ['mine' => $mine, 'friend' => []];
        //分组
        $group = $this->db->select('group', '*', ['uid' => $uid, 'type' => 1]);
        $redis = Redis::instance('queue');
        if (!empty($group)) {
            foreach ($group as &$g) {
                //查询分组好友
                $groupFriends = $this->db->select('group_user_map', ['[>]user' => ['uid' => 'id']], '*',
                    ['group_id' => $g['group_id'] , 'user.id[!]' => $uid]);
                foreach ($groupFriends as &$friend) {
                    $userInfo = $redis->hGet('user_info', $friend['uid']);
                    $userInfo = \json_decode($userInfo, true);
                    if (empty($userInfo) && isset($userInfo['status'])) {
                        $friend['status'] = $userInfo['status'];
                    } else {
                        $friend['status'] = 'offline';
                    }
                }
                $g['list'] = $groupFriends;
                $result['friend'][] = $g;
            }
        }
        // 群
        $groups = $this->db->select('user_group_map', ['[>]group' => 'group_id'], ['group.group_id(id)', 'groupname', 'avatar']
            , ['user_group_map.uid' => $uid, 'group.type' => 2]);
        $result['group'] = $groups;

        return $result;
    }

    /**
     * 获取群/组成员
     * @param $group_id
     * @return bool
     */
    public function getMembers($group_id)
    {
        $groupInfo = $this->db->get('group', '*', ['group_id' => $group_id]);

        if (empty($groupInfo)) {
            return false;
        }

        $owner = $this->db->get('user', '*', ['id' => $groupInfo['uid']]);
        $result['owner'] = $owner;

        $groupFriends = $this->db->select('group_user_map', ['[>]user' => ['uid' => 'id']], '*',
            ['group_id' => $groupInfo['group_id']]);

        $result['members'] = \count($groupFriends);
        $result['list'] = $groupFriends;

        return $result;
    }

    public function getUserInfoByEmail($email)
    {
        return $this->db->get('user', "*", ['email' => $email]);
    }

    public function __destruct()
    {
        unset($this->db->pdo);
        unset($this->db);
    }
}