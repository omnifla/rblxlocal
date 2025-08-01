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
        face.Texture = "rbxassetid://1819"
    end
end

initEnv("http://{3}/")
wait() -- wait before we render or else it'll fuck up
createObject("{4}")
print(getRender({5}, {6}))