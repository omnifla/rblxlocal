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

/* Initialize code for after base scripts load */

if (("modal" in $.fn) && ("noConflict" in $.fn.modal)) {
    $.fn.bootstrapModal = $.fn.modal.noConflict();
}

$(function () {
    // For IE8 password field derp
    $('.ie8 input[type=password]').attr('placeholder', 'Password');

    // uses jquery.placeholder.js
    $('input, textarea').placeholder();
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
  captures_list: 0.717
  exclusion.robots: 0.085
  exclusion.robots.policy: 0.076
  cdx.remote: 0.063
  esindex: 0.01
  LoadShardBlock: 51.311 (3)
  PetaboxLoader3.datanode: 67.976 (4)
  load_resource: 75.809
  PetaboxLoader3.resolve: 34.079
*/