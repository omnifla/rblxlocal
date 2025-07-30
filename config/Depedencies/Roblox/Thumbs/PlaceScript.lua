local comment = 'Place thumbnail'
url, ext, x, y = ...
game:GetService('ContentProvider'):SetBaseUrl(url)
game:GetService('ThumbnailGenerator').GraphicsMode=4
game:GetService('ScriptContext').ScriptsDisabled=true game:Load(url) return game:GetService('ThumbnailGenerator'):Click(ext, x, y, false)