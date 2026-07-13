local comment = 'Gear thumbnail'
url, baseUrl, ext, h, v  = ...
pcall(function() game:GetService('ContentProvider'):SetBaseUrl(baseUrl) end)
game:GetService('ThumbnailGenerator').GraphicsMode = 4
t = game:GetService('ThumbnailGenerator')
game:GetService('ScriptContext').ScriptsDisabled = true
for _,i in ipairs(game:GetObjects(url)) do
	i.Parent = workspace
end
return t:Click(ext, h, v, true)