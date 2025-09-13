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

if (typeof Roblox.EmailEntryModal === "undefined") {
    Roblox.EmailEntryModal = function () {
        var modalProperties = {
            overlayClose: true,
            escClose: true,
            opacity: 80,
            overlayCss: {
                backgroundColor: "#000"
            }
        };

        function open(message, elementToAppend) {
            var modal = $("div#EmailEntryModal").filter(":first");
            if (modal.length == 0) {
                modal = $("<div id='EmailEntryModal' class='modalPopup'><div class='Message'></div></div>")
            }
            if (message) {
                modal.find("div.Message").html(message);
            }
            else {
                $(elementToAppend).appendTo(modal.find("div.Message"));
            }
            modal.modal(modalProperties);
        }

        return {
            open: open
        };
    } ();
}

}
/*
     FILE ARCHIVED ON 00:15:07 Jan 08, 2016 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:42:16 Apr 26, 2024.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 1.171
  exclusion.robots: 0.158
  exclusion.robots.policy: 0.141
  cdx.remote: 0.101
  esindex: 0.014
  LoadShardBlock: 125.206 (3)
  PetaboxLoader3.datanode: 44.225 (4)
  PetaboxLoader3.resolve: 127.367 (3)
  load_resource: 67.063
*/