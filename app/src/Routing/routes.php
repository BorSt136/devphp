<?php
return [
    //url => [controller => action]
    '' => ['home' => 'index'],
    'inscription/' => ['user' => 'create'],
    'connection/' => ['user' => 'connect'],
    'profil/' => ['user' => 'read'],
    'profil/update/' => ['user' => 'update'],
    'profil/terminatorer/' => ['user' => 'delete'],
    'disconnect/' => ['user' => 'disconnect'],
    'redaction/' => ['article' => 'create'],
    'lecture/' => ['article' => 'read'],
    'article/modifiage/' => ['article' => 'update'],
    'article/suppressement/' => ['article' => 'delete'],
    'mes-articles/' => ['article' => 'readMine'],
    'tags/' => ['tag' => 'taglist'],
    'tags/creation/' => ['tag' => 'create']
];