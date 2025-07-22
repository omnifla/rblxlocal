# SecureRoot
> [!IMPORTANT]
> This shouldn't be used in production, instead use APIKey or IPList for grabbing IP addresses.

SecureRoot is a class every SecureAPI thing bases off of.

## API
```PHP
public const SUCCESS = 'SUCCESS';
    `if something is vaild, this is returned`
public const INVAILD = 'INVAILD';
    `if something went wrong, this is returned`

public function getChecksum(string $givenStr) : string
    `returns a sha256 hash`

public function getIPAddress() : string
    `returns the current ip address, returns 'UNKNOWN' if not able to`
```