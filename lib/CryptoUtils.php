<?php

function generateNonce()
{
    return bin2hex(random_bytes(32));
}

function timestamp()
{
    return date(DateTime::RFC3339);
}
