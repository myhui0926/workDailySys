!
    function(e) {
        function i() {
            var e = "",
                i = navigator;
            if (i.plugins && i.plugins.length) {
                for (var t = 0; t < i.plugins.length; t++) if (i.plugins[t].name.indexOf("Shockwave Flash") != -1) {
                    e = i.plugins[t].description.split("Shockwave Flash ")[1], e = e.split(" ").join(".");
                    break
                }
            } else if (window.ActiveXObject) {
                var o = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
                o && (e = o.GetVariable("$version").toLowerCase(), e = e.split("win ")[1], e = e.split(",").join("."))
            }
            return e
        }
        function t(e, i, t) {
            function o(i) {
                return e.replace(t || /\\?\{([^}]+)\}/g, function(e, t) {
                    return "\\" == e.charAt(0) ? e.slice(1) : void 0 != i[t] ? i[t] : ""
                })
            }
            "[object Array]" !== Object.prototype.toString.call(i) && (i = [i]);
            for (var a = [], l = 0, r = i.length; l < r; l++) a.push(o(i[l]));
            return a.join("")
        }
        e.NTES_createVideo || (e.NTES_createVideo = function(e, o) {
            var a, l = '<embed src="http://v.163.com/swf/video/NetEaseFlvPlayerV3.swf" flashvars="pltype={pltype}&topicid={topicid}&vid={vid}&sid={sid}&coverpic={coverpic}&autoplay={autoplay}&showend={showend}&hiddenR=true" allowFullScreen="true" allowScriptAccess="always" quality="high" width="{width}" height="{height}" {vars} allowScriptAccess="always" type="application/x-shockwave-flash"></embed>',
                r = ['<video width="100%" controls {autoplay} preload="auto" {vars} poster={coverpic}>', '<source src="{url_m3u8}" type="application/x-mpegurl">', '<source src="{url_mp4}" type="video/mp4">', "\u60a8\u7684\u6d4f\u89c8\u5668\u6682\u65f6\u65e0\u6cd5\u64ad\u653e\u6b64\u89c6\u9891.", "</video>"].join(""),
                c = i();
            c ? a = l : (a = r, e.autoplay = e.autoplay ? "autoplay" : ""), o.innerHTML = t(a, e), c && (o.style.width = e.width + ("100%" == e.width ? "" : "px"), o.style.height = e.height + ("100%" == e.height ? "" : "px"))
        })
    }(window);