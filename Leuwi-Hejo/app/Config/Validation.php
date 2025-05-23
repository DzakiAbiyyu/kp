<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        \Myth\Auth\Authentication\Passwords\ValidationRules::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $registrationRules = [
        'username' => [
            'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email]',
        ],
        'password' => [
            'rules' => 'required|strong_password',
        ],
        'pass_confirm' => [
            'rules' => 'required|matches[password]',
        ],
    ];
}
