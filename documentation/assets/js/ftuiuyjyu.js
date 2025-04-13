(function(i) {
    "use strict";
    i(function() {
        i(".tooltip-demo").tooltip({
            selector: '[data-toggle="tooltip"]',
            container: "body"
        });
        i('[data-toggle="popover"]').popover();
        i(".tooltip-test").tooltip();
        i(".popover-test").popover();
        i('.bd-example-indeterminate [type="checkbox"]').prop("indeterminate", true);
        i('.bd-content [href="#"]').click(function(e) {
            e.preventDefault()
        });
        i("#exampleModal").on("show.bs.modal", function(e) {
            var t = i(e.relatedTarget);
            var n = t.data("whatever");
            var r = i(this);
            r.find(".modal-title").text("New message to " + n);
            r.find(".modal-body input").val(n)
        });
        i(".bd-toggle-animated-progress").on("click", function() {
            i(this).siblings(".progress").find(".progress-bar-striped").toggleClass("progress-bar-animated")
        });
        i("figure.highlight, div.highlight").each(function() {
            var e = '<div class="bd-clipboard"><button class="btn-clipboard" title="Copy to clipboard">Copy</button></div>';
            i(this).before(e);
            i(".btn-clipboard").tooltip().on("mouseleave", function() {
                i(this).tooltip("hide")
            })
        });
        var e = new ClipboardJS(".btn-clipboard", {
            target: function(e) {
                return e.parentNode.nextElementSibling
            }
        });
        e.on("success", function(e) {
            i(e.trigger).attr("title", "Copied!").tooltip("_fixTitle").tooltip("show").attr("title", "Copy to clipboard").tooltip("_fixTitle");
            e.clearSelection()
        });
        e.on("error", function(e) {
            var t = /Mac/i.test(navigator.userAgent) ? "⌘" : "Ctrl-";
            var n = "Press " + t + "C to copy";
            i(e.trigger).attr("title", n).tooltip("_fixTitle").tooltip("show").attr("title", "Copy to clipboard").tooltip("_fixTitle")
        });
        anchors.options = {
            icon: "#"
        };
        anchors.add(".bd-content > h2, .bd-content > h3, .bd-content > h4, .bd-content > h5");
        i(".bd-content > h2, .bd-content > h3, .bd-content > h4, .bd-content > h5").wrapInner("<div></div>");
        Holder.addTheme("gray", {
            bg: "#777",
            fg: "rgba(255,255,255,.75)",
            font: "Helvetica",
            fontweight: "normal"
        })
    })
})(jQuery);
(function() {
    "use strict";

    function e() {
        var e = /MSIE ([0-9.]+)/.exec(window.navigator.userAgent);
        if (e === null) {
            return null
        }
        var t = parseInt(e[1], 10);
        var n = Math.floor(t);
        return n
    }

    function t() {
        var e = new Function("/*@cc_on return @_jscript_version; @*/")();
        if (typeof e === "undefined") {
            return 11
        }
        if (e < 9) {
            return 8
        }
        return e
    }
    var n = window.navigator.userAgent;
    if (n.indexOf("Opera") > -1 || n.indexOf("Presto") > -1) {
        return
    }
    var r = e();
    if (r === null) {
        return
    }
    var i = t();
    if (r !== i) {
        window.alert("WARNING: You appear to be using IE" + i + " in IE" + r + " emulation mode.\nIE emulation modes can behave significantly differently from ACTUAL older versions of IE.\nPLEASE DON'T FILE BOOTSTRAP BUGS based on testing in IE emulation modes!")
    }
})();
(function() {
    "use strict";
    if ("serviceWorker" in navigator) {
        window.addEventListener("load", function() {
            navigator.serviceWorker.register("/sw.js").then(function(e) {
                console.log("ServiceWorker registration successful with scope: ", e.scope)
            }).catch(function(e) {
                console.log("ServiceWorker registration failed: ", e)
            })
        })
    } else {
        console.log("Service workers are not supported.")
    }
})();
(function() {
    "use strict";
    if (!window.docsearch) {
        return
    }
    var r = document.getElementById("search-input");
    var e = r.getAttribute("data-docs-version");
    window.docsearch({
        apiKey: "5990ad008512000bba2cf951ccf0332f",
        indexName: "bootstrap",
        inputSelector: "#search-input",
        algoliaOptions: {
            facetFilters: ["version:" + e]
        },
        handleSelected: function(e, t, n) {
            var r = n.url;
            r = n.isLvl1 ? r.split("#")[0] : r;
            window.location.href = r
        },
        transformData: function(e) {
            return e.map(function(e) {
                var t = r.getAttribute("data-siteurl");
                var n = /^https?:\/\/getbootstrap\.com/;
                e.url = t.match(n) ? e.url : e.url.replace(n, "");
                return e
            })
        },
        debug: false
    })
})();