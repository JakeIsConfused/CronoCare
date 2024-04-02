<?php
/**
* @return array
 **/
function getInfo()
{
    return [
        [
            "id" => 1,
            "name" => "Warden",
            "img" => "data:image/jpeg;base64,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"

        ],
        [
            "id" => 2,
            "name" => "Conqueror",
            "img" =>"data:image/jpeg;base64,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"
        ],
    ];
}
