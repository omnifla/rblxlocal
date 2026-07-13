# APIKey
IPList is the prefered method to process private requests. It uses hashed IP addresses and compares the ones in the list to the one given.

## API
```PHP
public const NO_IPGIVEN = 'NOIPGIVEN';
    `if the ip address couldn't be found, it'll return this lol.`

function __construct(array $ipList, bool $isHashed = false)
    `requires ipList, it can be unhashed (not recommended), or hashed.
     if unhashed, it'll hash it by force.
    `

public function processRequest() : string
    `gets the client ip address and hashs it (not even a variable related to the raw ip).
     if it's unable to find it, it'll return NO_IPGIVEN.
     if it's not in the ip list, it'll return INVAILD.
     else it'll return SUCCESS.
    `
```