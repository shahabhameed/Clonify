/*
jQWidgets v3.2.2 (2014-Mar-21)
Copyright (c) 2011-2014 jQWidgets.
License: http://jqwidgets.com/license/
*/
(function (c) {
    c.jqx.jqxWidget("jqxTreeMap", "", {});
    var d = {};
    d["default"] = (function () {
        function g(r, s, q, p) {
            this.height = p;
            this.width = q;
            this.xoffset = r;
            this.yoffset = s;
            this.shortestEdge = function () {
                return Math.min(this.height, this.width)
            };
            this.getCoordinates = function (y) {
                var x = [],
                    v = this.xoffset,
                    z = this.yoffset,
                    w = j(y) / this.height,
                    u = j(y) / this.width;
                if (this.width >= this.height) {
                    for (var t = 0; t < y.length; t += 1) {
                        x.push([v, z, v + w, z + y[t] / w]);
                        z = z + y[t] / w
                    }
                } else {
                    for (var t = 0; t < y.length; t += 1) {
                        x.push([v, z, v + y[t] / u, z + u]);
                        v = v + y[t] / u
                    }
                }
                return x
            };
            this.cutArea = function (w) {
                var y;
                if (this.width >= this.height) {
                    var x = w / this.height,
                        t = this.width - x;
                    y = new g(this.xoffset + x, this.yoffset, t, this.height)
                } else {
                    var v = w / this.width,
                        u = this.height - v;
                    y = new g(this.xoffset, this.yoffset + v, this.width, u)
                }
                return y
            }
        }
        function o(t, r) {
            var s = [],
                q = j(t),
                u = r / q;
            for (var p = 0; p < t.length; p += 1) {
                s[p] = t[p] * u
            }
            return s
        }
        function e(s, q, x, u, p) {
            u = (typeof u === "undefined") ? 0 : u;
            p = (typeof p === "undefined") ? 0 : p;
            var v = [],
                w, t = [];
            if (h(s[0])) {
                for (var r = 0; r < s.length; r += 1) {
                    v[r] = i(s[r])
                }
                w = m(v, q, x, u, p);
                for (var r = 0; r < s.length; r += 1) {
                    t.push(e(s[r], w[r][2] - w[r][0], w[r][3] - w[r][1], w[r][0], w[r][1]))
                }
            } else {
                t = m(s, q, x, u, p)
            }
            return t
        }
        function m(s, r, p, t, u) {
            t = (typeof t === "undefined") ? 0 : t;
            u = (typeof u === "undefined") ? 0 : u;
            var q = f(o(s, r * p), [], new g(t, u, r, p), []);
            return n(q)
        }
        function n(r) {
            var s = [];
            for (var q = 0; q < r.length; q += 1) {
                for (var p = 0; p < r[q].length; p += 1) {
                    s.push(r[q][p])
                }
            }
            return s
        }
        function f(u, t, q, p) {
            var s, r, v;
            if (u.length === 0) {
                p.push(q.getCoordinates(t));
                return
            }
            s = q.shortestEdge();
            r = u[0];
            if (l(t, r, s)) {
                t.push(r);
                f(u.slice(1), t, q, p)
            } else {
                v = q.cutArea(j(t), p);
                p.push(q.getCoordinates(t));
                f(u, [], v, p)
            }
            return p
        }
        function l(t, q, r) {
            var s;
            if (t.length === 0) {
                return true
            }
            s = t.slice();
            s.push(q);
            var u = k(t, r),
                p = k(s, r);
            return u >= p
        }
        function k(t, s) {
            var q = Math.min.apply(Math, t),
                p = Math.max.apply(Math, t),
                r = j(t);
            return Math.max(Math.pow(s, 2) * p / Math.pow(r, 2), Math.pow(r, 2) / (Math.pow(s, 2) * q))
        }
        function h(p) {
            return p && p.constructor === Array
        }
        function j(p) {
            var r = 0;
            for (var q = 0; q < p.length; q += 1) {
                r += p[q]
            }
            return r
        }
        function i(p) {
            var r = 0;
            if (h(p[0])) {
                for (var q = 0; q < p.length; q += 1) {
                    r += i(p[q])
                }
            } else {
                r = j(p)
            }
            return r
        }
        return e
    }());

    function b(g, l, i, h, j, f, k, e) {
        this.label = g;
        this.value = l;
        this.parent = i;
        this.children = h;
        this.area = j || null;
        this.color = f;
        this.data = k;
        this.record = e
    }
    var a = {
        HORIZONTAL: 0,
        VERTICAL: 1,
        BOTH: 2
    };
    c.extend(c.jqx._jqxTreeMap.prototype, {
        defineInstance: function () {
            this.width = 600;
            this.height = 600;
            this.renderCallbacks = {};
            this.legendScaleCallback = function (e) {
                return e
            };
            this.hoverEnabled = false;
            this.selectionEnabled = true;
            this.singleSelection = true;
            this.showLegend = true;
            this.legendLabel = "Legend";
            this.headerHeight = 25;
            this.colorRange = 100;
            this.layout = "default";
            this.source = [];
            this.displayMember = null;
            this.valueMember = null;
            this.colorMode = "parent";
            this.baseColor = "#C2EEFF";
            this.legendPosition = {
                x: 0,
                y: 0
            };
            this.colorRanges = [{
                color: "#aa9988",
                min: 0,
                max: 10
            }, {
                color: "#ccbbcc",
                min: 11,
                max: 50
            }, {
                color: "#000",
                min: 50,
                max: 100
            }];
            this._root = []
        },
        createInstance: function () {
            this.render()
        },
        render: function () {
            this.host.addClass(this.toThemeProperty("jqx-widget"));
            this._destroy();
            this._root = new b(undefined, 0, null, [], this.host);
            var e = function (h, k) {
                    var n = {},
                        l;
                    var m = null;
                    for (var j = 0; j < h.length; j += 1) {
                        if (h[j].items) {
                            m = true;
                            break
                        }
                    }
                    var f = new Array();
                    if (m) {
                        var g = function (v, s) {
                                for (var q = 0; q < v.length; q += 1) {
                                    v[q].parent = s;
                                    if (!v[q].data) {
                                        v[q].data = v[q].value;
                                    }
                                    if (v[q].value === null) {
                                        v[q].value = 0;
                                    }
                                    if (isNaN(parseFloat(v[q].value))) {
                                        var w = v[q].value.toString();
                                        var u = "";
                                        for (var p = 0; p < w.length; p++) {
                                            var r = w.substring(p, p + 1);
                                            if (r.match(/^[0-9]+$/) != null || r === ".") {
                                                u += r;
                                            }
                                        }
                                        v[q].value = new Number(u);
                                    } else {
                                        v[q].value = parseFloat(v[q].value);
                                    }
                                    f.push(v[q]);
                                    if (v[q].items) {
                                        g(v[q].items, v[q].label);
                                    }
                                }
                            };
                        g(h, null);
                        h = f;
                    }
                    for (var j = 0; j < h.length; j += 1) {
                        l = h[j];
                        if (l.value) {
                            if (l.parent !== null) {
                                if (!n[l.parent]) {
                                    n[l.parent] = 0;
                                }
                                n[l.parent] += l.value;
                            }
                        }
                    }
                    for (var j = 0; j < h.length; j += 1) {
                        l = h[j];
                        if (n[l.label] !== undefined) {
                            l.value = n[l.label];
                        }
                    }
                    k._buildTree(h, k._root);
                    k._dataList = k._buildList();
                    k._setStyles();
                    var o = d["default"];
                    if (k.layout === "simple") {
                        o = d.simple;
                    }
                    k._render(k._root, o);
                    k._renderLegend();
                };
            if (c.jqx.dataAdapter && this.source !== null && this.source._source) {
                this.dataBind(this.source, e);
                return;
            }
            e(this.source, this);
        },
        dataBind: function (e, m) {
            this.records = new Array();
            var h = e._source ? true : false;
            var f = new c.jqx.dataAdapter(e, {
                autoBind: false
            });
            if (h) {
                f = e;
                e = e._source;
            }
            var g = function (n) {
                    if (e.type !== undefined) {
                        f._options.type = e.type;
                    }
                    if (e.formatdata !== undefined) {
                        f._options.formatData = e.formatdata;
                    }
                    if (e.contenttype !== undefined) {
                        f._options.contentType = e.contenttype;
                    }
                    if (e.async !== undefined) {
                        f._options.async = e.async;
                    }
                };
            var j = function (p, o) {
                    p.records = f.records;
                    var q = new Array();
                    for (var n = 0; n < p.records.length; n++) {
                        var r = p.records[n];
                        if (p.displayMember) {
                            r.label = r[p.displayMember];
                        }
                        if (p.valueMember) {
                            r.value = r[p.valueMember];
                        }
                        r.record = r;
                        q.push(r);
                    }
                    p._trigger("bindingComplete");
                    m(q, p);
                };
            g(this);
            var k = this;
            switch (e.datatype) {
            case "local":
            case "array":
            default:
                if (e.localdata !== null) {
                    f.unbindBindingUpdate(this.element.id);
                    f.dataBind();
                    j(this);
                    f.bindBindingUpdate(this.element.id, function (n) {
                        j(k, n);
                    });
                }
                break;
            case "json":
            case "jsonp":
            case "xml":
            case "xhtml":
            case "script":
            case "text":
            case "csv":
            case "tab":
                if (e.localdata !== null) {
                    f.unbindBindingUpdate(this.element.id);
                    f.dataBind();
                    j(this);
                    f.bindBindingUpdate(this.element.id, function () {
                        j(k);
                    });
                    return;
                }
                var l = {};
                if (f._options.data) {
                    c.extend(f._options.data, l);
                } else {
                    if (e.data) {
                        c.extend(l, e.data);
                    }
                    f._options.data = l;
                }
                var i = function () {
                        j(k);
                    };
                f.unbindDownloadComplete(k.element.id);
                f.bindDownloadComplete(k.element.id, i);
                f.dataBind();
            }
        },
        _destroy: function () {
            this.host.children().remove();
        },
        destroy: function () {
            this.host.remove();
        },
        refresh: function (e) {
            if (!e) {
                this._refresh();
            }
        },
        _refresh: function () {
            this.render();
        },
        _setStyles: function () {
            this.host.css({
                position: "relative",
                width: this.width,
                height: this.height
            });
            var e = false;
            if (this.width !== null && this.width.toString().indexOf("%") !== -1) {
                e = true;
            }
            if (this.height !== null && this.height.toString().indexOf("%") !== -1) {
                e = true;
            }
            var f = this;
            c.jqx.utilities.resize(this.host, function () {
                if (f.resizeTimer) {
                    clearTimeout(f.resizeTimer);
                }
                f.resizeTimer = setTimeout(function () {
                    f.performLayout();
                }, 10);
            });
        },
        resize: function (f, e) {
            this.width = f;
            this.height = e;
            this.performLayout();
        },
        performLayout: function () {
            var e = d["default"];
            this.clearSelection();
            this._layout(this._root, e);
        },
        _getValues: function (g) {
            var e = [];
            for (var f = 0; f < g.length; f += 1) {
                e.push(g[f].value);
            }
            return e;
        },
        _isColor: function (e) {
            if (!e) {
                return false;
            }
            var f = this._colorEvaluator;
            if (f._isRgb(e) || f._isHex(e)) {
                return true;
            }
            return false;
        },
        _colorEvaluator: {
            _toRgb: function (f) {
                var e = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(f);
                return e ? {
                    r: parseInt(e[1], 16),
                    g: parseInt(e[2], 16),
                    b: parseInt(e[3], 16)
                } : null;
            },
            _toHex: function (f) {
                var i = f.r.toString(16),
                    h = f.g.toString(16),
                    e = f.b.toString(16);
                i = i.length === 1 ? "0" + i : i;
                h = h.length === 1 ? "0" + h : h;
                e = e.length === 1 ? "0" + e : e;
                return "#" + i + h + e;
            },
            _isRgb: function (e) {
                return (/(rgb|rgba)\s*\(\s*\d+\s*(,\s*\d+\s*){2}(,\d+\.\d+)?\)(;?)/i).test(e);
            },
            _isHex: function (e) {
                return (/^(#([0-9A-F]{3})([0-9A-F]{3})?)$/i).test(e);
            },
            getColorByValue: function (n, j, k) {
                var o = this._colorEvaluator,
                    m, l, e, f, g, j;
                if (o._isRgb(k)) {
                    k = o._toHex(k);
                }
                k = o._toRgb(k);
                e = j.length;
                m = -Infinity;
                for (var h = 0; h < e; h += 1) {
                    if (m < j[h].value) {
                        m = j[h].value;
                    }
                }
                l = n / m;
                f = Math.round(l * this.colorRange);
                g = o._toHex({
                    r: Math.max(k.r - f, 0),
                    g: Math.max(k.g - f, 0),
                    b: Math.max(k.b - f, 0)
                });
                return g;
            },
            parent: function (g) {
                var f = g.parent.color,
                    e = this._colorEvaluator;
                if (!g.parent) {
                    return "#fff";
                }
                if (!f) {
                    f = this.baseColor;
                }
                f = e.getColorByValue.call(this, g.value, g.parent.children, f);
                g.color = f;
                return f;
            },
            autoColors: function (g) {
                var f = this.baseColor,
                    e = this._colorEvaluator;
                f = e.getColorByValue.call(this, g.value, this._dataList, f);
                g.color = f;
                return f;
            },
            rangeColors: function (f) {
                var h = f.value,
                    g;
                for (var e = 0; e < this.colorRanges.length; e += 1) {
                    g = this.colorRanges[e];
                    if (g.min < h && g.max >= h) {
                        return g.color;
                    }
                }
                return "#fff";
            }
        },
        _getColor: function (f) {
            var e = f.color,
                g = this.colorMode;
            if (this._isColor(e)) {
                return e;
            }
            if (typeof this._colorEvaluator[g] === "function") {
                return this._colorEvaluator[g].call(this, f);
            } else {
                throw "Invalid colorMode"
            }
        },
        _renderRect: function (i, f) {
            var j = c("<div/>"),
                e = i[2] - i[0],
                l = i[3] - i[1];
            var g = this._getColor(f);
            j.css({
                position: "absolute",
                left: i[0] - 1,
                top: i[1] - 1,
                width: e,
                height: l,
                backgroundColor: g
            });
            j.addClass(this.toThemeProperty("jqx-treemap-rectangle"));
            var k = this._colorEvaluator;
            var h = {
                data: f.data,
                label: f.label,
                value: f.value,
                parent: f.parent,
                record: f.record,
                color: g,
                rgb: k._toRgb(g)
            };
            if (f.parent === this._root) {
                h.parent = null;
            }
            if (typeof this.renderCallbacks["*"] === "function") {
                var m = this.renderCallbacks["*"](j, h);
                if (m !== undefined) {
                    return j;
                }
            }
            if (typeof this.renderCallbacks[f.label] === "function") {
                this.renderCallbacks[f.label](j, h);
            } else {
                var e = j.width() - 2;
                j.html('<span style="max-width:' + e + 'px;" class="jqx-treemap-label">' + f.label + "</span>");
            }
            return j;
        },
        _centerLabel: function (g, f) {
            var e = g[0].firstChild;
            e.style.position = "absolute";
            if (f === a.HORIZONTAL || f === a.BOTH) {
                e.style.left = (g[0].offsetWidth - e.offsetWidth) / 2 + "px";
            }
            if (f === a.VERTICAL || f === a.BOTH) {
                e.style.top = (g[0].offsetHeight - e.offsetHeight) / 2 + "px";
            }
        },
        _trigger: function (g, f) {
            var h = c.Event(g);
            h.args = f;
            return this.host.trigger(h);
        },
        _addHandlers: function (e, g) {
            var f = this;
            e.bind("mouseenter", function (h) {
                if (f.hoverEnabled) {
                    f.host.find(".jqx-treemap-rectangle").removeClass("jqx-treemap-rectangle-hover");
                    e.addClass(f.toThemeProperty("jqx-treemap-rectangle-hover"));
                }
                f._trigger("mouseenterSector", g)
            });
            e.bind("mouseleave", function (h) {
                if (f.hoverEnabled) {
                    e.removeClass("jqx-treemap-rectangle-hover")
                }
                f._trigger("mouseleaveSector", g)
            });
            e.bind("click", function (i) {
				reloadTreeMapData();
                if (f.selectionEnabled) {
                    var h = c.data(this, "jqx-treemap-selected") || false;
                    if (f.singleSelection) {
                        f.host.find(".jqx-treemap-rectangle-hover").each(function (j, k) {
                            c.data(k, "jqx-treemap-selected", false);
                            c(k).removeClass("jqx-treemap-rectangle-hover")
                        })
                    }
                    if (h) {
                        e.removeClass("jqx-treemap-rectangle-hover");
                        h = false
                    } else {
                        e.addClass(f.toThemeProperty("jqx-treemap-rectangle-hover"));
                        h = true
                    }
                    c.data(this, "jqx-treemap-selected", h);
                    i.stopImmediatePropagation()
                }
            })
        },
        clearSelection: function () {
            this.host.find(".jqx-treemap-rectangle-hover").removeClass(this.toThemeProperty("jqx-treemap-rectangle-hover"));
            c.data(this, "jqx-treemap-selected", false)
        },
        _layoutArea: function (f, e) {
            if (f.children.length && f.children.length > 0) {
                this._centerLabel(e, a.HORIZONTAL);
                e.addClass(this.toThemeProperty("jqx-treemap-rectangle-parent"))
            } else {
                this._centerLabel(e, a.BOTH)
            }
        },
        _render: function (f, l) {
            if (!f.children.length) {
                return
            }
            var e = 0;
            if (f.value) {
                e = this.headerHeight
            }
            var n = this._getValues(f.children),
                g = f.area.offset(),
                j = l(n, f.area.width(), f.area.height() - e, 0, e),
                k, m;
            for (var h = 0; h < f.children.length; h += 1) {
                k = f.children[h];
                m = this._renderRect(j[h], k);
                k.area = m;
                f.area.append(m);
                this._addHandlers(m, {
                    label: k.label,
                    value: k.value,
                    color: k.color,
                    sector: k.area,
                    data: k.data
                });
                this._layoutArea(k, m);
                this._render(k, l)
            }
        },
        _layout: function (f, l) {
            if (!f.children.length) {
                return
            }
            var e = 0;
            if (f.value) {
                e = this.headerHeight
            }
            var n = this._getValues(f.children),
                g = f.area.offset(),
                j = l(n, f.area.width(), f.area.height() - e, 0, e),
                k, m;
            for (var h = 0; h < f.children.length; h += 1) {
                k = f.children[h];
                this._layoutRect(j[h], k);
                this._layoutArea(k, k.area);
                this._layout(k, l)
            }
        },
        _layoutRect: function (i, f) {
            var j = f.area,
                e = i[2] - i[0],
                l = i[3] - i[1];
            j.css({
                left: i[0] - 1,
                top: i[1] - 1,
                width: e,
                height: l
            });
            var k = this._colorEvaluator;
            var g = this._getColor(f);
            var h = {
                data: f.data,
                label: f.label,
                value: f.value,
                parent: f.parent,
                record: f.record,
                color: g,
                rgb: k._toRgb(g)
            };
            if (f.parent == this._root) {
                h.parent = null
            }
            if (typeof this.renderCallbacks["*"] === "function") {
                var m = this.renderCallbacks["*"](j, h);
                if (m !== undefined) {
                    return j
                }
            }
            if (typeof this.renderCallbacks[f.label] === "function") {
                this.renderCallbacks[f.label](j, h)
            } else {
                var e = j.width() - 2;
                j.html('<span style="max-width:' + e + 'px;" class="jqx-treemap-label">' + f.label + "</span>")
            }
        },
        _getBoundValues: function () {
            var g = this._root,
                f = [],
                k, j = {},
                e = {};
            j.value = g.value || Infinity;
            e.value = g.value || -Infinity;
            f.push(g);
            while (f.length) {
                k = f.pop();
                if (j.value > k.value) {
                    j = k
                }
                if (e.value < k.value) {
                    e = k
                }
                for (var h = 0; h < k.children.length; h += 1) {
                    f.push(k.children[h])
                }
            }
            return [j, e]
        },
        _getAutocolorRanges: function () {
            var l = this._getBoundValues(),
                g = 5,
                e = l[1].value,
                j = l[0].value,
                f = (e - j) / g,
                m, k = [];
            for (var h = j; h < e; h += f) {
                m = Math.round(h);
                k.push({
                    min: m,
                    max: h + f,
                    color: this._colorEvaluator.getColorByValue.call(this, m, this._dataList, this.baseColor)
                });
            }
            return k;
        },
        _renderLegend: function () {
            if (!(/autoColors|rangeColors/).test(this.colorMode) || !this.showLegend) {
                return;
            }
            var e = this.colorRanges;
            if (this.colorMode === "autoColors") {
                e = this._getAutocolorRanges();
            }
            //var f = this._renderColorLegend(e);
            //this._renderLegendLabel(f)
        },
        _renderLegendLabel: function (f) {
            var g = c('<tr><td colspan="' + f.find("td").length / 2 + '"/></tr>'),
                e = c('<div class="' + this.toThemeProperty("jqx-treemap-legend-label") + '" />');
            e.text(this.legendLabel);
            g.children().append(e);
            f.prepend(g);
        },
        _renderColorLegend: function (e) {
            var o = c('<div class="' + this.toThemeProperty("jqx-treemap-legend") + '"/>'),
                q, n, r, p = function (i) {
                    return i;
                };
            if (typeof this.legendScaleCallback === "function") {
                p = this.legendScaleCallback;
            }
            var s = c('<table class="' + this.toThemeProperty("jqx-treemap-legend-table") + '"/>');
            o.append(s);
            s.append("<tr/>");
            o.append("<div/>");
            this.host.append(o);
            q = c(o.find("tr")[0]);
            n = c(o.find("div")[0]);
            n.addClass(this.toThemeProperty("jqx-treemap-legend-values"));
            var g = function (t, i) {
                    try {
                        if (t.min < i.min) {
                            return -1;
                        }
                        if (t.min > i.min) {
                            return 1;
                        }
                    } catch (u) {
                        var v = u;
                    }
                    return 0;
                };
            e.sort(g);
            var f = Math.round(o.width() / e.length);
            var m = -2;
            var h = 0;
            for (var k = 0; k < e.length; k += 1) {
                var j = c('<td class="' + this.toThemeProperty("jqx-treemap-legend-color") + '"/>');
                j.css("backgroundColor", e[k].color);
                q.append(j);
                if (k === 0) {
                    var l = c('<span class="' + this.toThemeProperty("jqx-treemap-legend-max-value") + " " + this.toThemeProperty("jqx-treemap-legend-value") + '"/>');
                    l.text(p(e[k].min));
                    n.append(l);
                    s.css("margin-left", l.width() / 2);
                    m += l.width() / 2;
                    h = m
                }
                var l = c('<span class="' + this.toThemeProperty("jqx-treemap-legend-max-value") + " " + this.toThemeProperty("jqx-treemap-legend-value") + '"/>');
                m += f;
                l.text(p(e[k].max));
                n.append(l);
                if (k == e.length - 1) {
                    h += l.width() / 2;
                    o.css("padding-right", h + 5);
                    m -= 2
                }
                m -= l.width() / 2;
                l.css("left", m);
                m += l.width() / 2
            }
            o.css({
                position: "absolute",
                left: this.legendPosition.x,
                bottom: this.legendPosition.y,
                visibility: (this.showLegend) ? "visible" : "hidden"
            });
            return o
        },
        _buildTree: function (k, f) {
            var g = null,
                m, l, e = [];
            e.push(f);
            while (e.length) {
                g = e.pop();
                for (var h = 0; h < k.length; h += 1) {
                    l = k[h];
                    if (l.parent === g.label || (!l.parent && !g.label)) {
                        var j = g;
                        m = new b(l.label, parseFloat(l.value, 10), j, [], null, l.color, l.data, l.record);
                        g.children.push(m);
                        e.push(m)
                    }
                }
            }
            return f
        },
        _buildList: function () {
            var f = [],
                e = [],
                h;
            e.push(this._root);
            while (e.length) {
                h = e.pop();
                if (h !== this._root) {
                    f.push(h)
                }
                for (var g = 0; g < h.children.length; g += 1) {
                    e.push(h.children[g])
                }
            }
            return f
        },
        propertyChangedHandler: function (g, e, h) {
            if (e === "renderCallbacks") {
                return
            }
            if ((/hoverEnabled|selectionEnabled/).test(e)) {
                if (!h) {
                    this.host.find("jqx-treemap-rectangle-hover")
                }
            } else {
                if (e === "showLegend") {
                    this.host.find("jqx-treemap-legend").toggle()
                } else {
                    this._refresh()
                }
            }
        }
    })
}(jQuery));
 