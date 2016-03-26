<?php
use Phalcon\Forms\Form;
use phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class LoginForm extends Form{
    public function initialize(){

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array(
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF validation failed'
        )));
        $csrf->clear();
        $this->add($csrf);

        $Email = new Text("email");
        $Email->setLabel("E-mail");
        $Email->setFilters(array('striptags', 'string'));
        $Email->setAttributes(array(
            'placeholder' => 'contoso@mail.com',
            'value'       => ''
        ));
        $Email->addValidators(array(
            new PresenceOf(array(
                'message' => 'Email is needed'
            )),
            new Email(array(
                'message' => 'Email is not valid'
            ))
        ));
        $this->add($Email);
        $password = new Password("password");
        $password->setLabel("Password");
        $password->setFilters(array('striptags', 'string'));
        $password->setAttributes(array(
            'placeholder' => 'password',
            'value'       => ''
        ));
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Password is needed'
            ))
        ));
        $this->add($password);
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}