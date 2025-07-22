# APIKey
> [!CAUTION]
> If creating new apis that require a whitelist, DO NOT USE THIS.
> It can be insecure as if the key leaks, the whole thing is going to shit.

APIKey is a way to accept requests that have permission. This method requires you to make a get request and send a param called `apiKey`.

## API
```PHP
function __construct(?string $key = null)
    `creates a new class, if $key is empty then it'll default to defaultAPIKey`

public function processRequest() : string
    `processes the current request, if apiKey is not provided, it'll throw an error.
     compares the given api key to the accepted one, if correct then it'll return SUCCESS.
     else, it'll return an INVAILD.
    `
```