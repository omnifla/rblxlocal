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

if (typeof window.localStorage === 'undefined' || typeof window.sessionStorage === 'undefined') (function () {
    var Storage = function (type) {
        var bUnloadListenerApplied = false,
            cookieName = "localStorage";

        function readCookie() {
            var nameEq = cookieName + "=",
                ca = document.cookie.split(';'),
                i, c;

            for (i = 0; i < ca.length; i++) {
                c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1, c.length);
                }

                if (c.indexOf(nameEq) === 0) {
                    return c.substring(nameEq.length, c.length);
                }
            }
            return null;
        }

        function setData(data) {
            data = data.length ? JSON.stringify(data) : '';
            if (type == 'session') {
                window.name = data;
                if (!bUnloadListenerApplied) {      // IE7 windows as named targets only keep writes on unload.
                    if (window.addEventListener) window.addEventListener("unload", setData, false);
                    else if (window.attachEvent) window.attachEvent("onunload", setData);
                    bUnloadListenerApplied = true;
                }
            } else {
                var date = new Date();
                date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
                document.cookie = cookieName + "=" + data + "; expires=" + date.toGMTString() + "; path=/";
            }
        }

        // initialise if there's already data
        var data = type == 'session' ? window.name : readCookie();
        data = data ? JSON.parse(data) : {};

        return {
            clear: function () {
                data = {};
                setData('');
            },
            getItem: function (key) {
                return data[key] === undefined ? null : data[key];
            },
            key: function (i) {
                // not perfect, but works
                var ctr = 0;
                for (var k in data) {
                    if (ctr == i) return k;
                    else ctr++;
                }
                return null;
            },
            removeItem: function (key) {
                delete data[key];
                setData(data);
            },
            setItem: function (key, value) {
                data[key] = value + ''; // forces the value to a string
                setData(data);
            }
        };
    };

    if (typeof window.localStorage == 'undefined') window.localStorage = new Storage('local');
    if (typeof window.sessionStorage == 'undefined') window.sessionStorage = new Storage('session');
})();

}
/*
     FILE ARCHIVED ON 01:58:05 Sep 08, 2014 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:42:11 Apr 26, 2024.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 1.18
  exclusion.robots: 0.156
  exclusion.robots.policy: 0.14
  cdx.remote: 0.104
  esindex: 0.016
  LoadShardBlock: 117.807 (3)
  PetaboxLoader3.datanode: 48.305 (4)
  PetaboxLoader3.resolve: 139.394 (2)
  load_resource: 80.697
*/