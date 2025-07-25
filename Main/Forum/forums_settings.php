<?php
// written by meditext
// this system puts in place all forums and it's desiginated groups.
// i'd plan on making unlisted forum ids.
$forums = [
    "ROBLOX" => [
        "ID" => 1,
        "Forums" => [
            [
                "Name" => "All Things ROBLOX",
                "ID" => 46,
                "Description" => "The area for discussions purely about ROBLOX – the features, the games, and company news.",
                "IsActive" => true,
            ],
            [
                "Name" => "Help (Technical Support and Account Issues)",
                "ID" => 14,
                "Description" => "Seeking account or technical help? Post your questions here.",
                "IsActive" => true,
            ],
            [
                "Name" => "Video Creations with ROBLOX",
                "ID" => 52,
                "Description" => "Specifically for videos recorded in the ROBLOX game. Use this forum to announce your Twitch.tv or YouTube channel, and to find actors, set builders, and other contributors for your video project.",
                "IsActive" => true,
            ],
            [
                "Name" => "Suggestions & Ideas",
                "ID" => 21,
                "Description" => "Do you have a suggestion and ideas for ROBLOX? Share your feedback here.",
                "IsActive" => true,
            ],
            [
                "Name" => "BLOXFaires Around the Globe",
                "ID" => 54,
                "Description" => "ROBLOX is going to be at various Maker Faires and conferences around the globe. Discuss those events here!",
                "IsActive" => true,
            ],
            [
                "Name" => "ROBLOX Contests",
                "ID" => 43,
                "Description" => "Get involved with ROBLOX Contests! We're discussing ongoing and future contests in this forum.",
                "IsActive" => true,
            ],
            [
                "Name" => "I Made That",
                "ID" => 44,
                "Description" => "Calling all creative ROBLOXians! Model builders, clothing creators, decal artists and re-texturers - this is your forum.",
                "IsActive" => true,
            ],
        ]
    ],
    "Developer Information" => [
        "ID" => 3,
        "Forums" => [
            [
                "Name" => "Release notes",
                "ID" => 16,
                "Description" => "Information on the latest ROBLOX releases.",
                "IsActive" => true,
            ],
        ]
    ],
    "Club Houses" => [
        "ID" => 8,
        "Forums" => [
            [
                "Name" => "ROBLOX Talk",
                "ID" => 13,
                "Description" => "A popular hangout where ROBLOXians talk about various topics.",
                "IsActive" => true,
            ],
            [
                "Name" => "Off Topic",
                "ID" => 18,
                "Description" => "When no other forum makes sense for your post, Off Topic will help it make even less sense.",
                "IsActive" => true,
            ],
            [
                "Name" => "Clans & Guilds",
                "ID" => 32,
                "Description" => "Talk about what’s going on in your Clans, Groups, Companies, and Guilds, and about the Groups feature in general.",
                "IsActive" => true,
            ],
            [
                "Name" => "Let's Make a Deal",
                "ID" => 35,
                "Description" => "A fast paced community dedicated to mastering the Limited Trades and Sales market, and divining the subtleties of the ROBLOX Currency Exchange.",
                "IsActive" => true,
            ],
            [
                "Name" => "Global Chat",
                "ID" => 45,
                "Description" => "This forum is the place to discuss the country you are from, world travel, find online pen pals.",
                "IsActive" => true,
            ],
        ]
    ],
    "Game Creation and Development" => [
        "ID" => 9,
        "Forums" => [
            [
                "Name" => "Building Helpers",
                "ID" => 19,
                "Description" => "Learn the ins and outs of building structures in ROBLOX. Share your techniques with other builders, discuss designs, and draft plans. Help others!",
                "IsActive" => true,
            ],
            [
                "Name" => "Scripting Helpers",
                "ID" => 20,
                "Description" => "Need help with a script you are writing? Need to edit an existing script? This is the place to share your 1337 Lua programming skills and help others.",
                "IsActive" => true,
            ],
            [
                "Name" => "Game Design",
                "ID" => 40,
                "Description" => "The place to discuss about the novel game ideas that you are possibly working on. This is not the place to hire people nor post help requests.",
                "IsActive" => true,
            ],
            [
                "Name" => "Game Test",
                "ID" => 37,
                "Description" => "This is the place to post about www.gametest1.roblox.com about the ROBLOX game and Studio. [Note: Test servers may not be up all the time.]",
                "IsActive" => true,
            ],
            [
                "Name" => "Website Test",
                "ID" => 36,
                "Description" => "Post about sitetest.roblox.com about ROBLOX website features here. [Note: Test servers may not be up all the time.]",
                "IsActive" => true,
            ],
            [
                "Name" => "ROBLOX Mobile",
                "ID" => 41,
                "Description" => "Discuss mobile versions of the ROBLOX website, the iPhone app, and playing ROBLOX on the iPad.",
                "IsActive" => true,
            ],
            [
                "Name" => "ROBLOX Studio",
                "ID" => 39,
                "Description" => "This is the place to post about ROBLOX Studio for Mac and Windows.",
                "IsActive" => true,
            ],
            [
                "Name" => "Scripters",
                "ID" => 33,
                "Description" => "This is the place for discussion about scripting. Anything about scripting that is not a help request or topic belongs here.",
                "IsActive" => true,
            ],

        ]
    ],
    "Entertainment" => [
        "ID" => 6,
        "Forums" => [
            [
                "Name" => "Video Game Fans",
                "ID" => 42,
                "Description" => "Talk about your favorite video and computer games outside of ROBLOX, with other fanatical video gamers!",
                "IsActive" => true,
            ],
            [
                "Name" => "Forum Games",
                "ID" => 38,
                "Description" => "Post your most hilarious forum games here. Who's the best at typing with their elbows? Give gifts to the person above you. Play classic forum games and make up new ones!",
                "IsActive" => true,
            ],
            [
                "Name" => "Sports Fans",
                "ID" => 26,
                "Description" => "Hang out with other ROBLOX sports fans and talk about sports and competitive activities.",
                "IsActive" => true,
            ],
            [
                "Name" => "Music Talk",
                "ID" => 24,
                "Description" => "Does your Robloxian rock? Let people know. Or just talk about your favorite bands.",
                "IsActive" => true,
            ],
            [
                "Name" => "Movies/TV/Books",
                "ID" => 25,
                "Description" => "Does your Robloxian belong on the silver screen, or in the pages of a novel? Show off your ROBLOX movie star, discuss your favorite TV series, films, and the books you love.",
                "IsActive" => true,
            ],
            [
                "Name" => "Role-Playing",
                "ID" => 23,
                "Description" => "The forum for story telling and imagination. Start a role-playing thread here involving your fictional characters, or role-play out a scenario with other players.",
                "IsActive" => true,
            ],
        ]
    ],
];
?>