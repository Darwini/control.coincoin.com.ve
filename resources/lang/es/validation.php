<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | El following language lines contain El default error messages used by
    | El validator class. Some of these rules have multiple versions such
    | as El size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El Campo :attribute debe ser acceptado.',
    'active_url'           => 'El Campo :attribute no es una URL valida.',
    'after'                => 'El Campo :attribute debe ser una fecha posterior de :date.',
    'after_or_equal'       => 'El Campo :attribute debe ser una fecha posterior o igual un :date.',
    'alpha'                => 'El Campo :attribute solo puede contener letras.',
    'alpha_dash'           => 'El Campo :attribute solo puede contener letras, números, y guiones.',
    'alpha_num'            => 'El Campo :attribute solo puede contener letras y números.',
    'array'                => 'El Campo :attribute debe ser un array.',
    'before'               => 'El Campo :attribute debe ser una fecha anterior un :date.',
    'before_or_equal'      => 'El Campo :attribute debe ser una fecha anterior o igual un :date.',
    'between'              => [
        'numeric' => 'El Campo :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El Campo :attribute debe tener un tamaño entre :min y :max kilobytes.',
        'string'  => 'El Campo :attribute debe tener entre :min y :max caracteres.',
        'array'   => 'El Campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El Campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El Campo :attribute confirmación no coincide.',
    'date'                 => 'El Campo :attribute no es una fecha válida.',
    'date_format'          => 'El Campo :attribute no coincide el formato :format.',
    'different'            => 'El Campo :attribute y :other debe ser different.',
    'digits'               => 'El Campo :attribute debe ser de :digits digitos.',
    'digits_between'       => 'El Campo :attribute debe ser entre :min y :max digitos.',
    'dimensions'           => 'El Campo :attribute tiene dimensiones invalidas.',
    'distinct'             => 'El Campo :attribute tiene un valor duplicado.',
    'email'                => 'El Campo :attribute debe ser una dirección de email valida.',
    'exists'               => 'El Campo :attribute elegido es invalido.',
    'file'                 => 'El Campo :attribute debe ser un archivo.',
    'filled'               => 'El Campo :attribute es obligatorio.',
    'image'                => 'El Campo :attribute debe ser una imagen.',
    'in'                   => 'El Campo :attribute escogido es invalido.',
    'in_array'             => 'El Campo :attribute no existe en :other.',
    'integer'              => 'El Campo :attribute debe ser un numero entero.',
    'ip'                   => 'El Campo :attribute debe ser una dirección IP valida.',
    'ipv4'                 => 'El Campo :attribute debe ser una dirección IPv4 valida.',
    'ipv6'                 => 'El Campo :attribute debe ser una dirección IPv6 valida.',
    'json'                 => 'El Campo :attribute debe ser una cadena JSON valida.',
    'max'                  => [
        'numeric' => 'El Campo :attribute no debe ser mayor a :max.',
        'file'    => 'El Campo :attribute no debe pesar más de :max kilobytes.',
        'string'  => 'El Campo :attribute no debe tener más de :max caracteres.',
        'array'   => 'El Campo :attribute no debe poseer más de :max elementos.',
    ],
    'mimes'                => 'El Campo :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'El Campo :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El Campo :attribute debe tener como minimo :min.',
        'file'    => 'El Campo :attribute debe tener al menos :min kilobytes.',
        'string'  => 'El Campo :attribute debe tener minimo :min caracteres.',
        'array'   => 'El Campo :attribute debe tener a lo menos :min elementos.',
    ],
    'not_in'               => 'El Campo :attribute escogido es invalido.',
    'numeric'              => 'El Campo :attribute debe ser un número.',
    'present'              => 'El Campo :attribute field debe ser present.',
    'regex'                => 'El Campo :attribute tiene formato invalido.',
    'required'             => 'El Campo :attribute es requerido.',
    'required_if'          => 'El Campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El Campo :attribute field es required unless :other es in :values.',
    'required_with'        => 'El Campo :attribute field es required when :values es present.',
    'required_with_all'    => 'El Campo :attribute field es required when :values es present.',
    'required_without'     => 'El Campo :attribute field es required when :values es not present.',
    'required_without_all' => 'El Campo :attribute field es required when none of :values are present.',
    'same'                 => 'El Campo :attribute y :other must match.',
    'size'                 => [
        'numeric' => 'El Campo :attribute debe medir :size.',
        'file'    => 'El Campo :attribute debe pesar :size kilobytes.',
        'string'  => 'El Campo :attribute debe tener :size caracteres.',
        'array'   => 'El Campo :attribute debe contener :size elementos.',
    ],
    'string'               => 'El Campo :attribute debe ser un string.',
    'timezone'             => 'El Campo :attribute debe ser una zona valida.',
    'unique'               => 'El Campo :attribute ha de ser único.',
    'uploaded'             => 'El Campo :attribute falla al subir.',
    'url'                  => 'El Campo :attribute tiene un formato invalido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using El
    | convention "attribute.rule" to name El lines. This makes it quick to
    | specify un specific custom language line for un given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | El following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages un little cleaner.
    |
    */

    'attributes' => [],

];
