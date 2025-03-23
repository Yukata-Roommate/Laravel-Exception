<?php

return [
    "enable" => [
        "logging" => env("YR_EXCEPTION_ENABLE_LOGGING", false),
        "mailing" => env("YR_EXCEPTION_ENABLE_MAILING", false),
    ],

    "mailing" => [
        "subject" => env("YR_EXCEPTION_MAILING_SUBJECT", "Exception Occurred"),

        "from" => [
            "address" => env("YR_EXCEPTION_MAILING_FROM_ADDRESS", null),
            "name"    => env("YR_EXCEPTION_MAILING_FROM_NAME", null),
        ],

        "to" => [
            env("YR_EXCEPTION_MAILING_TO_NAME", "") => env("YR_EXCEPTION_MAILING_TO_ADDRESS", ""),
        ],
    ],
];
