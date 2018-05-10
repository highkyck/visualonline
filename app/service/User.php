<?php

namespace service;

class User extends Base
{
    /**
     * 获取好友列表
     * @param $uid
     * @return array|bool
     */
    public function getList($uid)
    {
        //自己的信息
        $mine = $this->db->get('user', '*', ['id' => $uid]);
        if (empty($mine)) {
            return false;
        }

        $result = ['mine' => $mine, 'friend' => []];
        //分组
        $group = $this->db->get('group', ['uid' => $uid, 'type' => 1]);
        if (!empty($group)) {
            foreach ($group as &$g) {
                //查询分组好友
                $groupFriends = $this->db->select('group_user_map', ['[>]user' => ['uid' => 'id']], ['user.*'],
                    ['group_id' => $g['group_id']]);
                $g['list'] = $groupFriends;
                $result['friend'][] = $g;
            }
        }

        // 群
        $groups = $this->db->select('user_group_map', ['[>]group' => 'group_id'], ['group.*'], ['uid' => $uid]);
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

        $groupFriends = $this->db->select('group_user_map', ['[>]user' => ['uid' => 'id']], ['user.*'],
            ['group_id' => $groupInfo['group_id']]);

        $result['members'] = \count($groupFriends);
        $result['list'] = $groupFriends;

        return $result;
    }
}