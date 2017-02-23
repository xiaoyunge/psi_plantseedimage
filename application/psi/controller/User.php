<?php

namespace app\psi\controller;

use think\Controller;
use think\Request;
use think\Session;

use app\psi\model\User as UserModel;

class User extends Controller
{
    public function _initialize() {
        parent::_initialize();
    }
    public function login(Request $request)
    {
        Session::prefix('think');
        $users = new UserModel;
        $username = $request->post('username');
        $password = $request->post('password');
        $count = $users
                ->field('id','user')
                ->where( 'username',  '=', $username )
                ->where( 'password', '=', md5($password) )
                ->count();
        if ($count == 1) {
            Session::set('user.hasLogin', 'true', 'think'); // Session key name, Session value, Session  scope
            $user['hasLogin'] = true;
            $userinfo = UserModel::alias( 'user' )
                ->field(
                        ' user.id as userid, ' .
                        ' user.username as username, ' . 
                        ' user.email as email, ' . 
                        ' auth.can_ins as can_ins, ' . 
                        ' auth.can_upd as can_upd, ' . 
                        ' auth.can_del as can_del, ' . 
                        ' auth.can_edit_cont as can_edit_cont, ' . 
                        ' auth.can_mng_usr as can_mng_user '
                )
                ->join( 'psi_user_auth auth', 'user.id = auth.uid' )
                ->where( 'username',  '=', $username )
                ->where( 'password', '=', md5($password) )
                ->find()->toArray();
            // 
            $user['userid'] = $userinfo['userid'];
            $user['username'] = $userinfo['username'];
            $user['email'] = $userinfo['email'];
            $user['auth']['can_ins'] = $userinfo['can_ins'];
            $user['auth']['can_upd'] = $userinfo['can_upd'];
            $user['auth']['can_del'] = $userinfo['can_del'];
            $user['auth']['can_mng_usr'] = $userinfo['can_edit_cont'];
            $user['auth']['can_edit_cont'] = $userinfo['can_mng_user'];
            Session::set('user', $user, 'think');
            $this->success('sucess',  'think/index.php/psi/normal/home');
        } else {
            $user['hasLogin'] = false;
            $this->error('fail');
        }
        //return $this->fetch();
    }
    public function logout()
    {
        if (Session::has('user.hasLogin','think') && Session::get('user.hasLogin','think') == 'true') {
            Session::delete('user','think');
            $this->success('sucess',  'think/index.php/psi/normal/home');
        } else {
            $this->error('fail');
        }
    }
    public static function userList( ) {
        if ( Session::has('user.auth.can_ins','think') || Session::get('user.auth.can_ins','think') == true ) {
            $users = UserModel::all();
            $usersList = array();
            /* @var $value type */
            foreach ($users as $user) {
                $tuple = [
                    'id' => $user->id,
                    'username' => $user->username,
                ];
                array_push($usersList, $tuple);
            }
            return $usersList;
        } else {
            echo 'Unauthorisation\nNow script is terminated';
            exit();
        }
    }
}
