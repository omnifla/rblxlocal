local comment = 'Shirt thumbnail'
asseturl, ext, h, v, url, guyurl = ...
pcall(function() game:GetService('ContentProvider'):SetBaseUrl(url) end)
game:GetService('ScriptContext').ScriptsDisabled = true
local guy = game:GetObjects(guyurl)[1]
guy.Parent = workspace
c = Instance.new('Shirt')
c.ShirtTemplate = game:GetObjects(asseturl)[1].ShirtTemplate
c.Parent = guy
t = game:GetService('ThumbnailGenerator')
game:GetService('ThumbnailGenerator').GraphicsMode = 4
return t:Click(ext, h, v, true)