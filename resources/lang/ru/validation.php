<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'email' => [
            'unique' => 'Пользователь с такие email-ом уже зарегистрирован',
            'required' => 'Поле email обязательно для заполнения',
            'max'=>'Поле email слишком длинное'
        ],
        'password'=>[
            'min'=>'Пароль должен быть более 8 символов',
            'required' => 'Поле обязательно для заполнения',
            'confirmed'=> 'Введенные пароли не совпадают'
        ],
        'name'=>[
            'max'=>'ФИО слишком большое. Уменьшите до 256 символов',
            'required' => 'Поле обязательно для заполнения',
        ],
        'accepted'=>[
            'required' => 'Поле обязательно для заполнения',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
