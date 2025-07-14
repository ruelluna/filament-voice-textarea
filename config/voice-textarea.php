<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Language for Speech Recognition
    |--------------------------------------------------------------------------
    |
    | This value determines the default language used for speech recognition.
    | The language should be in the format 'language-COUNTRY' (e.g., 'en-US').
    |
    */
    'default_language' => env('VOICE_TEXTAREA_LANGUAGE', 'en-US'),

    /*
    |--------------------------------------------------------------------------
    | Continuous Recognition
    |--------------------------------------------------------------------------
    |
    | This value determines whether speech recognition should continue
    | listening after the user stops speaking.
    |
    */
    'continuous_recognition' => env('VOICE_TEXTAREA_CONTINUOUS', true),

    /*
    |--------------------------------------------------------------------------
    | Interim Results
    |--------------------------------------------------------------------------
    |
    | This value determines whether to show interim (temporary) results
    | while the user is speaking.
    |
    */
    'interim_results' => env('VOICE_TEXTAREA_INTERIM_RESULTS', true),

    /*
    |--------------------------------------------------------------------------
    | Maximum Recognition Time (seconds)
    |--------------------------------------------------------------------------
    |
    | This value determines the maximum time (in seconds) that speech
    | recognition will continue listening before automatically stopping.
    | Set to null for no limit.
    |
    */
    'max_recognition_time' => env('VOICE_TEXTAREA_MAX_TIME', null),

    /*
    |--------------------------------------------------------------------------
    | Supported Languages
    |--------------------------------------------------------------------------
    |
    | This array contains the supported languages for speech recognition.
    | Users can choose from these languages if needed.
    |
    */
    'supported_languages' => [
        'en-US' => 'English (US)',
        'en-GB' => 'English (UK)',
        'es-ES' => 'Spanish (Spain)',
        'es-MX' => 'Spanish (Mexico)',
        'fr-FR' => 'French (France)',
        'de-DE' => 'German (Germany)',
        'it-IT' => 'Italian (Italy)',
        'pt-BR' => 'Portuguese (Brazil)',
        'pt-PT' => 'Portuguese (Portugal)',
        'ru-RU' => 'Russian (Russia)',
        'ja-JP' => 'Japanese (Japan)',
        'ko-KR' => 'Korean (South Korea)',
        'zh-CN' => 'Chinese (Simplified)',
        'zh-TW' => 'Chinese (Traditional)',
    ],
];
