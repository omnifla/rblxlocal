-- BaseRenderScript.lua inserted here --

local Players = game:GetService("Players")
local createObject = function(characterAppearance)
    local player = Players:CreateLocalPlayer(0)
    player.CharacterAppearance = characterAppearance
    player:LoadCharacter(false)

    if useLegacyRendering then
        local character = player.Character
        local head = character.Head
        local face = head:WaitForChild("face")
        face.Texture = "http://{3}/asset?id=1819"
    end
end

print("Player render info :")
print("Site: {3}")
print("CharApp: {4}")
print("Height: {5}, Width: {6}")

initEnv("http://{3}/")
createObject("{4}")
return getRender({5}, {6})