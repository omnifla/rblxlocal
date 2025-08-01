local comment = 'Head thumbnail'
asseturl, url, ext, h, v, guyurl = ... 
pcall(function() game:GetService('ContentProvider'):SetBaseUrl(url) end)
game:GetService('ThumbnailGenerator').GraphicsMode = 4
game:GetService('ScriptContext').ScriptsDisabled = true
local guy = game:GetObjects(guyurl)[1]
guy.Parent = workspace
local mesh = game:GetObjects(asseturl)[1]
guy.Head.BrickColor = BrickColor.Gray()
guy.Head.Mesh:remove()
mesh.Parent = guy.Head
guy.Torso:remove()
guy['Right Arm']:remove()
guy['Left Arm']:remove()
guy['Right Leg']:remove()
guy['Left Leg']:remove()
t = game:GetService('ThumbnailGenerator')
return t:Click(ext, h, v, true)