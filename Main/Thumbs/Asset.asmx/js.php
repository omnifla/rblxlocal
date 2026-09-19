<?php
header("Content-Type: text/javascript; charset=utf-8");
?>
var _____WB$wombat$assign$function_____=function(name){return (globalThis._wb_wombat && globalThis._wb_wombat.local_init
&&
globalThis._wb_wombat.local_init(name))||globalThis[name];};if(!globalThis.__WB_pmw){globalThis.__WB_pmw=function(obj){this.__WB_source=obj;return
this;}}{
let window = _____WB$wombat$assign$function_____("window");
let self = _____WB$wombat$assign$function_____("self");
let document = _____WB$wombat$assign$function_____("document");
let location = _____WB$wombat$assign$function_____("location");
let top = _____WB$wombat$assign$function_____("top");
let parent = _____WB$wombat$assign$function_____("parent");
let frames = _____WB$wombat$assign$function_____("frames");
let opener = _____WB$wombat$assign$function_____("opener");
Type.registerNamespace('Roblox.Thumbs');
Roblox.Thumbs.Asset=function() {
Roblox.Thumbs.Asset.initializeBase(this);
this._timeout = 0;
this._userContext = null;
this._succeeded = null;
this._failed = null;
}
Roblox.Thumbs.Asset.prototype={
_get_path:function() {
var p = this.get_path();
if (p) return p;
else return Roblox.Thumbs.Asset._staticInstance.get_path();},
RequestThumbnail:function(assetId,assetVersionId,width,height,imageFormat,thumbnailFormatId,overrideModeration,succeededCallback,
failedCallback, userContext) {
return this._invoke(this._get_path(),
'RequestThumbnail',true,{assetId:assetId,assetVersionId:assetVersionId,width:width,height:height,imageFormat:imageFormat,thumbnailFormatId:thumbnailFormatId,overrideModeration:overrideModeration},succeededCallback,failedCallback,userContext);
},
RequestThumbnail_v2:function(assetId,assetVersionId,width,height,imageFormat,thumbnailFormatId,overrideModeration,succeededCallback,
failedCallback, userContext) {
return this._invoke(this._get_path(),
'RequestThumbnail_v2',true,{assetId:assetId,assetVersionId:assetVersionId,width:width,height:height,imageFormat:imageFormat,thumbnailFormatId:thumbnailFormatId,overrideModeration:overrideModeration},succeededCallback,failedCallback,userContext);
}}
Roblox.Thumbs.Asset.registerClass('Roblox.Thumbs.Asset',Sys.Net.WebServiceProxy);
Roblox.Thumbs.Asset._staticInstance = new Roblox.Thumbs.Asset();
Roblox.Thumbs.Asset.set_path = function(value) { Roblox.Thumbs.Asset._staticInstance.set_path(value); }
Roblox.Thumbs.Asset.get_path = function() { return Roblox.Thumbs.Asset._staticInstance.get_path(); }
Roblox.Thumbs.Asset.set_timeout = function(value) { Roblox.Thumbs.Asset._staticInstance.set_timeout(value); }
Roblox.Thumbs.Asset.get_timeout = function() { return Roblox.Thumbs.Asset._staticInstance.get_timeout(); }
Roblox.Thumbs.Asset.set_defaultUserContext = function(value) {
Roblox.Thumbs.Asset._staticInstance.set_defaultUserContext(value); }
Roblox.Thumbs.Asset.get_defaultUserContext = function() { return
Roblox.Thumbs.Asset._staticInstance.get_defaultUserContext(); }
Roblox.Thumbs.Asset.set_defaultSucceededCallback = function(value) {
Roblox.Thumbs.Asset._staticInstance.set_defaultSucceededCallback(value); }
Roblox.Thumbs.Asset.get_defaultSucceededCallback = function() { return
Roblox.Thumbs.Asset._staticInstance.get_defaultSucceededCallback(); }
Roblox.Thumbs.Asset.set_defaultFailedCallback = function(value) {
Roblox.Thumbs.Asset._staticInstance.set_defaultFailedCallback(value); }
Roblox.Thumbs.Asset.get_defaultFailedCallback = function() { return
Roblox.Thumbs.Asset._staticInstance.get_defaultFailedCallback(); }
Roblox.Thumbs.Asset.set_enableJsonp = function(value) { Roblox.Thumbs.Asset._staticInstance.set_enableJsonp(value); }
Roblox.Thumbs.Asset.get_enableJsonp = function() { return Roblox.Thumbs.Asset._staticInstance.get_enableJsonp(); }
Roblox.Thumbs.Asset.set_jsonpCallbackParameter = function(value) {
Roblox.Thumbs.Asset._staticInstance.set_jsonpCallbackParameter(value); }
Roblox.Thumbs.Asset.get_jsonpCallbackParameter = function() { return
Roblox.Thumbs.Asset._staticInstance.get_jsonpCallbackParameter(); }
Roblox.Thumbs.Asset.set_path("/Thumbs/Asset.asmx");
Roblox.Thumbs.Asset.RequestThumbnail=
function(assetId,assetVersionId,width,height,imageFormat,thumbnailFormatId,overrideModeration,onSuccess,onFailed,userContext)
{Roblox.Thumbs.Asset._staticInstance.RequestThumbnail(assetId,assetVersionId,width,height,imageFormat,thumbnailFormatId,overrideModeration,onSuccess,onFailed,userContext);
}
Roblox.Thumbs.Asset.RequestThumbnail_v2=
function(assetId,assetVersionId,width,height,imageFormat,thumbnailFormatId,overrideModeration,onSuccess,onFailed,userContext)
{Roblox.Thumbs.Asset._staticInstance.RequestThumbnail_v2(assetId,assetVersionId,width,height,imageFormat,thumbnailFormatId,overrideModeration,onSuccess,onFailed,userContext);
}
var gtc = Sys.Net.WebServiceProxy._generateTypedConstructor;
if (typeof(Roblox.Thumbs.ScriptThumbResult) === 'undefined') {
Roblox.Thumbs.ScriptThumbResult=gtc("Roblox.Thumbs.ScriptThumbResult");
Roblox.Thumbs.ScriptThumbResult.registerClass('Roblox.Thumbs.ScriptThumbResult');
}

}