@ -1,129 +0,0 @@
-- SQL Schema for ROBLOX Forum

-- Drop tables if they exist to start fresh
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS threads;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS forums;
DROP TABLE IF EXISTS forum_groups;

-- Table for forum groups
CREATE TABLE forum_groups (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0
);

-- Table for forums
CREATE TABLE forums (
    id SERIAL PRIMARY KEY,
    group_id INT NOT NULL REFERENCES forum_groups(id),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    threads_count INT NOT NULL DEFAULT 0,
    posts_count INT NOT NULL DEFAULT 0,
    sort_order INT NOT NULL DEFAULT 0
);

-- Table for users
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    post_count INT NOT NULL DEFAULT 0
);

-- Table for threads
CREATE TABLE threads (
    id SERIAL PRIMARY KEY,
    forum_id INT NOT NULL REFERENCES forums(id),
    user_id INT NOT NULL REFERENCES users(id),
    subject VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_post_at TIMESTAMP,
    last_post_user_id INT REFERENCES users(id),
    views_count INT NOT NULL DEFAULT 0,
    replies_count INT NOT NULL DEFAULT 0,
    is_pinned BOOLEAN NOT NULL DEFAULT FALSE,
    is_locked BOOLEAN NOT NULL DEFAULT FALSE,
    is_popular BOOLEAN NOT NULL DEFAULT FALSE
);

-- Table for posts
CREATE TABLE posts (
    id SERIAL PRIMARY KEY,
    thread_id INT NOT NULL REFERENCES threads(id),
    user_id INT NOT NULL REFERENCES users(id),
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Seed data for forum groups
INSERT INTO forum_groups (id, name, sort_order) VALUES
(1, 'ROBLOX', 1),
(8, 'Club Houses', 2),
(9, 'Game Creation and Development', 3),
(6, 'Entertainment', 4);

-- Seed data for forums
INSERT INTO forums (id, group_id, name, description, sort_order) VALUES
-- ROBLOX Group
(46, 1, 'All Things ROBLOX', 'The area for discussions purely about ROBLOX – the features, the games, and company news.', 1),
(14, 1, 'Help (Technical Support and Account Issues)', 'Seeking account or technical help? Post your questions here.', 2),
(52, 1, 'Video Creations with ROBLOX', 'Specifically for videos recorded in the ROBLOX game. Use this forum to announce your Twitch.tv or YouTube channel, and to find actors, set builders, and other contributors for your video project.', 3),
(21, 1, 'Suggestions & Ideas', 'Do you have a suggestion and ideas for ROBLOX? Share your feedback here.', 4),
(54, 1, 'BLOXFaires Around the Globe', 'ROBLOX is going to be at various Maker Faires and conferences around the globe. Discuss those events here!', 5),
(43, 1, 'ROBLOX Contests', 'Get involved with ROBLOX Contests! We''re discussing ongoing and future contests in this forum.', 6),
(44, 1, 'I Made That', 'Calling all creative ROBLOXians! Model builders, clothing creators, decal artists and re-texturers - this is your forum.', 7),
-- Club Houses Group
(13, 8, 'ROBLOX Talk', 'A popular hangout where ROBLOXians talk about various topics.', 1),
(18, 8, 'Off Topic', 'When no other forum makes sense for your post, Off Topic will help it make even less sense.', 2),
(32, 8, 'Clans & Guilds', 'Talk about what’s going on in your Clans, Groups, Companies, and Guilds, and about the Groups feature in general.', 3),
(35, 8, 'Let''s Make a Deal', 'A fast paced community dedicated to mastering the Limited Trades and Sales market, and divining the subtleties of the ROBLOX Currency Exchange.', 4),
(45, 8, 'Global Chat', 'This forum is the place to discuss the country you are from, world travel, find online pen pals.', 5),
-- Game Creation and Development Group
(19, 9, 'Building Helpers', 'Learn the ins and outs of building structures in ROBLOX. Share your techniques with other builders, discuss designs, and draft plans. Help others!', 1),
(20, 9, 'Scripting Helpers', 'Need help with a script you are writing? Need to edit an existing script? This is the place to share your 1337 Lua programming skills and help others.', 2),
(40, 9, 'Game Design', 'The place to discuss about the novel game ideas that you are possibly working on. This is not the place to hire people nor post help requests.', 3),
(37, 9, 'Game Test', 'This is the place to post about www.gametest1.roblox.com about the ROBLOX game and Studio. [Note: Test servers may not be up all the time.]', 4),
(36, 9, 'Website Test', 'Post about sitetest.roblox.com about ROBLOX website features here. [Note: Test servers may not be up all the time.]', 5),
(41, 9, 'ROBLOX Mobile', 'Discuss mobile versions of the ROBLOX website, the iPhone app, and playing ROBLOX on the iPad.', 6),
(39, 9, 'ROBLOX Studio', 'This is the place to post about ROBLOX Studio for Mac and Windows.', 7),
(33, 9, 'Scripters', 'This is the place for discussion about scripting. Anything about scripting that is not a help request or topic belongs here.', 8),
-- Entertainment Group
(42, 6, 'Video Game Fans', 'Talk about your favorite video and computer games outside of ROBLOX, with other fanatical video gamers!', 1);

-- Seed data for users
INSERT INTO users (id, username) VALUES
(1, 'admin'),
(2, 'guest'),
(3, 'TestUser1'),
(4, 'TestUser2');

-- Seed data for threads
INSERT INTO threads (id, forum_id, user_id, subject, last_post_at, last_post_user_id, replies_count, views_count, is_pinned, is_locked, is_popular) VALUES
(1, 46, 1, 'Welcome to the forums!', NOW() - INTERVAL '1 DAY', 2, 1, 100, true, false, false),
(2, 46, 3, 'My first thread', NOW(), 4, 1, 50, false, false, true),
(3, 14, 1, 'I need help with my account!', NOW() - INTERVAL '2 HOURS', 1, 0, 25, false, true, false);

-- Seed data for posts
INSERT INTO posts (thread_id, user_id, content, created_at) VALUES
(1, 1, 'This is the first post in the pinned thread.', NOW() - INTERVAL '1 DAY'),
(1, 2, 'This is a reply to the pinned thread.', NOW() - INTERVAL '1 DAY' + INTERVAL '1 HOUR'),
(2, 3, 'Hello world!', NOW() - INTERVAL '1 HOUR'),
(2, 4, 'Nice to meet you!', NOW());

-- Update counts
UPDATE forums SET
    threads_count = (SELECT COUNT(*) FROM threads WHERE forum_id = forums.id),
    posts_count = (SELECT COUNT(*) FROM posts p JOIN threads t ON p.thread_id = t.id WHERE t.forum_id = forums.id);

UPDATE threads SET
    replies_count = (SELECT COUNT(*) - 1 FROM posts WHERE thread_id = threads.id);

-- Set sequence values to avoid conflicts with manual ID insertion
SELECT setval('forum_groups_id_seq', (SELECT MAX(id) FROM forum_groups), true);
SELECT setval('forums_id_seq', (SELECT MAX(id) FROM forums), true);
SELECT setval('users_id_seq', (SELECT MAX(id) FROM users), true);
SELECT setval('threads_id_seq', (SELECT MAX(id) FROM threads), true);
SELECT setval('posts_id_seq', (SELECT MAX(id) FROM posts), true);