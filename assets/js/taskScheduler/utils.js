if (!document.scheduler)
{
    scheduler = document.scheduler = {};
}

function InvalidArgumentException() { }

scheduler.typeof = function (obj)
{
    return Object.prototype.toString(obj);
};

scheduler.isObject = function (obj)
{
    return !!obj && scheduler.typeof(obj) === '[object Object]';
};

scheduler.isEmpty = function (v, allowBlank)
{
    return v === null || v === undefined || ((scheduler.isArray(v) && !v.length)) || (!allowBlank ? v === '' : false);
};

scheduler.isArray = function (v)
{
    return scheduler.typeof(v) === '[object Array]';
};

scheduler.isString = function (v)
{
    return typeof v === 'string';
};

scheduler.isDefined = function (v)
{
    return typeof v !== 'undefined';
};

scheduler.isNumeric = function (x)
{
    return String(x).match(/^(\d*)$/);
};

scheduler.isNumber = function (v)
{
    return typeof v === 'number' && isFinite(v);
};

scheduler.inherit = function (subclass, superclass, overrides)
{
    if (scheduler.isObject(superclass))
    {
        overrides = superclass;
        superclass = subclass;
        subclass = overrides.constructor != Object.prototype.constructor ?
            overrides.constructor : function () { superclass.clone(this, arguments); };
    }
    var F = function () { },
        sbp,
        spp = superclass.prototype;

    F.prototype = spp;
    sbp = subclass.prototype = new F();
    sbp.constructor = subclass;
    subclass.superclass = spp;
    if (spp.constructor == Object.prototype.constructor)
    {
        spp.constructor = superclass;
    }
    subclass.override = function (o)
    {
        scheduler.override(subclass, o);
    };
    sbp.superclass = sbp.supr = (function ()
    {
        return spp;
    });

    scheduler.override(subclass, overrides);
    return subclass;
};

scheduler.override = function (origclass, overrides)
{
    if (overrides)
    {
        var p = origclass.prototype;
        scheduler.clone(p, overrides);
    }
};

scheduler.clone = function (o, c, defaults)
{
    if (defaults)
    {
        scheduler.clone(o, defaults);
    }
    if (o && c && typeof c == 'object')
    {
        for (var p in c)
        {
            o[p] = c[p];
        }
    }
    return o;
};

if (!Array.prototype.indexOf)
{
    Array.prototype.indexOf = function (elt /*, from*/)
    {
        var len = this.length;

        var from = Number(arguments[1]) || 0;
        from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
        if (from < 0)
            from += len;

        for (; from < len; from++)
        {
            if (from in this &&
          this[from] === elt)
                return from;
        }
        return -1;
    };
}

if (!Array.prototype.some)
{
    Array.prototype.some = function (fun)
    {
        var len = this.length;
        if (typeof fun != "function")
        {
            throw new TypeError();
        }
        var thisp = arguments[1];
        for (var i = 0; i < len; i++)
        {
            if (i in this && fun.call(thisp, this[i], i, this))
            {
                return true;
            }
        }
        return false;
    };
}

if (!Array.prototype.every)
{
    Array.prototype.every = function (fun)
    {
        var len = this.length;
        if (typeof fun != "function")
        {
            throw new TypeError();
        }
        var thisp = arguments[1];
        for (var i = 0; i < len; i++)
        {
            if (i in this && !fun.call(thisp, this[i], i, this))
            {
                return false;
            }
        }
        return true;
    };
}

if (!Array.prototype.clear)
{
    Array.prototype.clear = function ()
    {
        this.length = 0;
    };
}

if (!Date.prototype.fromUTCtoLocal)
{
    Date.prototype.fromUTCtoLocal = function fromUTCtoLocal(msecs)
    {
        if (!isDefined(msecs) || msecs == null)
        {
            msecs = this.getTime();
        }

        this.setTime(msecs + (60000 * this.getTimezoneOffset()));
        return this;
    };
}

if (!Date.prototype.isLeapYear)
{
    Date.prototype.isLeapYear = function ()
    {
        var year = this.getFullYear();
        return !!((year & 3) == 0 && (year % 100 || (year % 400 == 0 && year)));
    }
}

if (!Date.prototype.getDaysInMonth)
{
    Date.prototype.getDaysInMonth = (function ()
    {
        var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        return function ()
        {
            var m = this.getMonth();

            return m == 1 && this.isLeapYear() ? 29 : daysInMonth[m];
        }
    })();
}


String.format = function (format)
{
    var args = Array.prototype.slice.call(arguments, 1);
    return format.replace(/\{(\d+)\}/g, function (m, i)
    {
        return args[i];
    });
};

scheduler.stringHashCode = function (source)
{
    var hs = 0;
    if (this.length === 0)
    {
        return hs;
    }

    for (i = 0; i < source.length; i++)
    {
        var ch = source.charCodeAt(i);
        hs = ((hs << 5) - hs) + ch;
        hs = hs & hs; // Convert to 32bit integer 
    }
    return hs;
};

scheduler.uid = function (len)
{
    var buf = []
      , chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
      , charlen = chars.length;

    for (var i = 0; i < len; ++i)
    {
        buf.push(chars[scheduler.getRandomInt(0, charlen - 1)]);
    }

    return buf.join('');
};

scheduler.getRandomInt = function (min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

scheduler.hashTable = function ()
{
    var length = 0;

    this.add = function add(uid, obj)
    {
        if (!this[uid])
        {
            this[uid] = obj;
            length++;
        }
        return this;
    };

    this.insert = function insert(uid, obj)
    {
        this[uid] = obj;
        return this;
    };

    this.getById = function getById(uid)
    {
        return this[uid];
    };

    this.remove = function remove(uid)
    {
        if (this[uid])
        {
            delete this[uid];
            this[uid] = null;
            length--;
        }
        return this;
    };

    this.getLength = function getLength()
    {
        return length;
    };

    this.foreach = function foreach(callback, scope)
    {
        for (var param in this)
        {
            if (typeof (this[param]) != 'function')
            {
                if (scope)
                {
                    callback.call(scope, this[param]);
                }
                else
                {
                    callback(this[param]);
                }
            }
        }
        return this;
    },

    this.toString = function toString(delimiter, pdelimiter)
    {
        var str = '';

        delimiter = delimiter ? delimiter : ':';
        pdelimiter = pdelimiter ? pdelimiter : ',';

        for (var param in this)
        {
            if (typeof (this[param]) != 'function')
            {
                if (str.length > 0)
                {
                    str += pdelimiter;
                }
                str += param + (this[param] ? delimiter + this[param] : '');
            }
        }

        return str;
    };
};