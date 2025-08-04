-- BaseRenderScript.lua inserted above --

local characterAppearanceUrl, baseUrl, fileExtension, x, y, useLegacyRendering = ...
local Players = game:GetService("Players")
local createObject = function()
    local player = Players:CreateLocalPlayer(0)
    player.CharacterAppearance = characterAppearanceUrl
    player:LoadCharacter(false)

    if useLegacyRendering then -- this doesn't work, leave this be for now
        local character = player.Character
        local head = character.Head
        local face = head:WaitForChild("face")
        face.Texture = "http://rblx.local/asset?id=1819"
    end
end

print("Player RCC Render Info:")
print("characterAppearanceUrl, baseUrl, fileExtension, x, y")
print(characterAppearanceUrl, baseUrl, fileExtension, x, y)

initEnv(baseUrl)
createObject()
return getRender(fileExtension, x, y, true)