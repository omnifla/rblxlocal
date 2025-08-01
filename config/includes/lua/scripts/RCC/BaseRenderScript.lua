-- BaseRenderScript.lua
-- handles setting up the env and rendering

local ThumbnailGenerator = game:GetService("ThumbnailGenerator")
local ScriptContext = game:GetService("ScriptContext")
local ContentProvider = game:GetService("ContentProvider")

local useLegacyRendering = {2}
local initEnv = function(baseUrl)
    -- graphical settings
    ThumbnailGenerator.GraphicsMode = 1
    if useLegacyRendering then
        UserSettings().GameSettings.SavedQualityLevel = Enum.SavedQualitySetting.QualityLevel1
    else 
        settings().Rendering.EnableFRM = true
        settings().Rendering.QualityLevel = Enum.QualityLevel.Level01
    end

    -- scripts
    ContentProvider:SetBaseUrl(baseUrl)
    ScriptContext.ScriptsDisabled = true
end
local getRender = function(height, width)
    return ThumbnailGenerator:Click("{0}", height, width, {1})
end

-- basic info about the render
print("Started RCC Render at JobID: " .. game.JobId)
print("EXT: {0}")
print("Hide Skys: {1}")
print("useLegacyRendering: {2}")