<?php

return [
    /*----------------------------------------*
     * Basic
     *----------------------------------------*/

    "enable" => [
        "logging" => env("YR_EXCEPTION_ENABLE_LOGGING", false),
        "mailing" => env("YR_EXCEPTION_ENABLE_MAILING", false),
    ],


    /*----------------------------------------*
     * Logging
     *----------------------------------------*/

    "logging" => [
        "base_directory" => env("YR_EXCEPTION_LOGGING_BASE_DIRECTORY", storage_path("logs")),
        "directory"      => env("YR_EXCEPTION_LOGGING_DIRECTORY", "exception"),
        "file"           => [
            "name_format" => env("YR_EXCEPTION_LOGGING_FILE_NAME_FORMAT", "Y-m-d"),
            "extension"   => env("YR_EXCEPTION_LOGGING_FILE_EXTENSION", "log"),
            "mode"        => env("YR_EXCEPTION_LOGGING_FILE_MODE", 0666),
            "owner"       => env("YR_EXCEPTION_LOGGING_FILE_OWNER", null),
            "group"       => env("YR_EXCEPTION_LOGGING_FILE_GROUP", null),
        ],
    ],

    /*----------------------------------------*
     * Mailing
     *----------------------------------------*/

    "mailing" => [
        "subject" => env("YR_EXCEPTION_MAILING_SUBJECT", "Exception Occurred"),

        "from" => [
            "address" => env("YR_EXCEPTION_MAILING_FROM_ADDRESS", null),
            "name"    => env("YR_EXCEPTION_MAILING_FROM_NAME", null),
        ],

        "to" => [],
    ],
];
