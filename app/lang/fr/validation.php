<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    "alpha_spaces"     => utf8_encode ("Le champ :attribute doit contenir des lettres et des espaces."),
    "accepted"             => utf8_encode ("Le champ :attribute doit être accepté."),
    "active_url"           => utf8_encode ("Le champ :attribute n'est pas une URL valide."),
    "after"                => utf8_encode ("Le champ :attribute doit être une date postérieure au :date."),
    "alpha"                => utf8_encode ("Le champ :attribute doit seulement contenir des lettres."),
    "alpha_dash"           => utf8_encode ("Le champ :attribute doit seulement contenir des lettres, des chiffres et des tirets."),
    "alpha_num"            => utf8_encode ("Le champ :attribute doit seulement contenir des chiffres et des lettres."),
    "array"                => utf8_encode ("Le champ :attribute doit être un tableau."),
    "before"               => utf8_encode ("Le champ :attribute doit être une date antérieure au :date."),
    "between"              => array(
        "numeric" => utf8_encode ("La valeur de :attribute doit être comprise entre :min et :max."),
        "file"    => utf8_encode ("Le fichier :attribute doit avoir une taille entre :min et :max kilobytes."),
        "string"  => utf8_encode ("Le texte :attribute doit avoir entre :min et :max caractères."),
        "array"   => utf8_encode ("Le champ :attribute doit avoir entre :min et :max éléments.")
    ),
    "boolean"              => utf8_encode ("Le champ :attribute doit true ou false"),
    "confirmed"            => utf8_encode ("Le champ de confirmation :attribute ne correspond pas."),
    "date"                 => utf8_encode ("Le champ :attribute n'est pas une date valide."),
    "date_format"          => utf8_encode ("Le champ :attribute ne correspond pas au format :format."),
    "different"            => utf8_encode ("Les champs :attribute et :other doivent être différents."),
    "digits"               => utf8_encode ("Le champ :attribute doit avoir :digits chiffres."),
    "digits_between"       => utf8_encode ("Le champ :attribute doit avoir entre :min and :max chiffres."),
    "email"                => utf8_encode ("Le champ :attribute doit être une adresse email valide."),
    "exists"               => utf8_encode ("Le champ :attribute sélectionné est invalide."),
    "image"                => utf8_encode ("Le champ :attribute doit être une image."),
    "in"                   => utf8_encode ("Le champ :attribute est invalide."),
    "integer"              => utf8_encode ("Le champ :attribute doit être un entier."),
    "ip"                   => utf8_encode ("Le champ :attribute doit être une adresse IP valide."),
    "max"                  => array(
        "numeric" => utf8_encode ("La valeur de :attribute ne peut être supérieure à :max."),
        "file"    => utf8_encode ("Le fichier :attribute ne peut être plus gros que :max kilobytes."),
        "string"  => utf8_encode ("Le texte de :attribute ne peut contenir plus de :max caractères."),
        "array"   => utf8_encode ("Le champ :attribute ne peut avoir plus de :max éléments."),
    ),
    "mimes"                => utf8_encode ("Le champ :attribute doit être un fichier de type : :values."),
    "min"                  => array(
        "numeric" => utf8_encode ("La valeur de :attribute doit être supérieure à :min."),
        "file"    => utf8_encode ("Le fichier :attribute doit être plus que gros que :min kilobytes."),
        "string"  => utf8_encode ("Le texte :attribute doit contenir au moins :min caractères."),
        "array"   => utf8_encode ("Le champ :attribute doit avoir au moins :min éléments.")
    ),
    "not_in"               => utf8_encode ("Le champ :attribute sélectionné n'est pas valide."),
    "numeric"              => utf8_encode ("Le champ :attribute doit contenir un nombre."),
    "regex"                => utf8_encode ("Le format du champ :attribute est invalide."),
    "required"             => utf8_encode ("Le champ :attribute est obligatoire."),
    "required_if"          => utf8_encode ("Le champ :attribute est obligatoire quand la valeur de :other est :value."),
    "required_with"        => utf8_encode ("Le champ :attribute est obligatoire quand :values est présent."),
    "required_with_all"    => utf8_encode ("Le champ :attribute est obligatoire quand :values est présent."),
    "required_without"     => utf8_encode ("Le champ :attribute est obligatoire quand :values n'est pas présent."),
    "required_without_all" => utf8_encode ("Le champ :attribute est requis quand aucun de :values n'est présent."),
    "same"                 => utf8_encode ("Les champs :attribute et :other doivent être identiques."),
    "size"                 => array(
        "numeric" => utf8_encode ("La valeur de :attribute doit être :size."),
        "file"    => utf8_encode ("La taille du fichier de :attribute doit être de :size kilobytes."),
        "string"  => utf8_encode ("Le texte de :attribute doit contenir :size caractères."),
        "array"   => utf8_encode ("Le champ :attribute doit contenir :size éléments.")
    ),
    "timezone"             => utf8_encode ("Le champ :attribute doit être une zone valide."),
    "unique"               => utf8_encode ("La valeur du champ :attribute est déjà utilisée."),
    "url"                  => utf8_encode ("Le format de l'URL de :attribute n'est pas valide."),

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

    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(
        "name" => "Nom",
        "username" => "Pseudo",
        "email" => "E-mail",
        "first_name" => "Prénom",
        "last_name" => "Nom",
        "password" => "Mot de passe",
        "password_confirmation" => "Confirmation du mot de passe",
        "city" => "Ville",
        "country" => "Pays",
        "address" => "Adresse",
        "phone" => "Téléphone",
        "mobile" => "Portable",
        "age" => "Age",
        "sex" => "Sexe",
        "gender" => "Genre",
        "day" => "Jour",
        "month" => "Mois",
        "year" => "Année",
        "hour" => "Heure",
        "minute" => "Minute",
        "second" => "Seconde",
        "title" => "Titre",
        "content" => "Contenu",
        "description" => "Description",
        "excerpt" => "Extrait",
        "date" => "Date",
        "time" => "Heure",
        "available" => "Disponible",
        "size" => "Taille"
    ),

);