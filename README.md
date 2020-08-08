# IPLocator Service #
## Introduction ##
Provided with a IPV4 IP-address, this service will respond with at minimum, the *country-code* corresponding to that IP-address. The service relies on a number of external providers of IP-address-to-location mapping. The current default servide is free of charge, others will incur cost, at the conditions set by those providers.

## Requirements ##
- See version 5.1 of [Symfony requirements] (https://symfony.com/doc/current/setup.html)
- A local installation of composer commandline util - See [composer online] (https://getcomposer.org)

## Installation - Using Composer ##
Using a terminal application...

- `CD` to root directory of this project - the same as the location of the outermost occurence of the file `composer.json`
- Copy file `.env.dist` to `.env`
- run command 'composer install'

The installer will install all composer dependencies, while resulting in a failure to run the symfony console, don´t worry- this is for now normal behavior, and the service works as inteded.


## Usage ##
The service can in development be run in the serverless PHP-mode, e.g. started as a process oín a terminal:
`php -S localhost public/index.php`, assuming that your current working-directory is the root directory of this project.

The service currently has one main entrypoint from a client-perspective - A single HTTP URL endpoint to be called with an optional `ip` `GET` argument:
E.g.: [Default localhost on port 80] (http://localhost?ip=127.0.0.1)

Omitting the optional `ip` argument in the HTTP call, will default to the IP as publically broadcast by the client issuing the call to this service.

A successful response from the service, will be a full JSON HTTP response, including at minimum the country-code for the IP-address as sent in the request:

- `{"status":"success","countryCode":"DK", "query":"IP_ADDRESS_REQUESTED"}`

A failed response (invalid IP-address sent as request), will at minimum have this JSON data:

- `{"status":"fail", "query":"IP_ADDRESS_REQUESTED"}`

## Development logging ##
Make sure to observe the logfiles in development, kept in `./var/log` directory - they will contain verbose success and failure messages.

## TO-DO's ##
- Emit JSON-response on default controller - more broadly, emit a response-type matching that of the client - first candidates are JSON and HTML (plain text).
- Properly handle localhost/non-locatable (non-public) IP addresses to return meaningful responses, and with exceptions in a sensible manner
- Provide a more flexible default IP-address for primarily testing, as prepared in services.yaml of the main project (`src/config/services.yaml`)
- Include PHP code-beautifier and codesniffer level tests in git-commit scenario, so commits are only possible when PHP code is well-formed, and adhere's to PSR-12 guidelines

