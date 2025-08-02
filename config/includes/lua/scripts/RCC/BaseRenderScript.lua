-- BaseRenderScript.lua
-- handles setting up the env and rendering
-- TODO: enable soap args

local ThumbnailGenerator = game:GetService("ThumbnailGenerator")
local ScriptContext = game:GetService("ScriptContext")
local ContentProvider = game:GetService("ContentProvider")

local DEFAULT_BASE_URL = "http://roblox.com/"
local initEnv = function(baseUrl)
    if not baseUrl then
        warn("baseUrl is nil, please define it. Using " .. DEFAULT_BASE_URL)
        baseUrl = DEFAULT_BASE_URL
        getfenv(0).baseUrl = DEFAULT_BASE_URL
    end

    -- graphical settings
    ThumbnailGenerator.GraphicsMode = 1
    UserSettings().GameSettings.SavedQualityLevel = Enum.SavedQualitySetting.QualityLevel1

    -- scripts
    ContentProvider:SetBaseUrl(baseUrl)
    ScriptContext.ScriptsDisabled = true
end
local getRender = function(ext, height, width, hideSkys) -- make this a function so we can add webhook logging later
    return ThumbnailGenerator:Click(ext, height, width, hideSkys)
end

-- basic info about the render
print("Started RCC Render at JobID: " .. game.JobId)