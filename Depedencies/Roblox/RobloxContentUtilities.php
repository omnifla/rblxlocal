<?php

namespace Roblox;

class RobloxContentUtilities
{
    public static string $DefaultDecal = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<roblox xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd">
  <Item class="Decal">
    <Properties>
      <Property name="Texture" class="Texture" />
    </Properties>
  </Item>
</roblox>
XML;
}
