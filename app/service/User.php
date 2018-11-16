<?php

namespace service;

use lib\log\Logger;
use lib\storage\Redis;
use lib\type\GroupType;
use Medoo\Medoo;

class User extends Base
{
    private static $defaultGroup = 1;

    private static $icons = [
        'https://tva2.sinaimg.cn/crop.0.0.180.180.180/5db11ff4jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/83d685c5jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/7fde8b93jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva4.sinaimg.cn/crop.0.0.180.180.180/6a4acad5jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/4a02849cjw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/86b15b6cjw1e8qgp5bmzyj2050050aa8.jpg',
    ];

    public static function hashPasswd($pass)
    {
        return \md5($pass . SALT);
    }

    public function regForTest($user)
    {
        $users = $this->db->select('user', '*', [
            'OR' => [
                'username' => $user['username'],
                'email'    => $user['email'],
            ],
        ]);

        if (!empty($users)) {
            return $this->error("用户名或邮箱已经存在");
        }

        $user['avatar'] = static::$icons[array_rand(self::$icons, 1)];

        $this->db->action(function (Medoo $db) use ($user) {
            try {
                $db->insert('user', $user);
                $uid = $db->id();

                // 默认将用户加入测试群组中
                $db->insert('group_user_map', [
                    'group_id' => self::$defaultGroup,
                    'uid'      => $uid,
                ]);

                $db->insert('user_group_map', [
                    'group_id' => self::$defaultGroup,
                    'uid'      => $uid,
                ]);

                // 给每个用户添加一个默认的好友分组
                $db->insert('group', [
                    'uid'         => $uid,
                    'groupname'   => '我的好友',
                    'type'        => GroupType::FRIEND,
                    'description' => '我的好友',
                    'avatar'      => static::$icons[0]
                ]);
            } catch (\Exception $e) {
                Logger::error(__METHOD__ . '.log', $e->getMessage()
                    . "\n" . $e->getTraceAsString());
                return false;
            }
        });

        return $this->success("注册成功");
    }

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
                    ['group_id' => $g['group_id'], 'user.id[!]' => $uid]);
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
        $groups = $this->db->select('user_group_map', ['[>]group' => 'group_id'],
            ['group.group_id(id)', 'groupname', 'avatar']
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