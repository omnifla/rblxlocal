local comment = "Avatar Renderer"
characterAppearanceUrl, baseUrl, fileExtension, x, y = ...
pcall(function() game:GetService("ContentProvider"):SetBaseUrl(baseUrl) end)
game:GetService("ScriptContext").ScriptsDisabled = true
local player = game:GetService("Players"):CreateLocalPlayer(0)
player.CharacterAppearance = characterAppearanceUrl
player:LoadCharacter(false)
if player.Character then
	for _, child in pairs(player.Character:GetChildren()) do
		if child:IsA("Tool") then
			player.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(90)
			break
		end
	end
end
local t = game:GetService('ThumbnailGenerator')
game:GetService('ThumbnailGenerator').GraphicsMode = 4
local res = t:Click(fileExtension, x, y, true) 
return res