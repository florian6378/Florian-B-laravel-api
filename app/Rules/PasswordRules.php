<?php

namespace App\Rules;
use Illuminate\Validation\Rule;

class CustomPasswordRule implements Rule 
    

{
    public function passes($attribute, $value)
    {
        // Ajoutez votre règle de validation personnalisée ici
        $passwordValid = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]+$/', $value);
    
        // Vérifie si le champ 'image' est non vide
        $imageNotEmpty = !empty($value);
        
        // Return true si les deux conditions sont vraies
        return $passwordValid && $imageNotEmpty;
    }

    public function message()
    {
        return 'The :attribute must contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
    }
}
