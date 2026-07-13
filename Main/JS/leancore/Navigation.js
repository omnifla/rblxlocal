var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init && self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
  let window = _____WB$wombat$assign$function_____("window");
  let self = _____WB$wombat$assign$function_____("self");
  let document = _____WB$wombat$assign$function_____("document");
  let location = _____WB$wombat$assign$function_____("location");
  let top = _____WB$wombat$assign$function_____("top");
  let parent = _____WB$wombat$assign$function_____("parent");
  let frames = _____WB$wombat$assign$function_____("frames");
  let opener = _____WB$wombat$assign$function_____("opener");

// created for new skin bootstrap navigation
$(function () {
    "use strict";

    // very hack way to resolve the position issue on game page; In Jan 2015, need to redo the responsive in media query !!!!
    
    // Only use it on games page. Use media query on other pages. 
    if (($(".rbx-left-col").length == 0 || $(".rbx-left-col").width() == 0) && ($("#header-login").length != 0 || $("#GamesListsContainer").length != 0)) {
        $("#navContent").css({ 'margin-left': '0px', 'width': '100%' });
        $("#navContent").addClass('nav-no-left');
    }
    $(window).resize(function () {
        if (($(".rbx-left-col").length == 0 || $(".rbx-left-col").width() == 0) && ($("#header-login").length != 0 || $("#GamesListsContainer").length != 0)) {
            // This line causes bugs on other pages.
            $("#navContent").css({ 'margin-left': '0px', 'width': '100%' });
            $("#navContent").addClass('nav-no-left');
        } else {
            $("#navContent").css({ 'margin-left': '', 'width': '' });
        }
    });

    // Declaring constants 
    var notificationCountThreshold = 99;
    var friendsAndMessagesCountThreshold = 1000;
    var minimumSearchLength = 1;

    // Returns pending friend requests count from the view 
    function getPendingFriendsCount() {
        return $("#nav-friends") && $("#nav-friends").data() ? $("#nav-friends").data().count : 0;
    }

    function getUnreadMessagesCount() {
        return $("#nav-message") && $("#nav-message").data() ? $("#nav-message").data().count : 0;
    }

    // This function returns appropriate count text based on threshold  
    function getCountText(count, threshold) {

        if (count === 0)
            return "";

        if (count < threshold)
            return count.toString();

        switch(threshold) {
            case friendsAndMessagesCountThreshold:
                return "1k+";
            case notificationCountThreshold:
                return "99+";
            default:
                return "";
        }

    }

    //This is to update the total notification text in the header 
    function updateNotificationHeaderCount() {
        var pendingFriendships = getPendingFriendsCount();
        var unreadMessages = getUnreadMessagesCount();
        var totalNotifications = unreadMessages + pendingFriendships;
        var notificationsSelector = $('.rbx-nav-collapse .notification-red');

        if (totalNotifications == 0 && !notificationsSelector.hasClass("hide")) {
            notificationsSelector.addClass("hide");
            return;
        }
        
        var countText = getCountText(totalNotifications, notificationCountThreshold);

        //Update count Text accordingly 
        notificationsSelector.html(countText);

        //remove hide class if there are any notifications 
        if(totalNotifications > 0)
            notificationsSelector.removeClass("hide");

        //Update count tooltip value 
        notificationsSelector.attr("title", totalNotifications);
    
    }

    function updateFriendsOnNavigation() {
        var url = "/navigation/getCount";
        $.ajax({
            url: url,
            success: function (data) {
                var friendSelector = $('#nav-friends');
                var friendCountSelector = friendSelector.find(".notification-blue");

                friendSelector.attr("href", data.FriendNavigationUrl);
                friendSelector.data("count", data.TotalFriendRequests);

                friendCountSelector.html(data.DisplayCountFriendRequests);
                friendCountSelector.attr("title", data.TotalFriendRequests);

                if (data.TotalFriendRequests > 0) {
                    friendCountSelector.removeClass("hide");
                }else {
                    friendCountSelector.addClass("hide");
                }

                updateNotificationHeaderCount(data.TotalFriendRequests);
            }
        });
    }

    //Roblox.Messages.CountChanged is fired when a change in messages count happens. 
    //ui listens for this change and updates the ui-view for the navigation (i.e. update the message count  
    $(document).on('Roblox.Messages.CountChanged', function () {
        var url = Roblox.websiteLinks.GetMyUnreadMessagesCountLink;
        //Ajax call to the server to get the current messages count
        $.ajax({
            url: url,
            success: function (data) {
                var messageSelector = $("#nav-message");
                var messagesCounterSelector = $('#nav-message span.notification-blue');

                messageSelector.data("count", data.count);
                //Get count Text for Messages 
                var countText = getCountText(data.count, friendsAndMessagesCountThreshold);
                
                //Update count Text accordingly 
                messagesCounterSelector.html(countText);
                
                //Update Message count title 
                messagesCounterSelector.attr("title", data.count); //this will update or create a new title attr if one doesn't exist 

                if (data.count > 0) {
                    messagesCounterSelector.removeClass("hide");
                } else {
                    messagesCounterSelector.addClass("hide");
                }
                //Update the notification header count  
                updateNotificationHeaderCount();
            }
        });
    });

    function initializeRealTimeSubscriptions() {
        if (Roblox && Roblox.RealTime) {
            var realTimeClient = Roblox.RealTime.Factory.GetClient();
            realTimeClient.Subscribe("FriendshipNotifications", function (data) {
                switch (data.Type) {
                    case "FriendshipCreated": // friend request is accepted
                    case "FriendshipDestroyed": // remove friend
                    case "FriendshipDeclined": // friend request is declined
                    case "FriendshipRequested": // friend request is sent
                        updateFriendsOnNavigation();
                        break;
                }
            });
        }
    }

    var headerElm = $("#header");
    if (headerElm && headerElm.data("isfriendshiprealtimeupdateenabled")) {
        initializeRealTimeSubscriptions();
    }

    $(document).on("Roblox.Friends.CountChanged", function () {
        updateFriendsOnNavigation();
    });

    // toggle the navigation notification icon
    $('[data-behavior="nav-notification"]').click(function () {
        $('[data-behavior="left-col"]').toggleClass("nav-show", 100);
    });

    //SEARCH
    var searchElem = $('#navbar-universal-search');
    var searchInput = $('#navbar-universal-search #navbar-search-input');
    var searchOptions = $('#navbar-universal-search .rbx-navbar-search-option');
    var searchBtn = $('#navbar-universal-search #navbar-search-btn');
    function cycleUniversalSearchSelection(event) {
        var searchOptions = $('[data-behavior="univeral-search"] .rbx-navbar-search-option');
        var selectedIndex = -1;
        $.each(searchOptions, function (index, elem) {
            if ($(elem).hasClass('selected')) {
                $(elem).removeClass('selected');
                selectedIndex = index;
            }
        });
        if (event.which === 38) {
            selectedIndex += searchOptions.length - 1;
        } else {
            selectedIndex += 1;
        }
        selectedIndex %= searchOptions.length;
        $(searchOptions[selectedIndex]).addClass('selected');
    }

    searchInput.on('keydown', function (event) {
        var query = $(this).val();
        if ((event.which === 9 || event.which === 38 || event.which === 40) && query.length > 0) {
            event.stopPropagation();
            event.preventDefault();
            cycleUniversalSearchSelection(event);
        }
    });

    searchInput.on('keyup', function (event) {
        var query = $(this).val();
        if (event.which === 13) {
            event.stopPropagation();
            event.preventDefault();
            var selectedOption = searchElem.find('.rbx-navbar-search-option.selected');
            var searchUrl = selectedOption.data('searchurl');

            if (query.length >= minimumSearchLength) {
                window.location = searchUrl + encodeURIComponent(query);
            }
        }
        else if (query.length > 0) {
            searchElem.toggleClass('rbx-navbar-search-open', true);
            $('[data-toggle="dropdown-menu"] .rbx-navbar-search-string').text('"' + query + '"');
        } else {
            searchElem.toggleClass('rbx-navbar-search-open', false);
        }
    });

    searchBtn.click(function (event) {
        event.stopPropagation();
        event.preventDefault();
        var query = searchInput.val();
        var selectedOption = $('#navbar-universal-search .rbx-navbar-search-option.selected');
        var searchUrl = selectedOption.data('searchurl');

        if (query.length >= minimumSearchLength) {
            window.location = searchUrl + encodeURIComponent(query);
        }
    });

    searchOptions.on("click touchstart", function (event) {
        event.stopPropagation();
        var query = searchInput.val();
        if (query.length >= minimumSearchLength) {
            var searchUrl = $(this).data('searchurl');
            window.location = searchUrl + encodeURIComponent(query);
        }
    });
    searchOptions.on("mouseover", function () {
        searchOptions.removeClass('selected');
        $(this).addClass('selected');
    });

    searchInput.on('focus', function () {
        var query = searchInput.val();
        if (query.length > 0) {
            searchElem.addClass('rbx-navbar-search-open');
        }
    });

    $('[data-toggle="toggle-search"]').on('click touchstart', function (e) {
        e.stopPropagation();
        $('[data-behavior="univeral-search"]').toggleClass("show");
        return false;
    });

    //logout link
    $('.rbx-navbar-right').on('click touchstart', '[data-behavior="logout"]', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var elem = $(this);
        if (typeof angular !== "undefined" && !angular.isUndefined(angular.element("#chat-container").scope())) {
            var scope = angular.element("#chat-container").scope();
            scope.$digest(scope.$broadcast('Roblox.Chat.destroyChatCookie'));
        }
        $.post(elem.attr('data-bind'), { redirectTohome: false }, function (data) {
            var url = Roblox && Roblox.Endpoints ? Roblox.Endpoints.getAbsoluteUrl("/") : "/";
            window.location.href = url; 
           });
        });

    $('#nav-robux-icon').on('show.bs.popover', function () {
        $("body").scrollLeft(0);
        });

    // if IsSignupOrLoginRenderInIframeEnabled is off, the receiveMessage function will fall back here
    var ParseMessage = function (msg) {
        if (msg.indexOf("resize") != -1) {
            //msg = "resize,270px"
            var args = msg.split(',');
            $('#iframe-login').css({ 'height': args[1] });
        }
        if (msg.indexOf("fbRegister") != -1) {
            var args = msg.split('^');
            var qs = "&fbname=" + encodeURIComponent(args[1]) + "&fbem=" + encodeURIComponent(args[2]) + "&fbdt=" + encodeURIComponent(args[3]);
            window.location.href = "../Login/Default.aspx?iFrameFacebookSync=true" + qs;
        }
    };
    $.receiveMessage(function (e) {
        ParseMessage(e.data);
    });

    // close drop down
    $('body').on('click touchstart', function (e) {
        $('[data-behavior="univeral-search"]').each(function () {
            //the 'is' for links that trigger popups
            //the 'has' for icons within a link that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0) {
                $(this).removeClass('rbx-navbar-search-open');
            }

            if ($(this).has(e.target).length === 0 &&
                $('[data-toggle="toggle-search"]').has(e.target).length === 0 &&
                $('[data-behavior="univeral-search"]').css("display") === "block") {
                $('[data-behavior="univeral-search"]').removeClass("show");
            }
        });
        if ((!$(e.target).closest('#iFrameLogin').length && !$(e.target).is('#iFrameLogin')) &&
            (!$(e.target).closest('#head-login').length && !$(e.target).is('#head-login'))) {
            if ($('#iFrameLogin').hasClass("show")) {
                $('#iFrameLogin').removeClass("show");
            }
        }
    });
    var linkSignupOrLoginModal = function () {
        $('#header-login').click(function (e) {
            var signupOrLoginProperties = {
                onSignupSuccess: function (userId) {
                    window.location.reload();
                },
                onLoginSuccess: function (userId) {
                    window.location.reload();
                },
                sectionType: Roblox.SignupOrLogin.SectionType.login
            }
            Roblox.SignupOrLoginModal.show(signupOrLoginProperties);

        });

 
        $('#header-signup').click(function (e) {
            var signupOrLoginProperties = {
                onSignupSuccess: function (userId) {
                    window.location.reload();
                },
                onLoginSuccess: function (userId) {
                    window.location.reload();
                },
                sectionType: Roblox.SignupOrLogin.SectionType.signup
            }
            Roblox.SignupOrLoginModal.show(signupOrLoginProperties);
        });
    }
    var loginModal = function () {
        $('#head-login').click(function (e) {
            $('#iFrameLogin').toggleClass("show");
            if ($('#iFrameLogin').hasClass("show")) {
                var pos = ($('#head-login').offset().left - $('#iFrameLogin').offset().left) - 250;
                if (pos > 0) {
                    $('#iFrameLogin').css("left", pos);
                }
            }
        });
    }

    var signupOrLoginIframe = $('#signupOrLoginIframe');
    if (signupOrLoginIframe.length) {
        signupOrLoginIframe.load(function (e) {
            linkSignupOrLoginModal();
        });
    }
    else {
        linkSignupOrLoginModal();
    }
    loginModal();
});

}
/*
     FILE ARCHIVED ON 00:37:01 Jan 01, 2017 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:42:05 Apr 26, 2024.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 1.898
  exclusion.robots: 0.308
  exclusion.robots.policy: 0.276
  cdx.remote: 0.198
  esindex: 0.025
  LoadShardBlock: 481.238 (3)
  PetaboxLoader3.datanode: 323.754 (4)
  load_resource: 237.492
  PetaboxLoader3.resolve: 166.079
*/