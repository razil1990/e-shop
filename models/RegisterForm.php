<?php 

namespace app\models;

use yii\base\Model;
use app\components\validators\RegisterValidator;

class RegisterForm extends Model
{
    public $login;
    public $password;
    public $password_repeat;
    public $rememberMe;
    
    public function rules() {
        return [
            [['login', 'password', 'password_repeat'], 'trim'],
            [['login', 'password', 'password_repeat'], 'required', 'message' => 'Поле не должно быть пустым'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9]/', 'message' => 'Логин может содержать только буквы английского алфавита и цифры'],
            ['login', 'string', 'max' => 30, 'tooLong' => 'Длина не более 30 символов'],
            [['password'], 'string', 'length' => [8, 16], 'tooLong' => 'Необходимо от 8 до 16 символов.', 'tooShort' => 'Необходимо от 8 до 16 символов.'],
            // [['password', 'password_repeat'], 'match', 'pattern' => '/^[a-zA-Z?_?@\d+]+$/', 'message' => 'Пароль должен содержать строчные и прописные буквы, цифры, символы .'],
            [['password'], RegisterValidator::class],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Не совпадает с паролем'],
        ];
    }
}

// (.+)?|\d+\W+(\w+)?

// [^ ,.><?()\[\]'"~\-\+|\`\/{}\\\=\*:;]+ проверка 1

// (?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&])[a-zA-Z0-9!@#$%^&]+ проверка 2