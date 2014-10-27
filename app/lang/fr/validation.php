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
    "accepted"             => utf8_encode ("Le champ :attribute doit �tre accept�."),
    "active_url"           => utf8_encode ("Le champ :attribute n'est pas une URL valide."),
    "after"                => utf8_encode ("Le champ :attribute doit �tre une date post�rieure au :date."),
    "alpha"                => utf8_encode ("Le champ :attribute doit seulement contenir des lettres."),
    "alpha_dash"           => utf8_encode ("Le champ :attribute doit seulement contenir des lettres, des chiffres et des tirets."),
    "alpha_num"            => utf8_encode ("Le champ :attribute doit seulement contenir des chiffres et des lettres."),
    "array"                => utf8_encode ("Le champ :attribute doit �tre un tableau."),
    "before"               => utf8_encode ("Le champ :attribute doit �tre une date ant�rieure au :date."),
    "between"              => array(
        "numeric" => utf8_encode ("La valeur de :attribute doit �tre comprise entre :min et :max."),
        "file"    => utf8_encode ("Le fichier :attribute doit avoir une taille entre :min et :max kilobytes."),
        "string"  => utf8_encode ("Le texte :attribute doit avoir entre :min et :max caract�res."),
        "array"   => utf8_encode ("Le champ :attribute doit avoir entre :min et :max �l�ments.")
    ),
    "boolean"              => utf8_encode ("Le champ :attribute doit true ou false"),
    "confirmed"            => utf8_encode ("Le champ de confirmation :attribute ne correspond pas."),
    "date"                 => utf8_encode ("Le champ :attribute n'est pas une date valide."),
    "date_format"          => utf8_encode ("Le champ :attribute ne correspond pas au format :format."),
    "different"            => utf8_encode ("Les champs :attribute et :other doivent �tre diff�rents."),
    "digits"               => utf8_encode ("Le champ :attribute doit avoir :digits chiffres."),
    "digits_between"       => utf8_encode ("Le champ :attribute doit avoir entre :min and :max chiffres."),
    "email"                => utf8_encode ("Le champ :attribute doit �tre une adresse email valide."),
    "exists"               => utf8_encode ("Le champ :attribute s�lectionn� est invalide."),
    "image"                => utf8_encode ("Le champ :attribute doit �tre une image."),
    "in"                   => utf8_encode ("Le champ :attribute est invalide."),
    "integer"              => utf8_encode ("Le champ :attribute doit �tre un entier."),
    "ip"                   => utf8_encode ("Le champ :attribute doit �tre une adresse IP valide."),
    "max"                  => array(
        "numeric" => utf8_encode ("La valeur de :attribute ne peut �tre sup�rieure � :max."),
        "file"    => utf8_encode ("Le fichier :attribute ne peut �tre plus gros que :max kilobytes."),
        "string"  => utf8_encode ("Le texte de :attribute ne peut contenir plus de :max caract�res."),
        "array"   => utf8_encode ("Le champ :attribute ne peut avoir plus de :max �l�ments."),
    ),
    "mimes"                => utf8_encode ("Le champ :attribute doit �tre un fichier de type : :values."),
    "min"                  => array(
        "numeric" => utf8_encode ("La valeur de :attribute doit �tre sup�rieure � :min."),
        "file"    => utf8_encode ("Le fichier :attribute doit �tre plus que gros que :min kilobytes."),
        "string"  => utf8_encode ("Le texte :attribute doit contenir au moins :min caract�res."),
        "array"   => utf8_encode ("Le champ :attribute doit avoir au moins :min �l�ments.")
    ),
    "not_in"               => utf8_encode ("Le champ :attribute s�lectionn� n'est pas valide."),
    "numeric"              => utf8_encode ("Le champ :attribute doit contenir un nombre."),
    "regex"                => utf8_encode ("Le format du champ :attribute est invalide."),
    "required"             => utf8_encode ("Le champ :attribute est obligatoire."),
    "required_if"          => utf8_encode ("Le champ :attribute est obligatoire quand la valeur de :other est :value."),
    "required_with"        => utf8_encode ("Le champ :attribute est obligatoire quand :values est pr�sent."),
    "required_with_all"    => utf8_encode ("Le champ :attribute est obligatoire quand :values est pr�sent."),
    "required_without"     => utf8_encode ("Le champ :attribute est obligatoire quand :values n'est pas pr�sent."),
    "required_without_all" => utf8_encode ("Le champ :attribute est requis quand aucun de :values n'est pr�sent."),
    "same"                 => utf8_encode ("Les champs :attribute et :other doivent �tre identiques."),
    "size"                 => array(
        "numeric" => utf8_encode ("La valeur de :attribute doit �tre :size."),
        "file"    => utf8_encode ("La taille du fichier de :attribute doit �tre de :size kilobytes."),
        "string"  => utf8_encode ("Le texte de :attribute doit contenir :size caract�res."),
        "array"   => utf8_encode ("Le champ :attribute doit contenir :size �l�ments.")
    ),
    "timezone"             => utf8_encode ("Le champ :attribute doit �tre une zone valide."),
    "unique"               => utf8_encode ("La valeur du champ :attribute est d�j� utilis�e."),
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
        "first_name" => "Pr�nom",
        "last_name" => "Nom",
        "password" => "Mot de passe",
        "password_confirmation" => "Confirmation du mot de passe",
        "city" => "Ville",
        "country" => "Pays",
        "address" => "Adresse",
        "phone" => "T�l�phone",
        "mobile" => "Portable",
        "age" => "Age",
        "sex" => "Sexe",
        "gender" => "Genre",
        "day" => "Jour",
        "month" => "Mois",
        "year" => "Ann�e",
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