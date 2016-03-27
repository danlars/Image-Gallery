<?php
use Phalcon\Http\Response as Response;

class LoginController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->form = new LoginForm();
    }

    private function _registerSession(Users $user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'username' => $user->username
        ));
    }

    public function authenticateAction()
    {
        try {
            $form = new LoginForm();

            if ($this->request->isPost() && $form->isValid($this->request->getPost())) {
                $username = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $userExist = Users::findFirst(array('username' => $username));

                if ($userExist && $this->security->checkHash($password, $userExist->password)) {
                    $this->_registerSession($userExist);
                    $this->flash->success('Velkommen ' . $userExist->username);
                    return $this->response->redirect('/');
                } else {
                    $this->flash->error('User does not exist');
                }
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }

            return $this->response->redirect('login');
        } catch(Phalcon\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logoutAction(){
        $this->session->remove('auth');
        return $this->response->redirect('login');
    }
}

