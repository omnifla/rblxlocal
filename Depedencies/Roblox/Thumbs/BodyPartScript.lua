local comment = 'BodyPart thumbnail'
asseturl, url, ext, h, v, guyurl, customurl = ...
pcall(function() game:GetService('ContentProvider'):SetBaseUrl(url) end)
game:GetService('ScriptContext').ScriptsDisabled = true
local guy = game:GetObjects(guyurl)[1]
guy.Parent = workspace

pcall(function()
    local objects = game:GetObjects(asseturl)
    for key, object in pairs(objects) do
        object.Parent = guy
    end
end)

pcall(function()
    game:GetObjects(customurl)[1].Parent = guy
end)

t = game:GetService('ThumbnailGenerator')
game:GetService('ThumbnailGenerator').GraphicsMode = 4
return t:Click(ext, h, v, true) 