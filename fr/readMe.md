# Les traductions
Pour ce projet les traductions sont gérés de deux manières différentes. Pour le contenu des blocs et au maximum,
les informations sont stockées en base de données. A chaque fois que cela est nécessaire, les tables sont dupliquée
trois fois (une fois par langue).

Dans les classes concernées, il y a un constructeur qui permet de réaliser un cours traitement pour permettre d'identifier
la bonne table pour récupérer les données.

```php

protected $table = "SITE_HEBERGEMENT";

public function __construct(){

        // appel la fonction parrente pour assurer le bon fonctionnement
        parent::__construct();

        // Si la variable $_COOKIE['lang'] est null alors la valeur par défaut est fr
        $translation = $_COOKIE['lang'] ?? 'fr';

        // Le résultat est enregistrer en tant que varaible dans l'objet
        $this->table = strtoupper($translation) . '_' . $this->table;
    }
```

## Finir la traduction

Dans le dossier `assets/js/translation` se trouve les trois fichiers qui permettent de garder les différentes valeurs
d'un texte. Cela fonctionne sous forme de clée / valeur.

La clée permet de savoir à quel endroit doit être situé la valeur.

Dans les fichier html cela se présente sous la forme de :

```html
<p trad-ref='exemple'>
    Valeur par défaut
</p>
```

L'attribut 'trad-ref' permet deux choses :
- Répérer les différents attributs ayant besoin d'une traduction
- La valeur de l'attribut correspond à la clée dans le tableau associatif

/!\ Les clées doivent être unique et identique des les différentes langues /!\

Et dans le fichier de traduction, cela prend la forme de :

```js

// fr-fr
export default {
    exemple: 'Valeur dans une autre langue'
}

// en-en
export default {
    exemple: 'Default value in english'
}
```