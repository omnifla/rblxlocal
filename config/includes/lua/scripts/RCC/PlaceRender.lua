-- BaseRenderScript.lua inserted above --

local placeId, baseUrl, fileExtension, x, y = ...
local StarterGui = game:GetService("StarterGui")
local createObject = function()
    game:ClearContent(true)

    game:Load(baseUrl .. "/asset?id=" .. placeId) -- TODO: add a secure api system
    StarterGui.ShowDevelopmentGui = false
end

print("Place RCC Render Info:")
print("characterAppearanceUrl, baseUrl, fileExtension, x, y")
print(placeId, baseUrl, fileExtension, x, y)

initEnv(baseUrl)
createObject()
return getRender(fileExtension, x, y, false)