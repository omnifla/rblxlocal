local comment = 'Model thumbnail'
url, ext, h, v, scriptIcon, toolIcon = ...
function tryorelse(tryfunc, failfunc)
   local r
   if(pcall(function () r = tryfunc() end)) then
       return
   else
       return failfunc()
   end
end
t = game:GetService('ThumbnailGenerator')
game:GetService('ScriptContext').ScriptsDisabled = true
for _,i in ipairs(game:GetObjects(url)) do
	if i.className=='Sky' then
       return tryorelse(
           function() return t:ClickTexture(i.SkyboxFt, ext, h, v) end,
           function() return t:Click(ext, h, v, true) end)
	elseif (i.className=='Tool' or i.className=='HopperBin') and i.TextureId~='' then
       return tryorelse(
           function() return t:ClickTexture(i.TextureId, ext, h, v) end,
           function() return t:ClickTexture(toolIcon, ext, h, v) end)
	elseif i.className=='Script' then
		return t:ClickTexture(scriptIcon, ext, h, v)
	elseif i.className=='SpecialMesh' then
		part = Instance:new('Part')
		part.Parent = workspace
		i.Parent = part
		return t:Click(ext, h, v, true)
	else
		i.Parent = workspace
	end
end
return t:Click(ext, h, v, true)