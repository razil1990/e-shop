<?php
namespace app\components\validators;

use yii\validators\Validator;

class RegisterValidator extends Validator
{
    public function init() {
        parent::init();
        $this->message = [
            'whitespace_error' => 'Поле не должно сожержать знаки пунктуации, скобки, пробелы и т.д', 
            'symbol_error' => 'Поле должно содержать строчные и прописные буквы, цифры, символы !,@,#,$,%,^,&,'
        ];
    }

    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;
        if (preg_match("/[, .><?()\[\]\'\"~\-\+|\`\/{}\\\=\*:;]+/", $value)) {
            $model->addError($attribute, $this->message['whitespace_error']);

        } elseif (!preg_match("/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&])[a-zA-Z0-9!@#$%^&]{8,16}/", $value)) {
            $model->addError($attribute, $this->message['symbol_error']);    
        }
    }

    public function clientValidateAttribute($model, $attribute, $view) {
        $statuses = [
            json_encode("[, .><?()\[\]\'\"~\-\+|\`\/{}\\\=\*:;]+"),
            json_encode("(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&])[a-zA-Z0-9!@#$%^&]{8,16}")
        ];
        $messages = [
            json_encode($this->message['whitespace_error'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            json_encode($this->message['symbol_error'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ];
        return <<<JS
            if (value.match($statuses[0]) !== null) {
                messages.push($messages[0]);
            } else if (value.match($statuses[1]) === null)
                messages.push($messages[1]);
        JS;
    }
}
?>